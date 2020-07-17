<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Task\Reader\ReaderFactory;

$inputFile = __DIR__ . '/../input/input.txt';

try {

    $reader = ReaderFactory::make($inputFile);
    $reader->read();

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}