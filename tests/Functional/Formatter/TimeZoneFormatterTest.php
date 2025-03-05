<?php

namespace App\Tests\Functional\Formatter;

use App\SilverHeadDateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class TimeZoneFormatterTest extends TestCase
{
    public function testConvertToTimeZone(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create(
            dateTimeAsString: "2025-10-01 12:00:00",
            timeZone: "Europe/Paris"
        );
        $newTimeZone = "America/New_York";

        $newDateTime = $dateTime->convertToTimeZone($newTimeZone);

        self::assertEquals(
            $newTimeZone,
            $newDateTime->dateTime->getTimezone()->getName()
        );
        self::assertEquals(
            "2025-10-01 06:00:00",
            $newDateTime->dateTime->format("Y-m-d H:i:s")
        );
    }

    public function testConvertToTimeZoneWithoutOffset(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create(
            dateTimeAsString: "2025-10-01 12:00:00",
            timeZone: "Europe/Paris"
        );
        $newTimeZone = "America/New_York";

        $newDateTime = $dateTime->changeTimeZoneWithoutChangingTime(
            $newTimeZone
        );

        self::assertEquals(
            "America/New_York",
            $newDateTime->dateTime->getTimezone()->getName()
        );
        self::assertSame(
            $newDateTime->dateTime->format("Y-m-d H:i:s"),
            $dateTime->dateTime->format("Y-m-d H:i:s")
        );
    }

    public function testGetTimezoneSuccess(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create();
        $timeZone = $dateTime->getTimeZone();

        $this->assertInstanceOf(
            expected: DateTimeZone::class,
            actual: $timeZone
        );
    }

    public function testGetTimezoneAsString(): void
    {
        $expectedTimeZone = "Europe/Paris";
        $dateTime = SilverHeadDateTimeImmutable::create(
            timeZone: $expectedTimeZone
        );
        $timeZone = $dateTime->getTimeZoneAsString();

        $this->assertSame(expected: $expectedTimeZone, actual: $timeZone);
    }
}
