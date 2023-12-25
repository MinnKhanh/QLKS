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
    public static function getName($type)
    {
        if ($type == 1) return 'Trống';
        else if ($type == 2) return 'Đang có khách';
        else if ($type == 3) return 'Đã được đặt trước';
        else if ($type == 4) return 'Đang dọn';
        else if ($type == 5) return 'Đang sửa chữa';
    }
}
