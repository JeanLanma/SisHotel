<?php

namespace App\Http\Controllers\Admin\Rooms;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rooms\RoomType;
use App\Resources\Rooms\GetRoomTypes;
use App\Resources\Rooms\StoreRoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $RoomTypes = GetRoomTypes::GetCollection(15, GetRoomTypes::useCollectionFilters(request()->query()));
        return inertia('Frontend/Admin/Rooms/ShowRoomTypes',
            ['RoomTypes' => $RoomTypes]
        );
    }
    public function store(Request $request)
    {
        return redirect()->route('admin.rooms.room-types.index',
            ['store' => StoreRoomType::FromRequest($request)]
        );
    }
    public function edit()
    {
        $roomTypes = RoomType::all();
        return inertia('Frontend/Admin/Rooms/CreateRoomType',
            ['roomTypes' => $roomTypes]
        );
    }
}
