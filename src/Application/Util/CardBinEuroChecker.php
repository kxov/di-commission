<?php declare(strict_types=1);

namespace Task\Application\Util;

use Task\Domain\CardBin\CardBin;

final class CardBinEuroChecker
{
    public const EU_COUNTRY_CODES = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'EL',
        'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV',
        'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK'
    ];

    public static function check(CardBin $cardBin): bool
    {
        return (in_array($cardBin->getAlpha2(), static::EU_COUNTRY_CODES));
    }
}