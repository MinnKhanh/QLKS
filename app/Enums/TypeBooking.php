<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeBooking extends Enum
{
    const BOOKATHOTEL =   1;
    const RESERVE =   2;
    public static function getName($type)
    {
        if ($type == 1) return 'Đặt tại khách sạn';
        else if ($type == 2) return 'Đặt trực tuyến(đặt trước)';
    }
}
