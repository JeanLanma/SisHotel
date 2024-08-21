<?php

namespace App\Http\Controllers\Admin\Rooms;

use App\Http\Controllers\Controller;
use App\Resources\Rooms\GetRooms;
use App\Resources\Rooms\StoreRoom;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        $Rooms = GetRooms::GetCollection(null, ['status' => 'available']);
        return inertia('Frontend/Admin/Rooms/ShowRooms', [
            'Rooms' => $Rooms
        ]);
    }

    public function getRoomsJson(Request $request, $room_type_id)
    {
        return response()->json(GetRooms::Get(15, ['room_type_id' => $room_type_id]));
    }

    public function getRoomAvailabilityJson(Request $request, $room_type_id, $checkin, $checkout)
    {
        return response()->json(GetRooms::GetRoomAvailabilityByRoomType($room_type_id, $checkin, $checkout));
    }

    public function storeRoomsJson(Request $request, $room_type_id)
    {
        return redirect()->back()->with(
            [
                'message' => 'Room created successfully',
                'data' => StoreRoom::fromRequest($request)
            ]
        );
    }

    public function updateRoomJson(Request $request, $room)
    {
        return response()->json(
            [
                'message' => 'Room updated successfully',
                'status' => 'ok',
                'data' => StoreRoom::UpdateRoomStatus($room, $request->status)
            ]
        );
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
