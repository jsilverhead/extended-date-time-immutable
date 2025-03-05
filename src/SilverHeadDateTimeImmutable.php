<?php

namespace App;

use App\Formatter\Formatter;
use App\Formatter\TimeZoneFormatter;
use App\HolidayManager\HolidayManager;
use App\Operations\ArithmeticalOperations;
use App\Operations\Enum\RangeStepEnum;
use App\Operations\DateRangeHelper;
use App\Operations\DateComparator;
use DateTimeImmutable;

class SilverHeadDateTimeImmutable
{
    public \DateTimeImmutable $dateTime;
    private ArithmeticalOperations $arithmeticalOperations;
    private DateComparator $dateComparator;
    private TimeZoneFormatter $timeZoneFormatter;
    private Formatter $formatter;

    private DateRangeHelper $dateRangeHelper;

    private HolidayManager $holidayManager;

    private const DECADE = 10;
    private const CENTURY = 100;

    private const MIN_YEAR = 1970;
    private const MAX_YEAR = 5000;

    private const MAX_UNIX_STAMP = 4102444800; // Jan 1, 2100

    private function __construct(\DateTimeImmutable $datetime)
    {
        $this->dateTime = $datetime;
        $this->timeZoneFormatter = new TimeZoneFormatter();
        $this->formatter = new Formatter();
        $this->dateComparator = new DateComparator();
        $this->dateRangeHelper = new DateRangeHelper();
        $this->arithmeticalOperations = new ArithmeticalOperations();
        $this->holidayManager = new HolidayManager();
    }

    /**
     * @psalm-param non-empty-string $dateTime
     * @psalm-param non-empty-string $timeZone
     */
    public static function create(
        string $dateTimeAsString = "now",
        string $timeZone = "UTC"
    ): self {
        try {
            $timeZoneAsObject = new \DateTimeZone($timeZone);
            $extendedDateTimeImmutable = new self(
                new \DateTimeImmutable(
                    datetime: $dateTimeAsString,
                    timezone: $timeZoneAsObject
                )
            );
        } catch (\DateMalformedStringException $e) {
            throw new \InvalidArgumentException(
                "Failed to create DateTimeImmutable from string:" .
                    $e->getMessage()
            );
        }

        return $extendedDateTimeImmutable;
    }

    private static function createInternal(
        \DateTimeImmutable $dateTimeImmutable
    ): self {
        return new self($dateTimeImmutable);
    }

    /**
     * @psalm-param non-empty-string $timezone
     */
    public function convertToTimeZone(string $timezone): self
    {
        $convertedDateTime = $this->timeZoneFormatter->convertToTimeZone(
            dateTime: $this->dateTime,
            timezone: $timezone
        );

        return self::createInternal($convertedDateTime);
    }

    /**
     * @psalm-param non-empty-string $timezone
     */
    public function changeTimeZoneWithoutChangingTime(
        string $timezone
    ): SilverHeadDateTimeImmutable {
        $convertedDateTime = $this->timeZoneFormatter->changeTimeZoneWithoutChangingTime(
            dateTime: $this->dateTime,
            timezone: $timezone
        );

        return self::createInternal($convertedDateTime);
    }

