<?php declare(strict_types=1);

namespace Task\Application\Reader;

use Task\Application\Client\ClientFactory;
use Task\Application\Parser\Parser;

class ReaderFactory
{
    public static function make(string $inputFile): Reader
    {
        $client = ClientFactory::create();

        $parser = new Parser($client);
        $iterator = new FileIterator($inputFile);

        return new Reader($iterator, $parser);
    }
}