<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\AssignedRoom;
use App\Models\Admin\Rooms\Room;
use PhpParser\Node\Expr\Assign;

class GetRoomAvailability {
    
    public static function getAvailabilityByRoomType($roomType, $checkin, $checkout)
    {
        $Rooms = Room::where('room_type_id', $roomType)->get();
        return $Rooms;
        $availability = AssignedRoom::where('room_id', $roomType)
            ->where('checkin', '>=', $checkin)
            ->where('checkout', '<=', $checkout)
            ->get();
    }
}