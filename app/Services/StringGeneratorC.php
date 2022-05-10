<?php

namespace App\Services;

class StringGeneratorC extends StringGenerator
{
    public function generate(string $separator, int $from, int $to)
    {
        $string = '';
        for ($i = $from; $i <= $to; $i++) {
            $separator = $i === $to ? '' : $separator;
            if (in_array($i, [1, 4, 9], true) && $i > 5) {
                $string .= 'jofftchoff'.$separator;
            } elseif ($i > 5) {
                $string .= 'tchoff'.$separator;
            } elseif (in_array($i, [1, 4, 9], true)) {
                $string .= 'joff'.$separator;
            } else {
                $string .= $i.$separator;
            }
        }
        return $string;
    }

    private function generateStringBasedOnCondition($input, $condition, $output)
    {

    }
}
