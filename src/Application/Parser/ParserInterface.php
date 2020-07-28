<?php declare(strict_types=1);

namespace Task\Application\Parser;

interface ParserInterface
{
    public function parse(string $json);
}