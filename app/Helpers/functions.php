<?php

use Illuminate\Support\Str;

function calculate_number_precision($number): int
{
    $array = explode('.', $number);
    if (isset($array[1])) {
        return Str::length(explode('.', $number)[1]);
    }
    return 0;
}

function format_number($number, $precision): string
{
    return number_format((float)$number, $precision, '.', '');
}

function round_up_number($value, $precision): float|int
{
    $pow = pow(10, $precision);
    return (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
}
