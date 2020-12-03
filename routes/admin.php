<?php

use Base\Middleware\AuthMiddleware;
use Base\Controllers\Admin\Dashboard\AdminController;

$app->group('/admin/{token}', function() {
    $this->get('/dashboard', AdminController::class . ':getAdmin')->setName('getAdmin');
})->add(new AuthMiddleware($container));