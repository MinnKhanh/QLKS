<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeTimeEnum extends Enum
{
    const DAY =   1;
    const NIGHT =   2;
    const HOUR =   3;
    public static function getName($type)
    {
        if ($type == 1) return 'Ngày';
        else if ($type == 2) return 'Đêm';
        else if ($type == 3) return 'Giờ';
    }
}
