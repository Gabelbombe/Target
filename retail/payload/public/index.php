<?php

// define a working directory
define('APP_PATH', getenv('APP_PATH'));

// load
require APP_PATH . '/vendor/autoload.php';

// init app
$app = New \SlimController\Slim([
    'debug'                      => true,
    'templates.path'             => APP_PATH . '/src/Retail/View',
    'controller.class_prefix'    => '\\Retail\\Controller',
    'controller.method_suffix'   => 'Action',
    'controller.template_suffix' => 'php',
]);

$app->addRoutes([
    '/'            => 'Index:index',
    '/product/:id' => 'Product:get',
    '/edit'        => 'Product:edit',
    '/edit/:id'    => 'Product:edit',
    '/add'         => 'Product:add',

    '/product/:name' => ['post' => ['Home:hello', function() {
        error_log("THIS ROUTE IS ONLY POST");
    }]]

]);

// bootstrap routes
$app->run();