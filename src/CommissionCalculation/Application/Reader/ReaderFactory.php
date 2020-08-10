<?php declare(strict_types=1);

namespace App\CommissionCalculation\Application\Reader;

use App\CommissionCalculation\Application\Parser\ParserInterface;

class ReaderFactory
{
    public static function make(ParserInterface $parser, \Iterator $iterator): Reader
    {
        return new Reader($iterator, $parser);
    }
}