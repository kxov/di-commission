<?php declare(strict_types=1);

namespace Unit\Domain\Commission;

use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Domain\Commission\Commission;

class CommissionTest extends TestCase
{
    public function testCommissionSuccess()
    {
        $commission = new Commission(
            $currency = 'EUR',
            $rate = 0,
            $amount = 100,
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
    public function testCalculate($currency, $rate, $amount, $isEuro, $expected)
    {
        $comm = new Commission($currency, $rate, $amount, $isEuro);

        $this->assertEquals($expected, $comm->calculate());
    }

    public function commissionProvider()
    {
        return [
            1  => ['EUR', 0, 100, true, 1.0],
            2  => ['USD', 1.1414, 50, true, 0.44],
            3  => ['ES', 1, 1, false, 0.02],
            4  => ['0', 0, 0, false, 0.00]
        ];
    }
}