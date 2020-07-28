<?php declare(strict_types=1);

namespace Unit\Domain\Commission;

use PHPUnit\Framework\TestCase;
use Task\Domain\Commission\Commission;

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
}