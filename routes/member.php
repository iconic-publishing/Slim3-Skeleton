<?php

use Base\Middleware\AuthenticatedMiddleware;
use Base\Middleware\AuthenticatedTokenMiddleware;
use Base\Controllers\Member\Dashboard\MemberController;

$app->group('/member/{token}', function($route) {
    $route->get('/dashboard', MemberController::class . ':getMember')->setName('getMember');
})->add(new AuthenticatedMiddleware($container))->add(new AuthenticatedTokenMiddleware($container));