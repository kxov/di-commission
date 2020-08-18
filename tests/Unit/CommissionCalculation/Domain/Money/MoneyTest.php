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
        $money = new Money($amount = 100.00, $currency = Currency::fromString('USD'));

        $this->assertEquals($money->getAmount(), $amount);
        $this->assertEquals($money->getCurrency(), $currency);

        $money1 = new Money($amount = 100.00, $currency = Currency::fromString('USD'));

        $this->assertTrue($money->isEquals($money1));

        $money2 = new Money($amount = 100.01, $currency = Currency::fromString('USD'));
        $money3 = new Money($amount = 200.00, $currency = Currency::fromString('USD'));

        $this->assertFalse($money->isEquals($money2));
        $this->assertFalse($money->isEquals($money3));
    }

    public function testCompare()
    {
        $money = new Money($amount = 100, $currency = Currency::fromString('USD'));

        $money1 = new Money($amount = 101, $currency = Currency::fromString('USD'));

        $this->assertEquals($money1->compareTo($money), 1);
        $this->assertEquals($money->compareTo($money1), -1);

        $money3 = new Money($amount = 100, $currency = Currency::fromString('USD'));

        $this->assertEquals($money->compareTo($money3), 0);
    }

    public function testNegativeMoneyAmount()
    {
        $this->expectException(NegativeMoneyAmount::class);

        new Money($amount = -500, $currency = Currency::fromString('USD'));
    }
}