<?php

use Base\Middleware\AuthMiddleware;
use Base\Controllers\BlogController;
use Base\Controllers\ContactController;
use Base\Controllers\StaticSiteController;
use Base\Controllers\Admin\AdminController;
use Base\Controllers\Member\MemberController;
use Base\Controllers\Auth\AuthLoginController;
use Base\Controllers\Auth\AuthLogoutController;
use Base\Controllers\Auth\AuthActivateController;
use Base\Controllers\Auth\AuthRegisterController;
use Base\Controllers\Auth\AuthResetPasswordController;
use Base\Controllers\Auth\AuthRecoverPasswordController;

$app->get('/', StaticSiteController::class . ':index')->setName('index');

$app->group('/blog', function() {
    $this->get('', BlogController::class . ':getBlogs')->setName('getBlogs');
    $this->get('/{slug}', BlogController::class . ':getBlogDetails')->setName('getBlogDetails');
});

$app->group('/contact', function() {
    $this->get('', ContactController::class . ':contact')->setName('contact');
    $this->post('', ContactController::class . ':contactSubmit')->setName('contactSubmit');
});

$app->group('/register', function() {
    $this->get('', AuthRegisterController::class . ':getRegister')->setName('getRegister');
    $this->post('', AuthRegisterController::class . ':postRegister')->setName('postRegister');
});

$app->group('/activatation', function() {
    $this->get('', AuthActivateController::class . ':activate')->setName('activate');
});

$app->group('/login', function() {
    $this->get('', AuthLoginController::class . ':getLogin')->setName('getLogin');
    $this->post('', AuthLoginController::class . ':postLogin')->setName('postLogin');
});

$app->get('/logout', AuthLogoutController::class . ':logout')->setName('logout');

$app->group('/recover-password', function() {
    $this->get('', AuthRecoverPasswordController::class . ':getRecoverPassword')->setName('getRecoverPassword');
    $this->post('', AuthRecoverPasswordController::class . ':postRecoverPassword')->setName('postRecoverPassword');
});

$app->group('/reset-password/{email_address}', function() {
    $this->get('', AuthResetPasswordController::class . ':getResetPassword')->setName('getResetPassword');
    $this->post('', AuthResetPasswordController::class . ':postResetPassword')->setName('postResetPassword');
});

$app->group('/member/{token}', function() {
    $this->get('/dashboard', MemberController::class . ':member')->setName('member');
})->add(new AuthMiddleware($container));

$app->group('/admin/{token}', function() {
    $this->get('/dashboard', AdminController::class . ':admin')->setName('admin');
})->add(new AuthMiddleware($container));
