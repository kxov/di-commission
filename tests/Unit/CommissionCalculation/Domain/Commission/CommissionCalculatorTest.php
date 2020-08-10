<?php declare(strict_types=1);

namespace Unit\Domain\Commission;

use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Domain\Commission\Commission;
use App\CommissionCalculation\Domain\Commission\CommissionCalculator;

class CommissionCalculatorTest extends TestCase
{
    /**
     * @dataProvider commissionProvider
     * @param $currency
     * @param $rate
     * @param $amount
     * @param $isEuro
     * @param $expected
     */
    public function testSuccess($currency, $rate, $amount, $isEuro, $expected): void
    {
        $comm = new Commission($currency, $rate, $amount, $isEuro);

        $commissionCalculator = new CommissionCalculator($comm);

        $this->assertEquals($expected, $commissionCalculator->calculate());

        $comm1 = new Commission($currency, $rate, $amount, $isEuro);
        $commissionCalculator->setCommission($comm1);

        $this->assertEquals($expected, $commissionCalculator->calculate());

        $comm2 = new Commission($currency, $rate, $amount, $isEuro);
        $commissionCalculator->setCommission($comm2);

        $this->assertIsFloat($commissionCalculator->calculate());
        $this->assertEquals($expected, $commissionCalculator->calculate());

        $comm3 = new Commission($currency, $rate, $amount, $isEuro);
        $commissionCalculator->setCommission($comm3);

        $this->assertEquals($expected, $commissionCalculator->calculate());
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