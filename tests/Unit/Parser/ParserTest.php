<?php declare(strict_types=1);

namespace Unit\Parser;

use PHPUnit\Framework\TestCase;
use Task\Client\ClientFactory;
use Task\Parser\ParseLineException;
use Task\Parser\Parser;

class ParserTest extends TestCase
{
    protected Parser $parser;

    public function setUp(): void
    {
        $this->parser = new Parser(ClientFactory::create());
    }

    /**
     * @dataProvider getJsonLine
     * @param string $line
     * @param $expectedCommission
     * @throws ParseLineException
     */
    public function testCorrectParserParseOneLine(string $line, $expectedCommission): void
    {
        $this->assertEquals($expectedCommission, $this->parser->parse($line));
    }

    /**
     * @dataProvider getInvalidData
     * @param string $line
     * @throws ParseLineException
     */
    public function testFailedWhenParseInvalidData(string $line): void
    {
        $this->expectException(ParseLineException::class);
        $this->parser->parse($line);
    }

    public function getJsonLine()
    {
        yield ['{"bin":"45717360","amount":"100.00","currency":"EUR"}', 1.0];
        yield ['{"bin":"516793","amount":"50.00","currency":"USD"}', 0.43];
    }

    public function getInvalidData()
    {
        yield ['{}'];
        yield ['{"bin":"45717360"}'];
    }
}