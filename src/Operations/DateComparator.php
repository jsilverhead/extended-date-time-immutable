<?php

namespace App\Operations;

use App\ExtendedDateTimeImmutable;
use DateTimeImmutable;

class DateComparator
{
    public function isBefore(
        DateTimeImmutable $coreDate,
        ExtendedDateTimeImmutable $matchingDate
    ): bool {
        return $coreDate < $matchingDate->dateTime;
    }

    public function isAfter(
        DateTimeImmutable $coreDate,
        ExtendedDateTimeImmutable $matchingDate
    ): bool {
        return $coreDate > $matchingDate->dateTime;
    }

    public function isSame(
        DateTimeImmutable $coreDate,
        ExtendedDateTimeImmutable $matchingDate
    ): bool {
        return $coreDate->format("c") === $matchingDate->dateTime->format("c");
    }

    public function isInRange(
        DateTimeImmutable $initialDateTime,
        ExtendedDateTimeImmutable $startDateTime,
        ExtendedDateTimeImmutable $endDateTime
    ): bool {
        if ($startDateTime->dateTime > $endDateTime->dateTime) {
            throw new \InvalidArgumentException(
                "Start date must be less than end date"
            );
        }

        return $initialDateTime >= $startDateTime->dateTime &&
            $initialDateTime <= $endDateTime->dateTime;
    }
}
