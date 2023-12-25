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
    const PENDING =   4;
    const ACTIVE =   1;
    const PAID = 2;
    const RESERVE = 3;
    public static function getName($type)
    {
        if ($type == 1) return 'Đang hoạt động';
        else if ($type == 2) return 'Đã trả';
        else if ($type == 3) return 'Đã hủy';
        else if ($type == 4) return 'Được đặt trước';
    }
}
