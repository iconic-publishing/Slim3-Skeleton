<?php

use Base\Controllers\Web\Blog\BlogController;
use Base\Controllers\Web\Home\HomeController;
use Base\Controllers\Web\Contact\ContactController;

$app->get('/', HomeController::class . ':getHome')->setName('getHome');

$app->group('/blog', function($route) {
    $route->get('', BlogController::class . ':getBlogs')->setName('getBlogs');
    $route->get('/{slug}', BlogController::class . ':getBlogDetails')->setName('getBlogDetails');
});

$app->group('/contact', function($route) {
    $route->get('', ContactController::class . ':getContact')->setName('getContact');
    $route->post('', ContactController::class . ':postContact')->setName('postContact');
});
