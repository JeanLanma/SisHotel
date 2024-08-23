<?php

namespace App\Http\Controllers\Arrivals;

use App\Http\Controllers\Controller;
use App\Resources\Reservations\GetReservations;
use App\Resources\Rooms\GetRooms;
use Illuminate\Http\Request;

class ArrivalsController extends Controller
{
    public function checkin(Request $request, $reservation = null)
    {
        $reservation = GetReservations::GetReservation($reservation);
        $availableRooms = GetRooms::GetRoomTypeAvailabilityByRoomType($reservation->room_type_id, $reservation->checkin, $reservation->checkout);
        // return response()->json($avaialbleRooms);
        return inertia('Frontend/Arrival/CheckinIndex', [
            'Reservation' => $reservation,
            'AvailableRooms' => $availableRooms
        ]);
    }
}
