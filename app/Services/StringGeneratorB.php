<?php

namespace App\Services;

class StringGeneratorB extends StringGenerator
{
    public function generate(string $separator, int $from, int $to)
    {
        $string = '';
        for ($i = $from; $i <= $to; $i++) {
            $separator = $i === $to ? '' : $separator;
            if (Math::valueCanBeDividedByANumber($i, 2) && Math::valueCanBeDividedByANumber($i, 7)) {
                $string .= 'hateeho'.$separator;
            } elseif (Math::valueCanBeDividedByANumber($i, 2)) {
                $string .= 'hatee'.$separator;
            } elseif (Math::valueCanBeDividedByANumber($i, 7)) {
                $string .= 'ho'.$separator;
            } else {
                $string .= $i.$separator;
            }
        }
        return $string;
    }
}
