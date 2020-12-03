<?php

use Base\Middleware\AuthMiddleware;
use Base\Controllers\Member\Dashboard\MemberController;

$app->group('/member/{token}', function() {
    $this->get('/dashboard', MemberController::class . ':getMember')->setName('getMember');
})->add(new AuthMiddleware($container));