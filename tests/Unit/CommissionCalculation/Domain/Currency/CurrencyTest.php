<?php declare(strict_types=1);

namespace Unit\Domain\Currency;

use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Domain\Currency\{Currency, BadCurrencyCodeException, NegativeCurrencyRate};

class CurrencyTest extends TestCase
{
    public function testCreateSuccess()
    {
        $currency = new Currency($code = 'USD', $rate = 2.34);

        $this->assertEquals($currency->getCode(), $code);
        $this->assertEquals($currency->getRate(), $rate);

        $this->assertTrue($currency->isEquals($currency));
    }

    public function testEquals()
    {
        $currency1 = new Currency('USD', 2.34);
        $currency2 = new Currency('USD', 2.34);

        $currency3 = new Currency('EUR', 2.34);

        $this->assertTrue($currency1->isEquals($currency2));

        $this->assertFalse($currency1->isEquals($currency3));
    }

    public function testBadeCodeConstructException()
    {
        $this->expectException(BadCurrencyCodeException::class);

        new Currency('EURRR', 23.45 );
    }

    public function testNegativeRateConstructException()
    {
        $this->expectException(NegativeCurrencyRate::class);

        new Currency('EUR', -23.45 );
    }

    public function testNullRate()
    {
        $currency = new Currency('EUR', null);

        $this->assertEquals($currency->getRate(), 0.0);
    }
}