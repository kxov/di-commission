<?php declare(strict_types=1);

namespace App\CommissionCalculation\Application\Parser;

interface ParserInterface
{
    public function parse(string $json);
}