<?php

namespace App\Operations;

use DateInterval;

final class ArithmeticalOperations
{
    private function createInterval(string $intervalAsString): DateInterval
    {
        try {
            $dateInterval = new DateInterval($intervalAsString);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException(
                "Unable to create DateInterval object" . $e->getMessage()
            );
        }

        return $dateInterval;
    }

    private function validateCount(int $count): void
    {
        if ($count < 0) {
            throw new \InvalidArgumentException();
        }
    }

    public function addDays(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->add($this->createInterval("P{$count}D"));
    }

    public function addHours(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->add($this->createInterval("PT{$count}H"));
    }

    public function addMinutes(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->add($this->createInterval("PT{$count}M"));
    }

    public function addSeconds(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->add($this->createInterval("PT{$count}S"));
    }

    public function addMonths(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->add($this->createInterval("P{$count}M"));
    }

    public function addYears(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->add($this->createInterval("P{$count}Y"));
    }

    public function addWeeks(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->add($this->createInterval("P{$count}W"));
    }

    public function subDays(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->sub($this->createInterval("P{$count}D"));
    }

    public function subHours(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->sub($this->createInterval("PT{$count}H"));
    }

    public function subMinutes(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->sub($this->createInterval("PT{$count}M"));
    }

    public function subSeconds(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->sub($this->createInterval("PT{$count}S"));
    }

    public function subMonths(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->sub($this->createInterval("P{$count}M"));
    }

    public function subYears(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->sub($this->createInterval("P{$count}Y"));
    }

    public function subWeeks(
        \DateTimeImmutable $dateTime,
        int $count
    ): \DateTimeImmutable {
        $this->validateCount($count);

        return $dateTime->sub($this->createInterval("P{$count}W"));
    }

    /**
     * @psalm-return int<0,max>
     */
    public function getAge(\DateTimeImmutable $birthDate): array
    {
        $now = new \DateTimeImmutable();
        $age = $now->diff($birthDate);

        return [
            "years" => $age->y,
            "months" => $age->m,
        ];
    }
}
