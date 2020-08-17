<?php declare(strict_types=1);

namespace Unit\Domain\Commission;

use App\CommissionCalculation\Domain\Currency\Currency;
use App\CommissionCalculation\Domain\Money\Money;
use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Domain\Commission\Commission;

class CommissionTest extends TestCase
{
    public function testCommissionSuccess()
    {
        $commission = new Commission(
            $money = new Money($amount = 100, $currency = Currency::fromString('EUR')),
            $rate = 0,
            $isEuro = true
        );

        $this->assertEquals($commission->getCurrency(), $currency);
        $this->assertEquals($commission->getRate(), $rate);
        $this->assertEquals($commission->getAmount(), $amount);
        $this->assertEquals($commission->isEuro(), $isEuro);
    }

    /**
     * @dataProvider commissionProvider
     * @param $currency
     * @param $rate
     * @param $amount
     * @param $isEuro
     * @param $expected
     */
    public function testCalculate($amount, $currency, $rate, $isEuro, $expected)
    {
        $commission = new Commission(
            new Money($amount, Currency::fromString($currency)),
            $rate,
            $isEuro
        );

        $this->assertEquals($expected, $commission->calculate());
    }

    public function commissionProvider()
    {
        return [
            1  => [ 100, 'EUR', 0, true, 1.0],
            2  => [ 1.1414, 'USD', 1.1813, true, 0.01],
            3  => [ 10, 'JPY', 126.01, false, 0.01],
            4  => [ 200.12, 'GBP', 0.90173, false, 4.44]
        ];
    }
}