<?php declare(strict_types=1);

namespace Task\Domain\Currency;

final class Currency
{
    private string $value;

    public static function fromString(string $value): Currency
    {
        $currency = new static();

        $currency->value = $value;

        return $currency;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEquals(Currency $currency): bool
    {
        if ($this === $currency) {
            return true;
        }

        return $this->value === $currency->value;
    }
}