<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Resources\Reservations\GetReservations;
use App\Resources\Reservations\StoreReservation;
use App\Resources\Rooms\GetRoomTypes;
use Illuminate\Http\Request;

class NewReservationController extends Controller
{
    public function index()
    {
        return inertia('Frontend/Reservations/IndexReservations', [
            'UpcomingReservations' => GetReservations::GetUpcomingReservations(15)
        ]);
    }
    public function create()
    {
        return inertia('Frontend/Reservations/NewReservation', [
            'RoomTypes' => GetRoomTypes::GetCollection(15)
        ]);
    }
    public function store(Request $request)
    {
        return redirect()->back()->with([
            'message' => 'Reservación creada correctamente',
            'reservation' => $request->all(),
            'data' => StoreReservation::FromRequest($request)
        ]);
    }
    public function show($reservation)
    {
        return inertia('Frontend/Reservations/ShowReservation', [
            'reservation' => GetReservations::GetReservation($reservation),
            'RoomTypes' => GetRoomTypes::GetCollection(15)
        ]);
    }
}
