<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\Room;

class StoreRoom {
    
        public static function Store($room)
        {
            return Room::create($room);
        }   
}