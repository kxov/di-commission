<?php declare(strict_types=1);

namespace Task\Reader;

use Iterator;

final class FileIterator implements Iterator
{
    private $handler;
    private $current;

    private string $fileName;
    private int $key;

    public function __destruct()
    {
        fclose($this->handler);
    }

    public function __construct(string $fileName)
    {
        $this->handler = fopen($fileName, 'r');
        $this->current = fgets($this->handler);

        $this->fileName = $fileName;
        $this->key = 0;
    }

    public function current()
    {
        return $this->current;
    }

    public function next()
    {
       if ($this->valid()) {
           $this->current = fgets($this->handler);
           $this->key++;
       }
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
        $this->__destruct();
        $this->__construct($this->fileName);
    }
}