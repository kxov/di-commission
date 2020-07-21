<?php declare(strict_types=1);

namespace Task\Commission;

final class Commission
{
    public const CHECK_CURRENCY = 'EUR';

    private string $currency;
    private float  $rate;
    private float  $amount;
    private bool   $isEuro;

    private float  $fixed = 0.0;

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
        if ($this->currency === self::CHECK_CURRENCY || $this->rate === 0) {
            $this->fixed = $this->amount;
        }

        if ($this->currency !== self::CHECK_CURRENCY && $this->rate > 0) {
            $this->fixed = $this->amount / $this->rate;
        }

        return round($this->fixed * ($this->isEuro ? 0.01 : 0.02), 2);
    }
}