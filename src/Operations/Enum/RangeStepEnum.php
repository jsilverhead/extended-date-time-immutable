<?php

namespace App\Operations\Enum;

enum RangeStepEnum: string
{
    case YEAR = "Y";
    case MONTH = "M";
    case DAY = "D";
    case HOUR = "H";
    case MINUTE = "m";
    case SECOND = "S";
}
