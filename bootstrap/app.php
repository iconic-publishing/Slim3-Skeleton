<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 2nd April, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

use Dotenv\{
	Dotenv,
	Exception\InvalidPathException
};
use Slim\{
	App,
	Views\TwigExtension,
	Flash\Messages as Flash,
	Csrf\Guard as Csrf
};
use Noodlehaus\Config;
use Illuminate\{
	Database\Capsule\Manager as Capsule,
	Translation\FileLoader,
	Translation\Translator,
	Filesystem\Filesystem,
	Pagination\LengthAwarePaginator,
	Pagination\Paginator
};
use Base\{
	Helpers\Session, 
	Helpers\Input,
	Helpers\Hash,
	View\Extensions\TranslationExtension,
	View\Extensions\DebugExtension,
	View\Factory,
	Auth\Auth,
	Plugins\Select,
	Plugins\CurrencyConverter as Currency,
	Plugins\Upload,
	Validation\Validator,
	Services\Mail\Mailer\Mailer,
	Services\Sms,
	Services\Mailchimp,
	ErrorHandlers\NotFoundHandler,
	ErrorHandlers\ErrorHandler,
	Middleware\OfflineMiddleware,
	Middleware\ValidationErrorsMiddleware,
	Middleware\OldInputMiddleware,
	Middleware\CsrfViewMiddleware,
	Middleware\CsrfStatusMiddleware
};
use Respect\Validation\Validator as v;

//session_cache_limiter(getenv('SESSION_CACHE_LIMITER'));
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

$container['config'] = function ($container) {
	return new Config(__DIR__ . '/../config');
};

date_default_timezone_set($container->config->get('app.timezone'));
ini_set('display_errors', $container->config->get('app.displayErrors'));

$capsule = new Capsule;
$capsule->addConnection($container->config->get('database'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
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

$container['view'] = function ($container) {
	$view = Factory::getEngine();

	$basePath = rtrim(
		str_ireplace(
			'index.php', '', 
			$container->get('request')->getUri()->getScheme() . '://' . 
			$container->get('request')->getUri()->getHost() . 
			$container->get('request')->getUri()->getBasePath()
		)
	);
	
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

LengthAwarePaginator::viewFactoryResolver(function () {
	return new Factory;
});

LengthAwarePaginator::defaultView('includes/pagination/pagination.php');

Paginator::currentPathResolver(function () {
	return strtok($_SERVER['REQUEST_URI'], '?') ?: '/';
});

Paginator::currentPageResolver(function () {
	return Input::get('page') ?: 1;
});

$container['auth'] = function ($container) {
    return new Auth($container);
};

$container['flash'] = function ($container) {
    return new Flash;
};

$container['select'] = function ($container) {
    return new Select;
};

$container['currency'] = function ($container) {
    return new Currency($container);
};

$container['hash'] = function ($container) {
    return new Hash($container);
};

$container['validator'] = function ($container) {
    return new Validator;
};

$container['mail'] = function ($container) {
    $transport = (new Swift_SmtpTransport($container->config->get('mail.host'), $container->config->get('mail.port'), $container->config->get('mail.encryption')))
		->setUsername($container->config->get('mail.username'))
		->setPassword($container->config->get('mail.password'));

    $swift = new Swift_Mailer($transport);

    return (new Mailer($swift, $container->view))->alwaysFrom($container->config->get('mail.from.address'), $container->config->get('mail.from.name'));
};

$container['sms'] = function ($container) {
    return new Sms($container);
};

$container['mailchimp'] = function ($container) {
    return new Mailchimp($container);
};

$container['upload'] = function ($container) {
    return new Upload($container);
};

$container['notFoundHandler'] = function ($container) {
    return new NotFoundHandler($container);
};
/* Un-comment this errorHandler to Activate in LIVE Environment - 500 Error - Server Not Found
$container['errorHandler'] = function ($container) {
    return new ErrorHandler($container);
};
*/
$container['csrf'] = function ($container) {
    $csrf = new Csrf;
    $csrf->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute('csrf_status', false);
        return $next($request, $response);
    });
	
    return $csrf;
};

v::with('Base\\Validation\\Rules\\');

$app->add(new OfflineMiddleware($container))
	->add(new ValidationErrorsMiddleware($container))
	->add(new OldInputMiddleware($container))
	->add(new CsrfViewMiddleware($container))
	->add(new CsrfStatusMiddleware($container))
	->add($container->csrf);

require __DIR__ . '/../routes/web.php';
