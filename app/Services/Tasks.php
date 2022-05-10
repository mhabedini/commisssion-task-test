<?php

namespace App\Services;

class Tasks
{
    public static function doTasks(): string
    {
        $string = 'Task v1:'.PHP_EOL;
        $string .= (new StringGeneratorA)->generate(' ', 1, 15).PHP_EOL;
        $string .= 'Task v2:'.PHP_EOL;
        $string .= (new StringGeneratorB())->generate('-', 1, 15).PHP_EOL;
        $string .= 'Task v3:'.PHP_EOL;
        $string .= (new StringGeneratorC())->generate('-', 1, 10);
        return $string;
    }
}
