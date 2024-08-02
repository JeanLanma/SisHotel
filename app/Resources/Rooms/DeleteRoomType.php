<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\RoomType;

class DeleteRoomType {

    public static function Delete($roomType)
    {
        return RoomType::destroy($roomType) ? true : false;
    }

}