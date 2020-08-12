<?php declare(strict_types=1);

namespace Unit\Application\Reader;

use PHPUnit\Framework\TestCase;
use App\CommissionCalculation\Infrastructure\Parser\ParserInterface;
use App\CommissionCalculation\Infrastructure\Reader\ReaderFactory;
use App\CommissionCalculation\Infrastructure\Reader\ReaderInterface;

class ReaderFactoryTest extends TestCase
{
    public function testSuccess()
    {
        $parser = $this->createMock(ParserInterface::class);
        $iterator = $this->createMock(\Iterator::class);

        $reader = ReaderFactory::make($parser, $iterator);

        $this->assertInstanceOf(ReaderInterface::class, $reader);

    }
}