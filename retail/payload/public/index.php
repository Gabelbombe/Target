<?php
// define a working directory
define('APP_PATH', getenv('APP_PATH'));

// load
require APP_PATH . '/vendor/autoload.php';

// init app
$app = New \SlimController\Slim([
    'templates.path'             => APP_PATH . '/src/Retail/View',
    'controller.class_prefix'    => '\\Retail\\Controller',
    'controller.method_suffix'   => 'Action',
    'controller.template_suffix' => 'php',
]);

$app->addRoutes([
    '/'            => 'Index:index',
    '/hello/:name' => 'Index:hello',
]);

// bootstrap routes
$app->run();