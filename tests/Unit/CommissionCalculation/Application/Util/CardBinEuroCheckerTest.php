<?php declare(strict_types=1);

namespace Unit\Application\Util;

use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Application\Util\CardBinEuroChecker;
use App\CommissionCalculation\Domain\CardBin\CardBin;

class CardBinEuroCheckerTest extends TestCase
{
    public function testCorrect(): void
    {
        $cardBin1 = new CardBin('SE');
        $this->assertTrue(CardBinEuroChecker::check($cardBin1));

        $cardBin2 = new CardBin('UA');
        $this->assertFalse(CardBinEuroChecker::check($cardBin2));
    }
}