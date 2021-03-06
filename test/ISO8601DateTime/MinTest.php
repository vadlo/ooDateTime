<?php

declare(strict_types=1);

namespace Meringue\Tests\ISO8601DateTime;

use Meringue\ISO8601DateTime\Min;
use Meringue\ISO8601DateTime\FromISO8601;
use Meringue\ISO8601Interval\Floating\FromISO8601 as ISO8601Interval;
use Meringue\Timeline\Point\Future;
use Meringue\Timeline\Point\Now;
use PHPUnit\Framework\TestCase;
use \Exception;

class MinTest extends TestCase
{
    public function testWithTwoArgs()
    {
        $now = new Now();

        $this->assertTrue(
            (new Min(
                $now,
                new Future(
                    $now,
                    new ISO8601Interval('PT1S')
                )
            ))
                ->equalsTo($now)
        );
    }

    public function testWithMultipleArgs()
    {
        $min =
            new Min(
                new FromISO8601('2016-07-12T14:29:17+00:00'),
                new FromISO8601('2015-07-12T14:29:17+00:00'),
                new FromISO8601('2014-11-21T06:04:31+00:00'),
                new FromISO8601('2015-12-21T06:04:31+00:00'),
                new FromISO8601('2016-01-18T06:04:31+00:00'),
                new FromISO8601('2017-09-01T06:04:31+00:00'),
                new FromISO8601('2018-08-17T06:04:31+00:00')
            )
        ;

        $this->assertTrue($min->equalsTo(new FromISO8601('2014-11-21T06:04:31+00:00')));
    }

    public function testWithInvalidArgs()
    {
        try {
            new Min(
                '2016-07-12T14:29:17+00:00',
                '2015-07-12T14:29:17+00:00',
                '2014-11-21T06:04:31+00:00',
                '2015-12-21T06:04:31+00:00',
                '2016-01-18T06:04:31+00:00',
                '2017-09-01T06:04:31+00:00',
                '2018-08-17T06:04:31+00:00'
            );
        } catch (Exception $e) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('Min object can not be created with non-ISO8601DateTime arguments');
    }

    public function testWithLessThanTwoArgs()
    {
        try {
            new Min('2016-07-12T14:29:17+00:00');
        } catch (Exception $e) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('Min object can not be created with less than two arguments');
    }
}