    /**
     * @psalm-param int<1,max> $hours
     */
    public function addHours(int $hours): self
    {
        $summedDateTime = $this->arithmeticalOperations->addHours(
            dateTime: $this->dateTime,
            count: $hours
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * @psalm-param int<1,max> $hours
     */
    public function subHours(int $hours): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subHours(
            dateTime: $this->dateTime,
            count: $hours
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * @psalm-param int<1,max> $minutes
     */
    public function addMinutes(int $minutes): self
    {
        $summedDateTime = $this->arithmeticalOperations->addMinutes(
            dateTime: $this->dateTime,
            count: $minutes
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * @psalm-param int<1,max> $minutes
     */
    public function subMinutes(int $minutes): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subMinutes(
            dateTime: $this->dateTime,
            count: $minutes
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * @psalm-param int<1,max> $seconds
     */
    public function addSeconds(int $seconds): self
    {
        $summedDateTime = $this->arithmeticalOperations->addSeconds(
            dateTime: $this->dateTime,
            count: $seconds
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * @psalm-param int<1,max> $seconds
     */
    public function subSeconds(int $seconds): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subSeconds(
            dateTime: $this->dateTime,
            count: $seconds
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * @psalm-param int<1,max> $days
     */
    public function addDays(int $days): self
    {
        $summedDateTime = $this->arithmeticalOperations->addDays(
            dateTime: $this->dateTime,
            count: $days
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * @psalm-param int<1,max> $days
     */
    public function subDays(int $days): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subDays(
            dateTime: $this->dateTime,
            count: $days
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * @psalm-param int<1,max> $weeks
     */
    public function addWeeks(int $weeks): self
    {
        $summedDateTime = $this->arithmeticalOperations->addWeeks(
            dateTime: $this->dateTime,
            count: $weeks
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * @psalm-param int<1,max> $weeks
     */
    public function subWeeks(int $weeks): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subWeeks(
            dateTime: $this->dateTime,
            count: $weeks
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * @psalm-param int<1,max> $months
     */
    public function addMonths(int $months): self
    {
        $summedDateTime = $this->arithmeticalOperations->addMonths(
            dateTime: $this->dateTime,
            count: $months
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * @psalm-param int<1,max> $months
     */
    public function subMonths(int $months): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subMonths(
            dateTime: $this->dateTime,
            count: $months
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * @psalm-param int<1,max> $years
     */
    public function addYears(int $years): self
    {
        $summedDateTime = $this->arithmeticalOperations->addYears(
            dateTime: $this->dateTime,
            count: $years
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * @psalm-param int<1,max> $years
     */
    public function subYears(int $years): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subYears(
            dateTime: $this->dateTime,
            count: $years
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * Прибавить 10 лет
     */
    public function addDecade(): self
    {
        $summedDateTime = $this->arithmeticalOperations->addYears(
            dateTime: $this->dateTime,
            count: self::DECADE
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * Отнять 10 лет
     */
    public function subDecade(): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subYears(
            dateTime: $this->dateTime,
            count: self::DECADE
        );

        return self::createInternal($subbedDateTime);
    }

    /**
     * Прибавляет столетие.
     */
    public function addCentury(): self
    {
        $summedDateTime = $this->arithmeticalOperations->addYears(
            dateTime: $this->dateTime,
            count: self::CENTURY
        );

        return self::createInternal($summedDateTime);
    }

    /**
     * Отнимает столетие.
     */
    public function subCentury(): self
    {
        $subbedDateTime = $this->arithmeticalOperations->subYears(
            dateTime: $this->dateTime,
            count: self::CENTURY
        );

        return self::createInternal($subbedDateTime);
    }

    public function toFormattedDateTime(): string
    {
        return $this->formatter->toFormattedDateTime($this->dateTime);
    }

    public function toISODateTime(): string
    {
        return $this->formatter->toISODateTime($this->dateTime);
    }

    public function getBriefDiffHorHumans(
        SilverHeadDateTimeImmutable $dateTime
    ): string {
        return $this->formatter->getBriefDiffHorHumans(
            coreDateTime: $this->dateTime,
            diffDate: $dateTime->dateTime
        );
    }

    public function getFullDiffForHumans(
        SilverHeadDateTimeImmutable $dateTime,
        string $locale = "en"
    ): string {
        return $this->formatter->getFullDiffForHumans(
            coreDateTime: $this->dateTime,
            dateTime: $dateTime->dateTime,
            locale: $locale
        );
    }

    public function getDate(): string
    {
        return $this->formatter->getDate($this->dateTime);
    }

    public function getDateUSFormat(): string
    {
        return $this->formatter->getDateUSFormat($this->dateTime);
    }

    public function getTime(): string
    {
        return $this->formatter->getTime($this->dateTime);
    }

    public function getLastDayOfMonth(): SilverHeadDateTimeImmutable
    {
        return $this->formatter->getLastDayOfMonth($this->dateTime);
    }

    public function getLastDayOfMonthAsString(): string
    {
        return $this->formatter->getLastDayOfMonthAsString($this->dateTime);
    }

    public function getLocaleStringDate(string $locale = "en"): string
    {
        return $this->formatter->getLocaleStringDate(
            dateTime: $this->dateTime,
            locale: $locale
        );
    }

    public function isBefore(SilverHeadDateTimeImmutable $dateTime): bool
    {
        return $this->dateComparator->isBefore(
            coreDate: $this->dateTime,
            matchingDate: $dateTime
        );
    }

    public function isAfter(SilverHeadDateTimeImmutable $dateTime): bool
    {
        return $this->dateComparator->isAfter(
            coreDate: $this->dateTime,
            matchingDate: $dateTime
        );
    }

    public function isSame(SilverHeadDateTimeImmutable $dateTime): bool
    {
        return $this->dateComparator->isSame(
            coreDate: $this->dateTime,
            matchingDate: $dateTime
        );
    }

    public function isInRange(
        SilverHeadDateTimeImmutable $startDate,
        SilverHeadDateTimeImmutable $endDate
    ): bool {
        return $this->dateComparator->isInRange(
            initialDateTime: $this->dateTime,
            startDateTime: $startDate,
            endDateTime: $endDate
        );
    }

    public function getRangeArray(
        SilverHeadDateTimeImmutable $endDateTime,
        RangeStepEnum $step
    ): array {
        return $this->dateRangeHelper->getRangeArray(
            startDateTime: $this,
            endDateTime: $endDateTime,
            step: $step
        );
    }

    public function getRangeArrayOfStrings(
        SilverHeadDateTimeImmutable $endDateTime,
        RangeStepEnum $step
    ): array {
        return $this->dateRangeHelper->getRangeArrayOfStrings(
            startDateTime: $this->dateTime,
            endDateTime: $endDateTime,
            step: $step
        );
    }

    public static function createRandomDate(
        int $fromYear = self::MIN_YEAR,
        int $toYear = self::MAX_YEAR
    ): self {
        $randomDateTime = self::calculateRandomDate(
            fromYear: $fromYear,
            toYear: $toYear
        );

        return self::createInternal($randomDateTime);
    }

    public function isHoliday(): bool
    {
        return $this->holidayManager->isHoliday($this->dateTime);
    }

    public function whatHoliday(): string
    {
        return $this->holidayManager->whatHoliday($this->dateTime);
    }

    public function isWeekend(): bool
    {
        return $this->holidayManager->isWeekend($this->dateTime);
    }

    public function getAge(): array
    {
        return $this->arithmeticalOperations->getAge($this->dateTime);
    }

    private static function calculateRandomDate(
        int $fromYear,
        int $toYear
    ): \DateTimeImmutable {
        $year = random_int(min: $fromYear, max: $toYear);
        $month = random_int(1, 12);
        $day = 0;

        switch ($month) {
            case 4 === $month || 6 === $month || 9 === $month || 11 === $month:
                $day = random_int(1, 30);
                break;
            case 1 === $month ||
                3 === $month ||
                5 === $month ||
                7 === $month ||
                8 === $month ||
                10 === $month ||
                12 === $month:
                $day = random_int(1, 31);
                break;
            case ($month = 2):
                is_float($year / 400)
                    ? ($day = random_int(1, 28))
                    : ($day = random_int(1, 29));
                break;
        }

        $dateAsSting = "{$year}-{$month}-{$day}";

        return new \DateTimeImmutable($dateAsSting);
    }

    public static function createFromUnixStamp(int $unix): self
    {
        if ($unix < 0 || $unix > self::MAX_UNIX_STAMP) {
            throw new \InvalidArgumentException();
        }

        return self::createInternal(new \DateTimeImmutable("@" . $unix));
    }

    public function convertToUnixStamp(): int
    {
        return $this->dateTime->getTimestamp();
    }

    public function getTimeZone(): \DateTimeZone
    {
        return $this->dateTime->getTimezone();
    }

    public function getTimeZoneAsString(): string
    {
        return $this->dateTime->getTimezone()->getName();
    }

    public function format(string $format): string
    {
        return $this->dateTime->format($format);
    }

    public static function createFromFormat(string $format, string $value): self
    {
        try {
            $dateTimeImmutable = DateTimeImmutable::createFromFormat(
                $format,
                $value
            );
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException(
                "Cannot create date from format: " . $e->getMessage()
            );
        }

        return self::createInternal($dateTimeImmutable);
    }
}
