<?php

namespace App\Http\Controllers\Admin\Rooms;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rooms\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::all();
        return inertia('Frontend/Admin/Rooms/ShowRoomTypes',
            ['roomTypes' => $roomTypes]
        );
    }
}
