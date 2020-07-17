<?php declare(strict_types=1);

namespace Task\Parser;

interface ParserInterface
{
    public function parse(string $json);
}