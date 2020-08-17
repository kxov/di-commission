<?php declare(strict_types=1);

namespace Unit\Domain\ExchangeRate;

use App\CommissionCalculation\Domain\Currency\Currency;
use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Domain\ExchangeRate\ExchangeRate;

class ExchangeRateTest extends TestCase
{
    public function testSuccess()
    {
        $exchangeRate = new ExchangeRate($currency = Currency::fromString('USD'), $rate = 1.1717);

        $this->assertEquals($exchangeRate->getCurrency(), $currency);
        $this->assertEquals($exchangeRate->getRate(), $rate);
    }

    public function testCreateWithNullRate()
    {
        $exchangeRate = new ExchangeRate($currency = Currency::fromString('USD'), null);

        $this->assertEquals($exchangeRate->getCurrency(),  $currency);
        $this->assertEquals($exchangeRate->getRate(),  0.0);
    }
}