<?php

namespace App\Tests\Functional\Operations;

use App\ExtendedDateTimeImmutable;
use PHPUnit\Framework\TestCase;

class DateComporatorTest extends TestCase
{
    public function testDateIsBeforeSuccess(): void
    {
        $pastDateTime = ExtendedDateTimeImmutable::create("2025-10-01");
        $futureDateTime = ExtendedDateTimeImmutable::create("2025-11-01");

        $this->assertTrue($pastDateTime->isBefore($futureDateTime));
    }

    public function testDateIsAfterSuccess(): void
    {
        $pastDateTime = ExtendedDateTimeImmutable::create("2025-10-01");
        $futureDateTime = ExtendedDateTimeImmutable::create("2025-11-01");

        $this->assertTrue($futureDateTime->isAfter($pastDateTime));
    }

    public function testDateIsSameSuccess(): void
    {
        $dateTime1 = ExtendedDateTimeImmutable::create("2025-10-01");
        $dateTime2 = ExtendedDateTimeImmutable::create("2025-10-01");

        $this->assertTrue($dateTime1->isSame($dateTime2));
    }

    public function testDateIsInRangeSuccess(): void
    {
        $initialDateTime = ExtendedDateTimeImmutable::create("2025-12-11");
        $startDateTime = ExtendedDateTimeImmutable::create("2025-12-10");
        $endDateTime = ExtendedDateTimeImmutable::create("2025-12-15");

        $this->assertTrue(
            $initialDateTime->isInRange(
                startDate: $startDateTime,
                endDate: $endDateTime
            )
        );
    }
}
