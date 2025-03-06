<?php

namespace App\HolidayManager;

use App\HolidayManager\Enum\WeekDaysEnum;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class HolidayManager
{
    private array $holidays = [];

    /**
     * @psalm-param non-empty-string $country
     * @throws \JsonException
     */
    public function isHoliday(\DateTimeImmutable $date, string $country): bool
    {
        if (!$this->holidays) {
            $this->holidays = $this->getHolidaysFileContents($country);
        }

        return array_key_exists($date->format("m.d"), $this->holidays);
    }

    /**
     * @psalm-param non-empty-string $country
     * @throws \JsonException
     */
    public function whatHoliday(
        \DateTimeImmutable $date,
        string $country
    ): string {
        if (!$this->holidays) {
            $this->holidays = $this->getHolidaysFileContents($country);
        }

        if ($this->isHoliday(date: $date, country: $country)) {
            return $this->holidays[$date->format("m.d")];
        }

        return "No Holidays.";
    }

    public function isWeekend(\DateTimeImmutable $date): bool
    {
        $whatDay = $date->format("l");

        return match ($whatDay) {
            WeekDaysEnum::SATURDAY->value => true,
            WeekDaysEnum::SUNDAY->value => true,
            default => false,
        };
    }

    private function getHolidaysFileContents(string $country): array
    {
        $path = getcwd() . "/public/holidays/";

        if (!is_dir($path)) {
            throw new \LogicException("Path not found: " . $path);
        }

        $file = file_get_contents($path . $country . ".json");

        if (is_file($file)) {
            throw new \LogicException(
                "Holidays file do not exists. Please check the spelling."
            );
        }

        try {
            $contents = json_decode($file, true);
        } catch (JsonException $e) {
            throw new \JsonException("Invalid JSON: " . $e->getMessage());
        }

        return $contents;
    }
}
