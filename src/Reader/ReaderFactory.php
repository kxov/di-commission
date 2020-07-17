<?php declare(strict_types=1);

namespace Task\Reader;

use Task\Client\ClientFactory;
use Task\Parser\Parser;

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