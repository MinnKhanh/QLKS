<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeImgEnum extends Enum
{
    const ROOM_IMG =  'App\Models\Room';
    const ROOM_TYPE_IMG =  'App\Models\RoomTypeDetail';
    const TYPE_ROOM_IMG = 'App\Models\TypeRoom';
}
