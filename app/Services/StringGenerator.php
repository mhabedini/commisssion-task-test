<?php

namespace App\Services;

abstract class StringGenerator
{
    abstract public function generate(string $separator, int $from, int $to);
}
