<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Reader;

use App\CommissionCalculation\Infrastructure\Parser\ParserInterface;

class ReaderFactory
{
    public static function make(ParserInterface $parser, \Iterator $iterator): Reader
    {
        return new Reader($iterator, $parser);
    }
}