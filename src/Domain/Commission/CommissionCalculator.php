<?php declare(strict_types=1);

namespace Task\Domain\Commission;

final class CommissionCalculator
{
    public const CHECK_CURRENCY = 'EUR';
    public const WITH_EURO      = 0.01;
    public const WITH_OUT_EURO  = 0.02;

    private float $fixed = 0.0;

    private Commission $commission;

    public function __construct(Commission $commission)
    {
        $this->commission = $commission;
    }

    public function setCommission(Commission $commission)
    {
        $this->commission = $commission;
    }

    public function calculate()
    {
        if ($this->commission->getCurrency() === self::CHECK_CURRENCY || $this->commission->getRate() === 0) {
            $this->fixed = $this->commission->getAmount();
        }

        if ($this->commission->getCurrency() !== self::CHECK_CURRENCY && $this->commission->getRate() > 0) {
            $this->fixed = $this->commission->getAmount() / $this->commission->getRate();
        }

        return round($this->fixed * ($this->commission->isEuro() ? self::WITH_EURO : self::WITH_OUT_EURO), 2);
    }
}