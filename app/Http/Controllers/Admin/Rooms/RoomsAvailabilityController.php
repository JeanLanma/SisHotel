<?php

namespace App\Http\Controllers\Admin\Rooms;

use App\Http\Controllers\Controller;
use App\Resources\Rooms\GetRoomAvailability;
use Illuminate\Http\Request;

class RoomsAvailabilityController extends Controller
{
    public function index(Request $request)
    {
        $roomType = $request->room_type;
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $availability = GetRoomAvailability::getAvailabilityByRoomType($roomType, $checkin, $checkout);
        return response()->json($availability);
    }
}
