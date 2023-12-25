<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusPayment extends Enum
{
    const PAID =   1;
    const CANCEL =   2;
    const PENDING = 3;
    public static function getName($type)
    {
        if ($type == 1) return 'Đã trả';
        else if ($type == 2) return 'Đã hủy';
        else if ($type == 3) return 'Đang chờ';
    }
}
