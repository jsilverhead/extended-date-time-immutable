<?php

namespace App\Tests\Functional\Operations;

use App\ExtendedDateTimeImmutable;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;

class ArithmeticalOperationsTest extends TestCase
{
    public function testAddHours(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addHours(1);

        $this->assertSame(
            expected: "2025-10-01:13:00:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubHours(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subHours(1);

        $this->assertSame(
            expected: "2025-10-01:11:00:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddMinutes(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addMinutes(1);

        $this->assertSame(
            expected: "2025-10-01:12:01:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubMinutes(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subMinutes(1);

        $this->assertSame(
            expected: "2025-10-01:11:59:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddSeconds(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addSeconds(1);

        $this->assertSame(
            expected: "2025-10-01:12:00:01",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubSeconds(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subSeconds(1);

        $this->assertSame(
            expected: "2025-10-01:11:59:59",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddDays(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addDays(1);

        $this->assertSame(
            expected: "2025-10-02:12:00:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubDays(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subDays(1);

        $this->assertSame(
            expected: "2025-09-30:12:00:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddWeeks(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addWeeks(1);

        $this->assertSame(
            expected: "2025-10-08:12:00:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubWeeks(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subWeeks(1);

        $this->assertSame(
            expected: "2025-09-24:12:00:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddMonths(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addMonths(1);

        $this->assertSame(
            expected: "2025-11-01:12:00:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubMonths(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subMonths(1);

        $this->assertSame(
            expected: "2025-09-01:12:00:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddYears(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addYears(1);

        $this->assertSame(
            expected: "2026-10-01:12:00:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubYears(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subYears(1);

        $this->assertSame(
            expected: "2024-10-01:12:00:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddDecade(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addDecade();

        $this->assertSame(
            expected: "2035-10-01:12:00:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubDecade(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subDecade();

        $this->assertSame(
            expected: "2015-10-01:12:00:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testAddCentury(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $summedDateTime = $dateTime->addCentury();

        $this->assertSame(
            expected: "2125-10-01:12:00:00",
            actual: $summedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testSubCentury(): void
    {
        $dateTime = ExtendedDateTimeImmutable::create("2025-10-01T12:00:00");
        $subbedDateTime = $dateTime->subCentury();

        $this->assertSame(
            expected: "1925-10-01:12:00:00",
            actual: $subbedDateTime->dateTime->format("Y-m-d:H:i:s")
        );
    }

    public function testGetAgeSuccess(): void
    {
        $birthDate = ExtendedDateTimeImmutable::create("1986-05-20T12:00:00");

        ClockMock::freeze(new \DateTimeImmutable("2025-02-27T12:00:00"));
        $age = $birthDate->getAge();
        ClockMock::reset();

        $expectedAge = [
            "years" => 38,
            "months" => 9,
        ];

        $this->assertCount(0, array_diff($expectedAge, $age));
    }
}
