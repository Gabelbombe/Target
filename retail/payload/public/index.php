<?php

echo json_encode([
    "It's Orange",
    "Slightly chewed on",
    "Unlike the pen, you can write upside-down",
    "Prone to breaking",
]); die;

error_reporting(-1); ini_set('error_reporting', E_ALL);

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
]);

// bootstrap routes
$app->run();