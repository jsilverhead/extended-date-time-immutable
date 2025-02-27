<?php

namespace App\Operations;

use App\ExtendedDateTimeImmutable;
use App\Operations\Enum\RangeStepEnum;

class DateRangeHelper
{
    private function validateDateRange(
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate
    ): void {
        if ($startDate >= $endDate) {
            throw new \LogicException(
                "Start date must be earlier than end date"
            );
        }
    }

    /**
     * @psalm-return array<int,ExtendedDateTimeImmutable>
     */
    public function getRangeArray(
        ExtendedDateTimeImmutable $startDateTime,
        ExtendedDateTimeImmutable $endDateTime,
        RangeStepEnum $step
    ): array {
        $this->validateDateRange(
            startDate: $startDateTime->dateTime,
            endDate: $endDateTime->dateTime
        );

        $dateRangeArray = [];
        $intervalStep = $this->getStepInterval($step);
        $currentDateTime = $startDateTime;

        while ($currentDateTime->dateTime <= $endDateTime->dateTime) {
            $dateRangeArray[] = $currentDateTime;
            $incrementedDateTime = $currentDateTime->dateTime->add(
                $intervalStep
            );
            $currentDateTime = ExtendedDateTimeImmutable::create(
                $incrementedDateTime->format("c")
            );
        }

        return $dateRangeArray;
    }

    /**
     * @return array<int,string>
     */
    public function getRangeArrayOfStrings(
        \DateTimeImmutable $startDateTime,
        ExtendedDateTimeImmutable $endDateTime,
        RangeStepEnum $step
    ): array {
        $this->validateDateRange(
            startDate: $startDateTime,
            endDate: $endDateTime->dateTime
        );

        $currentDateTime = $startDateTime;
        $dateRangeArrayOfStrings = [];
        $stepInterval = $this->getStepInterval($step);

        while ($currentDateTime <= $endDateTime->dateTime) {
            $dateRangeArrayOfStrings[] = $currentDateTime->format("Y-m-d");
            $currentDateTime = $currentDateTime->add($stepInterval);
        }

        return $dateRangeArrayOfStrings;
    }

    private function getStepInterval($step): \DateInterval
    {
        return match ($step) {
            RangeStepEnum::YEAR => new \DateInterval("P1Y"),
            RangeStepEnum::MONTH => new \DateInterval("P1M"),
            RangeStepEnum::DAY => new \DateInterval("P1D"),
            RangeStepEnum::HOUR => new \DateInterval("PT1H"),
            RangeStepEnum::MINUTE => new \DateInterval("PT1M"),
            RangeStepEnum::SECOND => new \DateInterval("PT1S"),
            default => throw new \InvalidArgumentException(
                "Invalid step format"
            ),
        };
    }
}
