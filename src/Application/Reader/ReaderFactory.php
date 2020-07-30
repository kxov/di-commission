<?php declare(strict_types=1);

namespace Task\Application\Reader;

use Task\Application\Parser\ParserInterface;

class ReaderFactory
{
    public static function make(ParserInterface $parser, \Iterator $iterator): Reader
    {
        return new Reader($iterator, $parser);
    }
}