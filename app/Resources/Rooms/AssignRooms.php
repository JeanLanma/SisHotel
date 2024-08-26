<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\AssignedRoom;
use App\Models\Reservation\Reservation;

class AssignRooms {
    
    public static function Assign($reservation, $room)
    {

        return AssignedRoom::create([
            'room_id' => $room,
            'reservation_id' => $reservation->id,
            'user_id' => $reservation->user_id,
            'checkin' => $reservation->checkin,
            'checkout' => $reservation->checkout,
            'status' => 'assigned'
        ]);
    }
    public static function AssignRooms(Reservation $reservation,mixed $rooms)
    {
        $_rooms = null;
        if (is_array($rooms) && count($rooms) > 1) 
        {
            foreach ($rooms as $room) {
                $_rooms[] = self::Assign($reservation, $room);;
            }
        }
        else if(is_array($rooms) && count($rooms) == 1)
        {
            $_rooms[] = self::Assign($reservation, $rooms[0]);
        }
        else
        {
            $_rooms =self::Assign($reservation, $rooms);
        }
        return $_rooms;
    }

    public function Unassign($reservation)
    {
        return AssignedRoom::where('reservation_id', $reservation->id)->delete();
    }
}