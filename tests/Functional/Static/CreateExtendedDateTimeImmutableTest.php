<?php

namespace App\Tests\Functional\Static;

use App\ExtendedDateTimeImmutable;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;

class CreateExtendedDateTimeImmutableTest extends TestCase
{
    public function testCreateExtendedDateTimeImmutableSuccess(): void
    {
        $dateAsString = "2020-01-01T00:00:00+00:00";
        $extendedDateTimeImmutable = ExtendedDateTimeImmutable::create(
            $dateAsString
        );

        $this->assertSame(
            expected: $dateAsString,
            actual: $extendedDateTimeImmutable->toISODateTime()
        );
    }

    public function testCreateExtendedDateTimeImmutableWithDateSuccess(): void
    {
        $dateAsString = "2020-01-01";
        $extendedDateTimeImmutable = ExtendedDateTimeImmutable::create(
            $dateAsString
        );

        $this->assertSame(
            expected: $dateAsString . "T00:00:00+00:00",
            actual: $extendedDateTimeImmutable->toISODateTime()
        );
    }

    public function testCreateExtendedDateTimeImmutableFail(): void
    {
        $invalidDateTime = "Christmas";
        $this->expectException(\InvalidArgumentException::class);
        ExtendedDateTimeImmutable::create($invalidDateTime);
    }

    public function testCreateRandomExtendedDateTimeImmutableSuccess(): void
    {
        $dateTime = ExtendedDateTimeImmutable::createRandomDate();

        $dateAsArray = explode(separator: ".", string: $dateTime->getDate());

        $this->assertThat(
            value: $dateAsArray[0],
            constraint: $this->logicalAnd(
                $dateAsArray[0] > 0,
                $this->logicalOr(
                    $dateAsArray[0] < 28,
                    $dateAsArray[0] < 29,
                    $dateAsArray[0] < 30,
                    $dateAsArray[0] < 31
                )
            )
        );
        $this->assertThat(
            value: $dateAsArray[1],
            constraint: $this->logicalAnd(
                $dateAsArray[1] > 0,
                $dateAsArray[1] <= 12
            )
        );
        $this->assertThat(
            value: $dateAsArray[2],
            constraint: $this->logicalAnd(
                $dateAsArray[2] > 1790,
                $dateAsArray[2] <= 5000
            )
        );
    }

    public function testCreateFromUnixStampSuccess(): void
    {
        ClockMock::freeze(new \DateTimeImmutable("2025-01-01T00:00:00+00:00"));
        $unixStamp = time();
        $checkDate = new \DateTimeImmutable();
        ClockMock::reset();

        $newExtendedDateTimeImmutable = ExtendedDateTimeImmutable::createFromUnixStamp(
            $unixStamp
        );

        $this->assertSame(
            expected: $checkDate->format("c"),
            actual: $newExtendedDateTimeImmutable->dateTime->format("c")
        );
    }

    public function testCreateFromFormatSuccess(): void
    {
        $format = "j-M-Y";
        $date = "15-Feb-2009";

        $dateTime = ExtendedDateTimeImmutable::createFromFormat($format, $date);

        $this->assertInstanceOf(
            expected: ExtendedDateTimeImmutable::class,
            actual: $dateTime
        );
        $this->assertSame(expected: $date, actual: $dateTime->format("d-M-Y"));
    }
}
