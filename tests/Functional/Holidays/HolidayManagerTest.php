<?php

namespace App\Tests\Functional\Holidays;

use App\ExtendedDateTimeImmutable;
use PHPUnit\Framework\TestCase;

class HolidayManagerTest extends TestCase
{
    public function testIsHolidaySuccess(): void
    {
        $holidayDate = ExtendedDateTimeImmutable::create("01.01.2025");

        $this->assertTrue($holidayDate->isHoliday());
    }

    public function testWhatHolidaySuccess(): void
    {
        $holidayDate = ExtendedDateTimeImmutable::create("09.05.2025");

        $this->assertSame(
            expected: "WW2 Victory Day",
            actual: $holidayDate->whatHoliday()
        );
    }

    public function testIsWeekendFail(): void
    {
        $weekendDate = ExtendedDateTimeImmutable::create("next sunday");

        $this->assertTrue($weekendDate->isWeekend());
    }
}
