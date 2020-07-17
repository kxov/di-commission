<?php declare(strict_types=1);

namespace Task\Commission;

final class Commission
{
    public const CHECK_CURRENCY = 'EUR';

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

    public function calculate()
    {
        $fixed = 0;

        if ($this->currency === self::CHECK_CURRENCY || $this->rate === 0) {
            $fixed = $this->amount;
        }

        if ($this->currency !== self::CHECK_CURRENCY && $this->rate > 0) {
            $fixed = $this->amount / $this->rate;
        }

        return round($fixed * ($this->isEuro ? 0.01 : 0.02), 2);
    }
}