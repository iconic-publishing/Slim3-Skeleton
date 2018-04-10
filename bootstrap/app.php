<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 12th March, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Slim\App;
use Noodlehaus\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\Translator;
use Slim\Views\TwigExtension;
use Base\View\Extensions\TranslationExtension;
use Base\View\Extensions\DebugExtension;
use Base\View\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Base\Auth\Auth;
use Base\Plugins\Hash;
use Base\Validation\Validator;
use Slim\Flash\Messages;
use Slim\Csrf\Guard;
use Base\Plugins\CurrencyConverter;
use Base\Plugins\Select;
use Base\Plugins\Upload;
use Base\Services\Mail;
use Base\Services\Sms;
use Base\Services\Mailchimp;
use Base\ErrorHandlers\NotFoundHandler;
use Base\ErrorHandlers\ErrorHandler;
use Respect\Validation\Validator as v;
use Base\Middleware\ValidationErrorsMiddleware;
use Base\Middleware\OldInputMiddleware;
use Base\Middleware\CsrfViewMiddleware;
use Base\Middleware\CsrfStatusMiddleware;

session_start();

require __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv(__DIR__ . '/../'))->load();
} catch (InvalidPathException $e) {
    // Do nothing just catch Exception
}

$app = new App([
	'settings' => [
		'displayErrorDetails' => getenv('DISPLAY_ERROR_DETAILS') === 'true',
		'determineRouteBeforeAppMiddleware' => getenv('DETERMINE_ROUTE_BEFORE_APP_MIDDLEWARE') === 'true',
		'addContentLengthHeader' => getenv('ADD_CONTENT_LENGTH_HEADER') === 'false'
    ]
]);

$container = $app->getContainer();

$container['config'] = function() {
	return new Config(__DIR__ . '/../config');
};

date_default_timezone_set($container->config->get('app.timezone'));
ini_set('display_errors', $container->config->get('app.displayErrors'));

$capsule = new Capsule;
$capsule->addConnection($container->config->get('database'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule) {
	return $capsule;
};

$container['translator'] = function ($container) {
    $fallback = $container->config->get('lang.fallback_locale');

    $loader = new FileLoader(
        new Filesystem(), $container->config->get('lang.path')
    );

    $translator = new Translator($loader, $_SESSION['lang'] ?? $fallback);
    $translator->setFallback($fallback);

    return $translator;
};

$container['view'] = function($container) {
	$view = Factory::getEngine();
	$basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new TwigExtension($container->get('router'), $basePath));
	$view->addExtension(new TranslationExtension($container['translator']));
	$view->addExtension(new DebugExtension());
	$view->getEnvironment()->addGlobal('config', $container['config']);
	$view->getEnvironment()->addGlobal('auth', $container['auth']);
	$view->getEnvironment()->addGlobal('flash', $container['flash']);
	$view->getEnvironment()->addGlobal('select', $container['select']);
	$view->getEnvironment()->addGlobal('currency', $container['currency']);

    return $view;
};

LengthAwarePaginator::viewFactoryResolver(function() {
	return new Factory;
});

LengthAwarePaginator::defaultView('includes/pagination/pagination.php');

Paginator::currentPathResolver(function() {
	return strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
});

Paginator::currentPageResolver(function() {
	return $_GET['page'] ?? 1;
});

$container['auth'] = function($container) {
    return new Auth($container);
};

$container['hash'] = function($container) {
    return new Hash($container);
};

$container['validator'] = function($container) {
    return new Validator;
};

$container['flash'] = function($container) {
    return new Messages;
};

$container['csrf'] = function($container) {
    $csrf = new Guard;
    $csrf->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute('csrf_status', false);
        return $next($request, $response);
    });
	
    return $csrf;
};

$container['currency'] = function($container) {
    return new CurrencyConverter($container);
};

$container['select'] = function($container) {
    return new Select;
};

$container['upload'] = function($container) {
    return new Upload($container);
};

$container['mail'] = function($container) {
    return new Mail($container);
};

$container['sms'] = function($container) {
    return new Sms($container);
};

$container['mailChimp'] = function($container) {
    return new Mailchimp($container);
};

$container['notFoundHandler'] = function($container) {
    return new NotFoundHandler($container);
};
/* Un-comment this errorHandler to Activate in LIVE Environment
$container['errorHandler'] = function($container) {
    return new ErrorHandler($container);
};
*/
v::with('Base\\Validation\\Rules\\');

$app->add(new ValidationErrorsMiddleware($container));
$app->add(new OldInputMiddleware($container));
$app->add(new CsrfViewMiddleware($container));
$app->add(new CsrfStatusMiddleware($container));
$app->add($container->csrf);

require __DIR__ . '/../routes/web.php';
