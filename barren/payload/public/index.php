<?php error_reporting(-1); ini_set('error_reporting', E_ALL);

// define a working directory
define('APP_PATH', getenv('APP_PATH'));

require APP_PATH . '/src/Barren/Map.php';

                         // y  x    y   x
$barren = New \Barren\Map([[0, 0], [100, 300]]);
$barren->setCoords('{"24 96 175 103", "24 196 175 203", "60 26 67 273", "130 26 137 273"}')
       ->graph()
       ->plot();
