<?php

namespace App\Formatter;

use App\ExtendedDateTimeImmutable;

final class Formatter
{
    public function toFormattedDateTime(\DateTimeImmutable $dateTime): string
    {
        return $dateTime->format("r");
    }

    /**
     * Возвращает дату и время в формате ISO 8601.
     *
     * @psalm-return non-empty-string
     */
    public function toISODateTime(\DateTimeImmutable $dateTime): string
    {
        return $dateTime->format("c");
    }

    public function getBriefDiffHorHumans(
        \DateTimeImmutable $coreDateTime,
        \DateTimeImmutable $diffDate
    ): string {
        $diff = $coreDateTime->diff($diffDate);

        $units = [
            "y" => "year(s)",
            "m" => "month(s)",
            "d" => "day(s)",
            "h" => "hour(s)",
            "i" => "minute(s)",
            "s" => "second(s)",
        ];

        foreach ($units as $key => $unit) {
            if ($diff->$key !== 0) {
                return sprintf("Difference in %d %s", $diff->$key, $unit);
            }
        }

        return "No difference";
    }

    public function getFullDiffForHumans(
        \DateTimeImmutable $coreDateTime,
        \DateTimeImmutable $dateTime
    ): string {
        $diff = $coreDateTime->diff($dateTime);

        $diffAsArray = array_filter([
            0 !== $diff->y ? $diff->y . " years" : null,
            0 !== $diff->m ? $diff->m . " months" : null,
            0 !== $diff->d ? $diff->d . " days" : null,
            0 !== $diff->h ? $diff->h . " hours" : null,
            0 !== $diff->i ? $diff->i . " minutes" : null,
            0 !== $diff->s ? $diff->s . " seconds" : null,
        ]);

        $difAsString = implode(" and ", $diffAsArray);

        return "Difference in " . $difAsString;
    }

    public function getFullLocaleDiffForHumans(
        \DateTimeImmutable $coreDateTime,
        \DateTimeImmutable $dateTime
    ): string {
        $diff = $coreDateTime->diff($dateTime);
        $diffAsArray = [];

        $diffAsArray[] = $diff->y . " лет";
        $diffAsArray[] =
            $diff->m > 1 ? $diff->m . " месяцев" : $diff->m . " месяц";
        $diffAsArray[] = $diff->d > 1 ? $diff->d . " дней" : $diff->d . " день";
        $diffAsArray[] = $diff->h > 1 ? $diff->h . " часов" : $diff->h . " час";
        $diffAsArray[] =
            $diff->i > 1 ? $diff->i . " минут" : $diff->i . " минуту";
        $diffAsArray[] =
            $diff->s > 1 ? $diff->s . " секунд" : $diff->s . " секунду";

        $diffAsString = implode(" и ", $diffAsArray);

        return "Разница в " . $diffAsString;
    }

    public function getDate(\DateTimeImmutable $dateTime): string
    {
        return $dateTime->format("d.m.Y");
    }

    public function getDateUSFormat(\DateTimeImmutable $dateTime): string
    {
        return $dateTime->format("Y.m.d");
    }

    public function getTime(\DateTimeImmutable $dateTime): string
    {
        return $dateTime->format("H:i:s");
    }

    public function getLastDayOfMonth(
        \DateTimeImmutable $dateTime
    ): ExtendedDateTimeImmutable {
        $year = (int) $dateTime->format("Y");
        $month = (int) $dateTime->format("m");

        try {
            $firstDayOfMonth = ExtendedDateTimeImmutable::create(
                "{$year}-{$month}-01"
            );
            $lastDay = $firstDayOfMonth->dateTime->modify(
                "last day of this month"
            );
            $lastDayExtended = ExtendedDateTimeImmutable::create(
                $lastDay->format("Y-m-d")
            );
        } catch (\Exception $e) {
            throw new \Exception("Invalid last day of month");
        }

        return $lastDayExtended;
    }

    public function getLastDayOfMonthAsString(
        \DateTimeImmutable $dateTime
    ): string {
        $lastDay = $this->getLastDayOfMonth($dateTime);

        return $lastDay->dateTime->format("Y-m-d");
    }

    // TODO: Сделай разные локали (заебёшься)
    public function getLocaleStringDate(\DateTimeImmutable $dateTime): string
    {
        $year = (int) $dateTime->format("Y");
        $month = (int) $dateTime->format("m");
        $day = (int) $dateTime->format("d");

        return $day .
            " " .
            $this->getLocaleMonthName($month) .
            " " .
            $year .
            " года";
    }

    private function getLocaleMonthName(int $month): string
    {
        return match ($month) {
            1 => "Января",
            2 => "Февраля",
            3 => "Марта",
            4 => "Апреля",
            5 => "Мая",
            6 => "Июня",
            7 => "Июля",
            8 => "Августа",
            9 => "Сентября",
            10 => "Октября",
            11 => "Ноября",
            12 => "Декабря",
        };
    }
}
