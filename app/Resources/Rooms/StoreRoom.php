<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\Room;

class StoreRoom {
    
        public static function Store($room)
        {
            return Room::create($room);
        }

        public static function fromRequest($request)
        {
            if($request->id != null) {
                return Room::where('id', $request->id)->update($request->all());
            } else
            {
                $room = [
                    'room_type_id' => $request->room_type_id,
                    'room' => $request->room,
                    'status' => $request->status,
                    'cleaning_status' => $request->cleaning_status ?? 'dirty',
                    'pax' => $request->pax ?? 0,
                    'ext_number' => $request->ext_number ?? null,
                    'cleaning_time' => $request->cleaning_time ?? null,
                ];

                return self::Store($room);
            }
        }
}