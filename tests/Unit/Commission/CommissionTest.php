<?php declare(strict_types=1);

namespace Unit\Commission;

use PHPUnit\Framework\TestCase;
use Task\Commission\Commission;

class CommissionTest extends TestCase
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
        $this->assertEquals($expected, $comm->calculate());

        $comm1 = new Commission($currency, $rate, $amount, $isEuro);
        $this->assertEquals($expected, $comm1->calculate());

        $comm2 = new Commission($currency, $rate, $amount, $isEuro);
        $this->assertIsFloat($comm2->calculate());
        $this->assertEquals($expected, $comm2->calculate());

        $comm3 = new Commission($currency, $rate, $amount, $isEuro);
        $this->assertEquals($expected, $comm3->calculate());
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