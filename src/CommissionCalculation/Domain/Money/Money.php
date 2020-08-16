<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Money;

use App\CommissionCalculation\Domain\Currency\Currency;

final class Money
{
    private float $amount;
    private Currency $currency;

    public function __construct(float $amount, Currency $currency)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function isEquals(Money $other): bool
    {
        if ($this === $other) {
            return true;
        }

        return ($this->amount === $other->amount && $this->currency->getCode() === $other->currency->getCode());
    }

    public function compareTo(Money $other): int
    {
        return $this->amount <=> $other->amount;
    }
}