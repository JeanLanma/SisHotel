<?php

namespace App\Resources\Pms\Arrivals;

use App\Models\Admin\Rooms\Room;
use App\Models\Reservation\Reservation;
use App\Resources\Reservations\GetReservations;
use App\Resources\Rooms\AssignRooms;
use App\Resources\Rooms\GetRooms;

class ReservationCheck {

    /**
     * Checkin a reservation
     * @param Reservation $reservation
     * @param mixed Room|Rooms[] $rooms
     * @return array|false
     */
    public static function In(Reservation $reservation,mixed $rooms)
    {
        $_room = null;
        $pax = ($reservation->adults + $reservation->kids);
        if (is_array($rooms) && count($rooms) > 1) 
        {
            foreach ($rooms as $room) {
                $_room = self::UpdateRoomAsOccupied($room, $pax);
            }
        }
        else if(is_array($rooms) && count($rooms) == 1)
        {
            $_room = self::UpdateRoomAsOccupied($rooms[0], $pax);
        }
        else
        {
            $_room = self::UpdateRoomAsOccupied($rooms, $pax);
        }

        $reservation->status = 'checkedin';
        $reservation->room_id = $_room->id;
        $reservation->save();
        $assigned = AssignRooms::AssignRooms($reservation, $rooms);
        return [
            'reservation' => $reservation,
            'room' => $_room,
            'assigned' => $assigned
        ];
    }
    public static function UpdateRoomAsOccupied($room_id, $pax = 1)
    {
        $room = Room::find($room_id);
        $room->status = 'occupied';
        $room->pax = $pax;
        $room->save();
        return $room;
    }
    public static function Out(){}

}