<?php

namespace App\Tests\Functional\Formatter;

use App\SilverHeadDateTimeImmutable;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;

class FormatterTest extends TestCase
{
    public function testToFormattedDateTime(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T00:00:00");
        $formattedDateTime = $dateTime->toFormattedDateTime();

        self::assertSame(
            expected: "Wed, 01 Oct 2025 00:00:00 +0000",
            actual: $formattedDateTime
        );
    }

    public function testToIsDateTime(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T00:00:00");
        $formattedDateTime = $dateTime->toISODateTime();

        self::assertSame("2025-10-01T00:00:00+00:00", $formattedDateTime);
    }

    public function testGetBriefDiffHorHumans(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T00:00:00");
        $oneYearDifference = SilverHeadDateTimeImmutable::create(
            "2024-10-01T00:00:00"
        );
        $oneMonthDifference = SilverHeadDateTimeImmutable::create(
            "2025-11-01T00:00:00"
        );
        $oneDayDifference = SilverHeadDateTimeImmutable::create(
            "2025-10-02T00:00:00"
        );
        $oneHourDifference = SilverHeadDateTimeImmutable::create(
            "2025-10-01T01:00:00"
        );
        $oneMinuteDifference = SilverHeadDateTimeImmutable::create(
            "2025-10-01T00:01:00"
        );
        $oneSecondDifference = SilverHeadDateTimeImmutable::create(
            "2025-10-01T00:00:01"
        );
        $diffForYear = $dateTime->getBriefDiffHorHumans($oneYearDifference);
        $diffForMonth = $dateTime->getBriefDiffHorHumans($oneMonthDifference);
        $diffForDay = $dateTime->getBriefDiffHorHumans($oneDayDifference);
        $diffForHour = $dateTime->getBriefDiffHorHumans($oneHourDifference);
        $diffForMinute = $dateTime->getBriefDiffHorHumans($oneMinuteDifference);
        $diffForSecond = $dateTime->getBriefDiffHorHumans($oneSecondDifference);

        $this->assertSame("Difference in 1 year(s)", $diffForYear);
        $this->assertSame("Difference in 1 month(s)", $diffForMonth);
        $this->assertSame("Difference in 1 day(s)", $diffForDay);
        $this->assertSame("Difference in 1 hour(s)", $diffForHour);
        $this->assertSame("Difference in 1 minute(s)", $diffForMinute);
        $this->assertSame("Difference in 1 second(s)", $diffForSecond);
    }

    public function testGetFullDiffForHumans(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T00:00:00");
        $diffDateTime = SilverHeadDateTimeImmutable::create(
            "2025-11-02T00:00:00"
        );
        $brief = $dateTime->getFullDiffForHumans($diffDateTime);

        self::assertSame("Difference in 1 month and 1 day", $brief);
    }

    public function testGetDate(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T00:00:00");
        $date = $dateTime->getDate();

        $this->assertSame("01.10.2025", $date);
    }

    public function testGetDateUSFormat(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T0:00:00");
        $date = $dateTime->getDateUSFormat();

        $this->assertSame("2025.10.01", $date);
    }

    public function testGetTime(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T12:30:00");
        $time = $dateTime->getTime();

        $this->assertSame("12:30:00", $time);
    }

    public function testGetLastDayOfMonth(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-02-01T00:00:00");
        $expectedLastDayOfMonth = SilverHeadDateTimeImmutable::create(
            "2025-02-28T00:00:00"
        );
        $formattedLastDayOfMonth = $dateTime->getLastDayOfMonth();

        $this->assertSame(
            expected: $expectedLastDayOfMonth->dateTime->format("c"),
            actual: $formattedLastDayOfMonth->dateTime->format("c")
        );
    }

    public function testGetLastDayOfMonthAsString(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-02-01T00:00:00");
        $formattedLastDayOfMonth = $dateTime->getLastDayOfMonthAsString();

        $this->assertSame(
            expected: "2025-02-28",
            actual: $formattedLastDayOfMonth
        );
    }

    public function testGetLocaleStringDate(): void
    {
        $dateTime = SilverHeadDateTimeImmutable::create("2025-10-01T00:00:00");
        $localeDateString = $dateTime->getLocaleStringDate("ru");

        $this->assertSame(
            expected: "1 Октября 2025",
            actual: $localeDateString
        );
    }

    public function testGetUnixTimestampSuccess(): void
    {
        $dateAsString = "2025-10-01T00:00:00";
        $dateTime = SilverHeadDateTimeImmutable::create($dateAsString);
        ClockMock::freeze(new \DateTimeImmutable($dateAsString));
        $expectedUnix = time();
        ClockMock::reset();

        $unix = $dateTime->convertToUnixStamp();

        $this->assertSame(expected: $expectedUnix, actual: $unix);
    }
}
