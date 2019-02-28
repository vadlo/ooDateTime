<?php

namespace Meringue\Timeline;

use DateInterval as PHPDateInterval;
use DateTimeImmutable as PHPDateTime;
use Meringue\ISO8601DateTime;
use Meringue\ISO8601Interval;

class Past extends ISO8601DateTime
{
    private $dt;
    private $i;

    public function __construct(ISO8601DateTime $dt, ISO8601Interval $i)
    {
        $this->dt = $dt;
        $this->i = $i;
    }

    public function value(): string
    {
        return
            (new PHPDateTime(
                $this->dt->value()
            ))
                ->sub(
                    new PHPDateInterval($this->i->value())
                )
                ->format('c');
    }
}