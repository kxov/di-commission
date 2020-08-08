<?php declare(strict_types=1);

namespace Unit\Domain\Currency;

use PHPUnit\Framework\TestCase;
use Task\Domain\Currency\Currency;

class CurrencyTest extends TestCase
{
    public function testCreateSuccess()
    {
        $currency = Currency::fromString($rawVal = 'USD');

        $this->assertEquals($currency->getValue(), $rawVal);

        $this->assertTrue($currency->isEquals($currency));
    }

    public function testEquals()
    {
        $currency1 = Currency::fromString('USD');
        $currency2 = Currency::fromString('USD');

        $currency3 = Currency::fromString('EUR');

        $this->assertTrue($currency1->isEquals($currency2));

        $this->assertFalse($currency1->isEquals($currency3));
    }
}