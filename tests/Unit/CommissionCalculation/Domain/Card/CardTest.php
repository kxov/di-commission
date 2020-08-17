<?php declare(strict_types=1);

namespace Unit\Domain\CardBin;

use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Domain\Card\Card;

class CardTest extends TestCase
{
    public function testSuccessAndEuroTrue()
    {
        $card = new Card('516793', $countryCode = 'DK');

        $this->assertEquals($card->getCountryCode(), $countryCode);

        $this->assertTrue($card->isEuro());
    }

    public function testSuccessAndEuroFalse()
    {
        $card = new Card('456788', $countryCode = 'UA');

        $this->assertEquals($card->getCountryCode(), $countryCode);

        $this->assertFalse($card->isEuro());
    }
}