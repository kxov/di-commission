<?php declare(strict_types=1);

namespace Unit\Domain\CardBin;

use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Domain\CardBin\CardBin;

class CardBinTest extends TestCase
{
    public function testSuccess()
    {
        $cardBin = new CardBin($alpha2 = 'DK');

        $this->assertEquals($cardBin->getAlpha2(), $alpha2);
    }
}