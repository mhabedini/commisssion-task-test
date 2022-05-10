<?php

namespace App\Services;

class StringGeneratorA extends StringGenerator
{
    public function generate(string $separator, int $from, int $to)
    {
        $string = '';

        for ($i = $from; $i <= $to; $i++) {
            $separator = $i === $to ? '' : $separator;
            if (Math::valueCanBeDividedByANumber($i, 5) && Math::valueCanBeDividedByANumber($i, 3)) {
                $string .= 'papow'.$separator;
            } elseif (Math::valueCanBeDividedByANumber($i, 3)) {
                $string .= 'pa'.$separator;
            } elseif (Math::valueCanBeDividedByANumber($i, 5)) {
                $string .= 'pow'.$separator;
            } else {
                $string .= $i.$separator;
            }
        }
        return $string;
    }
}
