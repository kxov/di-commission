<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Commission;

use App\CommissionCalculation\Domain\Currency\Currency;
use App\CommissionCalculation\Domain\Money\Money;

final class Commission
{
    private const CHECK_CURRENCY = 'EUR';
    private const WITH_EURO      = 0.01;
    private const WITH_OUT_EURO  = 0.02;

    private float $fixed = 0.0;

    private Money  $money;
    private float  $rate;
    private bool   $isEuro;

    public function __construct(
        Money  $money,
        bool   $isEuro
    )
    {
        $this->money  = $money;
        $this->rate   = $money->getCurrency()->getRate();
        $this->isEuro = $isEuro;
    }

    private function roundUp(float $value, int $places = 2): float
    {
        $corrector = pow(10, $places);
        return ceil($value * $corrector) / $corrector;
    }

    public function calculate()
    {
        if ($this->money->getCurrency()->getCode() === self::CHECK_CURRENCY || $this->rate === 0) {
            $this->fixed = $this->money->getAmount();
        }

        if ($this->money->getCurrency()->getCode() !== self::CHECK_CURRENCY && $this->rate > 0) {
            $this->fixed = $this->money->getAmount() / $this->rate;
        }

        return $this->roundUp($this->fixed * ($this->isEuro ? self::WITH_EURO : self::WITH_OUT_EURO));
    }

    public function getCurrency(): Currency
    {
        return $this->money->getCurrency();
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getAmount(): float
    {
        return $this->money->getAmount();
    }

    public function isEuro(): bool
    {
        return $this->isEuro;
    }
}