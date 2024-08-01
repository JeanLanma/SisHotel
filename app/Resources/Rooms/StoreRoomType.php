<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\RoomType;

class StoreRoomType {

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @ref({
     *      name: 'Nueva habitación',
     *      room_type: 'HAB',
     *      base_occupancy: '2',
     *      base_occupancy_kids: '2',
     *      base_price: '1000.00',
     *      base_availability: 1,
     *  })
     * 
     * @return bool
     */
    public function store($roomType)
    {
        return RoomType::create($roomType) ? true : false;
    }

    public static function FromRequest($request)
    {
        return RoomType::create($request->all()) ? true : false;
    }
}