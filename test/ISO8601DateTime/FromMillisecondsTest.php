<?php

namespace ooDateTime\test\ISO8601DateTime;

use src\ISO8601DateTime\FromMilliseconds;
use PHPUnit\Framework\TestCase;
use \Exception;

class FromMillisecondsTest extends TestCase
{
    public function testCorrectFormat()
    {
        $this->assertEquals(
            (new FromMilliseconds('1504534440'))
                ->value(),
            '2017-09-04T14:14:00+00:00'
        );
    }

    public function testWrongFormat()
    {
        try {
            (new FromMilliseconds('sdf4564df'))->value();
        } catch (Exception $e) {
            return;
        }

        $this->fail('Datetime is not represented in milliseconds.');
    }
}
