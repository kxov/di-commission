<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Card;

final class Card
{
    private const EU_COUNTRY_CODES = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'EL',
        'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV',
        'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK'
    ];

    private string $bin;
    private string $countryCode;

    public function __construct(string $bin, string $countryCode)
    {
        $this->bin = $bin;
        $this->countryCode = $countryCode;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function isEuro(): bool
    {
        return in_array($this->getCountryCode(), static::EU_COUNTRY_CODES);
    }
}