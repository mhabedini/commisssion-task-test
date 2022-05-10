<?php

use App\Services\StringGeneratorA;
use Tests\TestCase;

class TaskATest extends TestCase
{
    public function testTaskV1()
    {
        $result = (new StringGeneratorA)->generate(' ', 1, 20);
        $this->assertEquals($result, '1 2 pa 4 pow pa 7 8 pa pow 11 pa 13 14 papow 16 17 pa 19 pow');
    }

}
