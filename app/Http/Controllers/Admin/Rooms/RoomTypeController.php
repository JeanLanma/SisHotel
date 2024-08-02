<?php

namespace App\Http\Controllers\Admin\Rooms;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rooms\RoomType;
use App\Resources\Rooms\DeleteRoomType;
use App\Resources\Rooms\GetRoomTypes;
use App\Resources\Rooms\StoreRoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        return inertia('Frontend/Admin/Rooms/ShowRoomTypes',
            ['RoomTypes' => GetRoomTypes::GetCollection(15, GetRoomTypes::useCollectionFilters(request()->query()))]
        );
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.rooms.room-types.index',
            ['store' => StoreRoomType::FromRequest($request)]
        );
    }

    public function edit(Request $request)
    {
        return inertia('Frontend/Admin/Rooms/CreateRoomType',
            ['RoomType' => GetRoomTypes::GetType($request->roomType)]
        );
    }

    public function destroy(Request $request)
    {
        return redirect()->
                    route('admin.rooms.room-types.index')
                    ->with('destroy', DeleteRoomType::Delete($request->roomType));       
    }
}
