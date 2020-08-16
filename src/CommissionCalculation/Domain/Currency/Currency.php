<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Currency;

final class Currency
{
    private const PATTERN = '/^[A-Z]{3}$/';

    private string $code;

    private function __construct(string $value)
    {
        if (!preg_match(self::PATTERN, $value)) {
            throw new BadCurrencyCodeException($value);
        }
        $this->code = $value;
    }

    public static function fromString(string $value): Currency
    {
        return new static($value);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function isEquals(Currency $currency): bool
    {
        if ($this === $currency) {
            return true;
        }

        return $this->code === $currency->code;
    }
}