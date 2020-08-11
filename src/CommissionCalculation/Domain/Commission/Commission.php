<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Commission;

final class Commission
{
    private const CHECK_CURRENCY = 'EUR';
    private const WITH_EURO      = 0.01;
    private const WITH_OUT_EURO  = 0.02;

    private float $fixed = 0.0;

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

    private function roundUp(float $value, int $places = 2): float
    {
        $corrector = pow(10, $places);
        return ceil($value * $corrector) / $corrector;
    }

    public function calculate()
    {
        if ($this->currency === self::CHECK_CURRENCY || $this->rate === 0) {
            $this->fixed = $this->amount;
        }

        if ($this->currency !== self::CHECK_CURRENCY && $this->rate > 0) {
            $this->fixed = $this->amount / $this->rate;
        }

        return $this->roundUp($this->fixed * ($this->isEuro ? self::WITH_EURO : self::WITH_OUT_EURO));
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