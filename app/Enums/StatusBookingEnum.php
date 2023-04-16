<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusBookingEnum extends Enum
{
    const PENDING =   0;
    const ACTIVE =   1;
    const PAID = 2;
}
