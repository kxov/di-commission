<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\ExchangeRate;

use App\CommissionCalculation\Domain\Currency\Currency;

final class ExchangeRate
{
    private Currency $currency;
    private ?float $rate;

    public function __construct(Currency $currency, ?float $rate)
    {
        $this->currency = $currency;
        $this->rate = $rate ?? 0.0;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}