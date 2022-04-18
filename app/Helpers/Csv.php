<?php

namespace App\Helpers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Iterator;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

class Csv implements Arrayable, Jsonable
{
    private array $header = [];
    private Reader $reader;
    private int $offset = 0;
    private int $limit = 100;

    private function __construct()
    {
    }

    public static function createFromPath(string $path, $separator = ','): self
    {
        $csv = new self();
        $csv->reader = Reader::createFromPath($path)->setDelimiter($separator);
        return $csv;
    }


    public static function createFromFile(\SplFileObject $file, $separator = ','): self
    {
        $csv = new self();
        $csv->reader = Reader::createFromFileObject($file)->setDelimiter($separator);
        return $csv;
    }



    public function setHeader(array $header): self
    {
        $this->header = $header;
        return $this;
    }

    public function getIterator(): Iterator
    {
        return $this->processCsv()->getIterator();
    }

    private function processCsv(): TabularDataReader
    {
        $statement = Statement::create()
            ->offset($this->offset)
            ->limit($this->limit);

        return $statement->process($this->reader, $this->header);
    }

    public function toArray(): array
    {
        return json_decode($this->toJson(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    public function toJson($options = 0): bool|string
    {
        $result = $this->processCsv();
        return json_encode($result, JSON_THROW_ON_ERROR);
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }


    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function setSeparator(?string $separator): self
    {
        $this->reader->setDelimiter($separator);
        return $this;
    }
}
