<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';

$container = require_once __DIR__ . "/di/{$config['di']}.php";

try {
    $reader = $container->get('reader');
    $reader->read();

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}