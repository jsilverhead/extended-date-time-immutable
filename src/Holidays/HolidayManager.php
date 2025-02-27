<?php

namespace App\Holidays;

use App\Holidays\Enum\WeekDaysEnum;

class HolidayManager
{
    public const HOLIDAYS = [
        "01.01" => "New Year Holidays",
        "01.02" => "New Year Holidays",
        "01.03" => "New Year Holidays",
        "01.04" => "New Year Holidays",
        "01.05" => "New Year Holidays",
        "01.06" => "New Year Holidays",
        "01.07" => "New Year Holidays",
        "02.23" => "Men's Day",
        "03.08" => "Women's Day",
        "05.09" => "WW2 Victory Day",
        "06.12" => "Russia Day",
        "11.04" => "Union Day",
        "31.12" => "New Year Eve",
    ];

    // TODO: Добавь праздники на разные локали
    public function isHoliday(\DateTimeImmutable $date): bool
    {
        return array_key_exists($date->format("m.d"), self::HOLIDAYS);
    }

    public function whatHoliday(\DateTimeImmutable $date): string
    {
        if ($this->isHoliday($date)) {
            return self::HOLIDAYS[$date->format("m.d")];
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
}
