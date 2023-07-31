<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Reader;

use Iterator;
use ReturnTypeWillChange;

final class FileIterator implements Iterator
{
    private $handler;
    private $current;

    private int $key = 0;

    public function __destruct()
    {
        fclose($this->handler);
    }

    public function __construct(string $fileName)
    {
        $this->handler = fopen($fileName, 'r');
    }

    #[ReturnTypeWillChange] public function current()
    {
        return $this->current;
    }

    #[ReturnTypeWillChange] public function next(): void
    {
        $this->current = fgets($this->handler);
        $this->key++;
    }

    #[ReturnTypeWillChange] public function key(): int
    {
        return $this->key;
    }

    #[ReturnTypeWillChange] public function valid(): bool
    {
        return ! feof($this->handler);
    }

    #[ReturnTypeWillChange] public function rewind(): void
    {
        rewind($this->handler);
        $this->current = fgets($this->handler);

        $this->key = 0;
    }
}
