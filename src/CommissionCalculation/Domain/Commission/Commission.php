<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Commission;

final class Commission
{
    private string $currency;
    private float  $rate;
    private float  $amount;
    private bool   $isEuro;

    public function __construct(
        string $currency,
        float  $rate,
        float  $amount,
        bool   $isEuro
    )
    {
        $this->currency = $currency;
        $this->rate = $rate;
        $this->amount = $amount;
        $this->isEuro = $isEuro;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function isEuro(): bool
    {
        return $this->isEuro;
    }
}