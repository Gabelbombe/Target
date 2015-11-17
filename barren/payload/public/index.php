<?php error_reporting(-1); ini_set('error_reporting', E_ALL);

// define a working directory
define('APP_PATH', getenv('APP_PATH'));

require APP_PATH . '/src/Barren/Map.php';
$barren = New \Barren\Map([[0, 0], [200, 200]]);
$barren->setCoords('{"12 48 87 51", "12 98 87 101", "30 13 33 136", "65 13 68 136"}')
       ->graph()
       ->plot();
