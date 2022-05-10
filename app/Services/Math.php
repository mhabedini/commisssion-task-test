<?php

namespace App\Services;

class Math
{
    public static function valueCanBeDividedByANumber($number, $divideBy)
    {
        return $number % $divideBy == 0;
    }
}
