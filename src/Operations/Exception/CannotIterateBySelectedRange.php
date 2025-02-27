<?php

namespace App\Operations\Exception;

use App\Operations\Enum\RangeStepEnum;
use DomainException;

class CannotIterateBySelectedRange extends DomainException
{
    public function getType(): string
    {
        return "cannot_iterate_by_selected_range";
    }

    public function getDescription(RangeStepEnum $rangeStepEnum): string
    {
        return "Cannot iterate by selected range: " . $rangeStepEnum->value;
    }
}
