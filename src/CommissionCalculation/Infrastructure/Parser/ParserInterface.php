<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Parser;

interface ParserInterface
{
    public function parse(string $json);
}