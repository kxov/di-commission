<?php declare(strict_types=1);

namespace Unit\CommissionCalculation\Domain\Money;

use App\CommissionCalculation\Domain\Currency\Currency;
use App\CommissionCalculation\Domain\Money\Money;
use App\CommissionCalculation\Domain\Money\NegativeMoneyAmount;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testSuccess()
    {
        $money = new Money($amount = 100.00, $currency = new Currency($code = 'USD', $rate = 2.34));

        $this->assertEquals($money->getAmount(), $amount);
        $this->assertEquals($money->getCurrency(), $currency);

        $money1 = new Money(100.00, new Currency($code = 'USD', $rate = 2.34));

        $this->assertTrue($money->isEquals($money1));

        $money2 = new Money(100.01, new Currency($code = 'USD', $rate = 2.34));
        $money3 = new Money(200.00, new Currency($code = 'USD', $rate = 2.34));

        $this->assertFalse($money->isEquals($money2));
        $this->assertFalse($money->isEquals($money3));
    }

    public function testCompare()
    {
        $money = new Money(100,  new Currency($code = 'USD', $rate = 2.34));

        $money1 = new Money(101, new Currency($code = 'USD', $rate = 2.34));

        $this->assertEquals($money1->compareTo($money), 1);
        $this->assertEquals($money->compareTo($money1), -1);

        $money3 = new Money(100, new Currency($code = 'USD', $rate = 2.34));

        $this->assertEquals($money->compareTo($money3), 0);
    }

    public function testNegativeMoneyAmount()
    {
        $this->expectException(NegativeMoneyAmount::class);

        new Money(-500, new Currency($code = 'USD', $rate = 2.34));
    }
}