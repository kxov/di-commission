<?php declare(strict_types=1);

namespace Unit\Application\Checker;

use PHPUnit\Framework\TestCase;
use Task\Application\Util\Checker;
use Task\Domain\CardBin\CardBin;

class CheckerTest extends TestCase
{
    public function testCorrect(): void
    {
        $cardBin1 = new CardBin('SE');
        $this->assertTrue(Checker::check($cardBin1));

        $cardBin2 = new CardBin('UA');
        $this->assertFalse(Checker::check($cardBin2));
    }
}