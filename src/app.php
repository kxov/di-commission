<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Task\Application\Parser\Parser;
use Task\Application\Client\ClientFactory;
use Task\Application\Reader\{FileIterator, ReaderFactory};

$inputFile = __DIR__ . '/../input/input.txt';

try {

    $parser = new Parser(ClientFactory::create());
    $fileIterator = new FileIterator($inputFile);

    $reader = ReaderFactory::make($parser, $fileIterator);
    $reader->read();

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}