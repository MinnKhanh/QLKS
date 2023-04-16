<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusRoomEnum extends Enum
{
    const EMPTY = 1;
    const ACTIVE = 2;
    const RESERVE = 3;
    const FIXING = 5;
    const PROCESSING = 4;
}
