<?php

namespace App\Formatter;

use App\SilverHeadDateTimeImmutable;
use Symfony\Component\HttpFoundation\Exception\JsonException;

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
        \DateTimeImmutable $dateTime,
        string $locale = "en"
    ): string {
        $diff = $coreDateTime->diff($dateTime);

        $contents = $this->loadLocaleFileContents($locale);

        $diffAsArray = array_filter([
            $this->formatUnit($diff->y, $contents["years"]),
            $this->formatUnit($diff->m, $contents["months"]),
            $this->formatUnit($diff->d, $contents["days"]),
            $this->formatUnit($diff->h, $contents["hours"]),
            $this->formatUnit($diff->i, $contents["minutes"]),
            $this->formatUnit($diff->s, $contents["seconds"]),
        ]);

        if (empty($diffAsArray)) {
            return "No difference";
        }

        $difAsString = implode(" and ", $diffAsArray);

        return "Difference in " . $difAsString;
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
    ): SilverHeadDateTimeImmutable {
        $year = (int) $dateTime->format("Y");
        $month = (int) $dateTime->format("m");

        try {
            $firstDayOfMonth = SilverHeadDateTimeImmutable::create(
                "{$year}-{$month}-01"
            );
            $lastDay = $firstDayOfMonth->dateTime->modify(
                "last day of this month"
            );
            $lastDayExtended = SilverHeadDateTimeImmutable::create(
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

    private function loadLocaleFileContents(string $locale): array
    {
        $localeFile =
            getcwd() . "/public/locale/TimeMeasuresLocale_" . $locale . ".json";

        if (!file_exists($localeFile)) {
            throw new \Exception("Locale file not found: " . $localeFile);
        }

        $contentsAsJson = file_get_contents($localeFile);

        try {
            $contentsAsArray = json_decode($contentsAsJson, true);
        } catch (JsonException $e) {
            throw new \JsonException(
                "Unable to parse JSON: " . $e->getMessage()
            );
        }

        return $contentsAsArray;
    }

    private function formatUnit(int $value, array $unit): ?string
    {
        if ($value === 0) {
            return null;
        }

        return $value .
            " " .
            ($value === 1 ? $unit["singular"] : $unit["plural"]);
    }
}
