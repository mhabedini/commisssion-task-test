<?php

use App\Services\StringGeneratorC;
use Tests\TestCase;

class TaskCTest extends TestCase
{
    public function testTaskV3()
    {
        $result = (new StringGeneratorC)->generate('-', 1, 10);
        $this->assertEquals('joff-2-3-joff-5-tchoff-tchoff-tchoff-jofftchoff-tchoff', $result);
    }
}
