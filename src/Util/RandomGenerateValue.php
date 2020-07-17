<?php declare(strict_types=1);

namespace Task\Util;

final class RandomGenerateValue
{
    public static function getBin(): int
    {
        return rand(111111, 999999);
    }
}