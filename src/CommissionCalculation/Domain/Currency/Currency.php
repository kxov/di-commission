<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Currency;

final class Currency
{
    private const PATTERN = '/^[A-Z]{3}$/';

    private string $code;
    private float $rate;

    public function __construct(string $value, ?float $rate)
    {
        $this->setCode($value);
        $this->setRate($rate);
    }

    private function setCode(string $value)
    {
        if (!preg_match(self::PATTERN, $value)) {
            throw new BadCurrencyCodeException($value);
        }
        $this->code = $value;
    }

    private function setRate(?float $rate)
    {
        if (is_null($rate)) {
            $this->rate = 0.0;
        } else {
            if ($rate < 0) {
                throw new NegativeCurrencyRate( (string) $rate);
            }
            $this->rate = $rate;
        }
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function isEquals(Currency $currency): bool
    {
        if ($this === $currency) {
            return true;
        }

        return $this->code === $currency->code;
    }
}