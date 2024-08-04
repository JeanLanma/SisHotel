<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Resources\Rooms\GetRoomTypes;
use Illuminate\Http\Request;

class NewReservationController extends Controller
{
    public function index()
    {
        return inertia('Frontend/Reservations/NewReservation', [
            'RoomTypes' => GetRoomTypes::GetCollection(15)
        ]);
    }
}
