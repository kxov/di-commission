<?php declare(strict_types=1);

namespace Unit\Checker;

use PHPUnit\Framework\TestCase;
use Task\Util\Checker;

class CheckerTest extends TestCase
{
    public function testCorrect(): void
    {
        $this->assertTrue(Checker::check('SE'));

        $this->assertFalse(Checker::check('UA'));
    }
}