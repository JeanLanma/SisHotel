<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\AssignedRoom;
use PhpParser\Node\Expr\Assign;

class GetRoomAvailability {
    
    public static function getAvailabilityByRoomType($roomType, $checkin, $checkout)
    {
        $availability = AssignedRoom::where('room_id', $roomType)
            ->where('checkin', '>=', $checkin)
            ->where('checkout', '<=', $checkout)
            ->get();
    }
}