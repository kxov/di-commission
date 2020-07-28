<?php declare(strict_types=1);

namespace Task\Domain\ExchangeRate;

final class ExchangeRate
{
    private string $currency;
    private ?float $rate;

    public function __construct(string $currency, ?float $rate)
    {
        $this->currency = $currency;
        $this->rate = $rate ?? 0.0;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

}