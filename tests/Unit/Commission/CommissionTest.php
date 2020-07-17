<?php declare(strict_types=1);

namespace Unit\Commission;

use PHPUnit\Framework\TestCase;
use Task\Commission\Commission;

class CommissionTest extends TestCase
{
    public function testSuccess(): void
    {
        $comm = new Commission('EUR', 0, 100, true);
        $this->assertEquals(1.0, $comm->calculate());

        $comm1 = new Commission('USD', 1.1414, 50, true);
        $this->assertEquals(0.44, $comm1->calculate());

        $comm2 = new Commission('ES', 1, 1, false);
        $this->assertIsFloat($comm2->calculate());
        $this->assertEquals(0.02, $comm2->calculate());

        $comm3 = new Commission('0', 0, 0, false);
        $this->assertEquals(0.00, $comm3->calculate());
    }
}