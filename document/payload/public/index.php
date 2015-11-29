<?php error_reporting(-1); ini_set('error_reporting', E_ALL);

// define a working directory
define('APP_PATH', getenv('APP_PATH'));
require APP_PATH . '/vendor/autoload.php';

USE \Document\Controller\Bootstrap AS Bootstrap;

$payload =
    [
        'type' => (! isset($argv) ?: 0),
        'args' => (! isset($argv) ? $_GET : $argv),
    ];

$bootstrap = New Bootstrap($payload);
$bootstrap->run();