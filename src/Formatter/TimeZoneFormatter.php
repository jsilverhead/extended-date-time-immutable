<?php

namespace App\Formatter;

class TimeZoneFormatter
{
    public function convertToTimeZone(
        \DateTimeImmutable $dateTime,
        string $timezone
    ): \DateTimeImmutable {
        $dateTimeZone = $this->createTimeZone($timezone);

        return $dateTime->setTimezone($dateTimeZone);
    }

    public function changeTimeZoneWithoutChangingTime(
        \DateTimeImmutable $dateTime,
        string $timezone
    ): \DateTimeImmutable {
        $dateTimeZone = $this->createTimeZone($timezone);

        $newDateTime = $dateTime->setTimezone($dateTimeZone);

        return $newDateTime->modify($dateTime->format("Y-m-d H:i:s"));
    }

    private function createTimeZone(string $timezone): \DateTimeZone
    {
        try {
            $dateTimeZone = new \DateTimeZone($timezone);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException(
                "Could not convert to timezone (" .
                    $timezone .
                    "): " .
                    $e->getMessage()
            );
        }

        return $dateTimeZone;
    }
}
