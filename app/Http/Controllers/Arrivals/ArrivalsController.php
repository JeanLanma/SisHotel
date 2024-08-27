<?php

namespace App\Http\Controllers\Arrivals;

use App\Http\Controllers\Controller;
use App\Models\Reservation\Reservation;
use App\Resources\Pms\Arrivals\ReservationCheck;
use App\Resources\Reservations\GetReservations;
use App\Resources\Rooms\GetRooms;
use Illuminate\Http\Request;

class ArrivalsController extends Controller
{
    public function checkin(Request $request, $reservation)
    {
        $reservation = GetReservations::GetReservation($reservation);
        $availableRooms = GetRooms::GetRoomTypeAvailabilityByRoomType($reservation->room_type_id, $reservation->checkin, $reservation->checkout);
        return inertia('Frontend/Arrival/CheckinIndex', [
            'Reservation' => $reservation,
            'AvailableRooms' => $availableRooms
        ]);
    }
    public function makeCheckin(Request $request,Reservation $reservation)
    {
        $Checkin = ReservationCheck::In($reservation, $request->rooms);
        return response()->json($Checkin);
    }
    public function makeCheckout(Request $request,Reservation $reservation)
    {
        $Checkout = ReservationCheck::Out($reservation);
        return response()->json($Checkout);
        return response()->json($Checkout);
    }
}
