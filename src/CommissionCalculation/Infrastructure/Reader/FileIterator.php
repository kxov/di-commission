<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Reader;

use Iterator;

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

    public function current()
    {
        return $this->current;
    }

    public function next()
    {
        $this->current = fgets($this->handler);
        $this->key++;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return ! feof($this->handler);
    }

    public function rewind()
    {
        rewind($this->handler);
        $this->current = fgets($this->handler);

        $this->key = 0;
    }
}