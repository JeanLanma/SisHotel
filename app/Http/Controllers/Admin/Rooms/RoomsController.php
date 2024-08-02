<?php

namespace App\Http\Controllers\Admin\Rooms;

use App\Http\Controllers\Controller;
use App\Resources\Rooms\GetRooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        return inertia('Frontend/Admin/Rooms/ShowRooms');
    }

    public function getRoomsJson(Request $request, $room_type_id)
    {
        return response()->json(GetRooms::GetCollection(15, ['room_type_id' => $room_type_id]));
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.rooms.rooms.index');
    }

    public function edit(Request $request)
    {
        return inertia('Frontend/Admin/Rooms/CreateRoom');
    }

    public function destroy(Request $request)
    {
        return redirect()->route('admin.rooms.rooms.index');
    }
}
