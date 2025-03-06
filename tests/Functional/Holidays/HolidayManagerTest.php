<?php

namespace App\Tests\Functional\Holidays;

use App\SilverHeadDateTimeImmutable;
use PHPUnit\Framework\TestCase;

class HolidayManagerTest extends TestCase
{
    public function testIsHolidaySuccess(): void
    {
        $holidayDate = SilverHeadDateTimeImmutable::create("01.01.2025");

        $this->assertTrue($holidayDate->isHoliday("Russia"));
    }

    public function testWhatHolidaySuccess(): void
    {
        $holidayDate = SilverHeadDateTimeImmutable::create("09.05.2025");

        $this->assertSame(
            expected: "День победы",
            actual: $holidayDate->whatHoliday("Russia")
        );
    }

    public function testIsWeekendFail(): void
    {
        $weekendDate = SilverHeadDateTimeImmutable::create("next sunday");

        $this->assertTrue($weekendDate->isWeekend());
    }
}
