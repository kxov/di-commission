<?php declare(strict_types=1);

namespace Task\Reader;

use Iterator;
use Task\Parser\ParseLineException;
use Task\Parser\ParserInterface;

final class Reader implements ReaderInterface
{
    private Iterator $iterator;
    private ParserInterface $parser;

    public function __construct(Iterator $iterator, ParserInterface $parser)
    {
        $this->iterator = $iterator;
        $this->parser = $parser;
    }

    public function read()
    {
        foreach ($this->iterator as $line) {
            try {
                echo $this->parser->parse($line);
            } catch (ParseLineException $exception) {
                echo $exception->getMessage();
                continue;
            }
            print "\n";
        }
    }
}