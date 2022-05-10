<?php

use App\Services\StringGeneratorB;
use Tests\TestCase;

class TaskBTest extends TestCase
{
    public function testTaskV2()
    {
        $result = (new StringGeneratorB)->generate('-', 1, 15);
        $this->assertEquals($result, '1-hatee-3-hatee-5-hatee-ho-hatee-9-hatee-11-hatee-13-hateeho-15');
    }
}
