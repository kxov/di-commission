<?php declare(strict_types=1);

namespace App\CommissionCalculation\Application\Util;

final class RandomGenerateValue
{
    public static function getBin(): int
    {
        return rand(111111, 999999);
    }
}