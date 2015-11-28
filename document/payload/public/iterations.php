<?php error_reporting(-1); ini_set('error_reporting', E_ALL);

// define a working directory
define('APP_PATH', getenv('APP_PATH'));
require APP_PATH . '/vendor/autoload.php';

USE \Document\Controller\Bootstrap AS Bootstrap;

// build a dictionary, empty medium
$dictionary =
$mediums    = [];

foreach (glob(APP_PATH . '/public/files/*') AS $file)
{
    $mediums[] = $file;

    $merger = preg_replace('/[^A-Za-z -]/', '', file_get_contents($file));
    $merger = preg_replace('/\s+/', ' ', $merger);
    $merger = strtolower($merger);

    $dictionary = array_flip(array_flip((explode(' ', $merger) + $dictionary)));
}

foreach ($dictionary AS $k => &$word)
{
    if (5 > strlen($word))
    {
        unset($dictionary[$k]);
    }
}

$dictionary = array_filter($dictionary);
sort($dictionary);

foreach (['brute', 'regex', 'index'] AS $type)
{
    $start = microtime(true);
    for( $i= 0 ; $i <= 2000000 ; $i++)
    {
        $payload = [
            'type' => 2,
            'args' => [
                'file' => $file,
                'type' => $type,
                'find' => $dictionary[rand(0, count($dictionary) - 1)],
            ],
        ];

        $bootstrap = New Bootstrap($payload);
        $bootstrap->run();
        unset($bootstrap);
    }
    $elapsed = microtime(true) - $start;

    echo "Time taken for {$type}: {$elapsed}\n";
}

