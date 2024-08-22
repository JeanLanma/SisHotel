<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\Room;
use App\Models\Admin\Rooms\RoomType;
use App\Models\Reservation\Reservation;
use Carbon\Carbon;

class GetRooms {
    
    public static function Get($limit = 15, $params = [])
    {
        $params = array_filter($params);
        if (count($params) > 0) {
            return Room::where($params)->paginate($limit);
        }
        return Room::paginate($limit);
    }
    public static function GetRoomAvailabilityByRoomType($room_type_id, $checkin, $checkout)
    {
        return Room::where('room_type_id', $room_type_id)
            ->whereDoesntHave('reservations', function($query) use ($checkin, $checkout)
            {
                $query->where('checkin', '<=', $checkin)
                    ->where('checkout', '>=', $checkout);
            })
            ->get();
    }
    public static function GetRoomTypeAvailabilityByRoomType($room_type_id, $checkin, $checkout)
    {
        // Ensure format date is correct yyyy-mm-dd
        $checkin = date('Y-m-d', strtotime($checkin));
        $checkout = date('Y-m-d', strtotime($checkout));
        $_checkout = Carbon::createFromFormat('Y-m-d', $checkout)->addDays(1)->format('Y-m-d');

        $response = [];
        $response['rooms'] = Room::where('room_type_id', $room_type_id)
            ->whereDoesntHave('reservations', function($query) use ($checkin, $checkout, $_checkout)
            {
                // Search for reservations within the checkin and checkout period
                $query->whereDate('checkin', '>=', $checkin)
                    ->whereDate('checkout', '<', $_checkout);
            })
            ->get();
            $response['reserved'] = Reservation::where('room_type_id', $room_type_id)
                                    ->where(function($query) use ($checkin, $_checkout) {
                                        $query->where(function($query) use ($checkin, $_checkout) {
                                            $query->where('checkin', '<', $_checkout)
                                                    ->where('checkout', '>', $checkin);
                                        });
                                    })
                                    ->count();
        $RoomsCount = Room::where('room_type_id', $room_type_id)->count();
        $response['total'] = $RoomsCount;
        $response['available'] = $RoomsCount - $response['reserved'];
        $response['params'] = [
            'checkin' => $checkin,
            'checkout' => $checkout,
            '_checkout' => $_checkout,
            'room_type_id' => $room_type_id
        ];
        return $response;
    }
    public static function GetCollection($limit = 15, $params = [])
    {
        $params = array_filter($params);
        $_Room = RoomType::query();
        $_Room->select(['id', 'name', 'room_type', 'status', 'base_price', 'description']);
        $_Room->with(['rooms' => function($query)
        {
            $query->select(['id', 'room_type_id', 'room', 'status']);
        }]);
        return $_Room->paginate($limit);
        if (count($params) > 0) {
            $_Room = $_Room->where($params);
        }
        return $_Room->paginate($limit)->groupBy('room_type');
    }
    
    public static function GetCollectionGroupedBy($GroupBy = 'Roomtype.room_type')
    {
        return Room::with(['RoomType' => function($query)
        {
            $query->select(['id', 'name', 'room_type', 'status']);
        }])
        ->get(['id', 'room_type_id', 'room', 'status', 'cleaning_status', 'pax', 'ext_number', 'cleaning_time'])
        ->groupBy($GroupBy);    
    }
    public static function GetRoom($id)
    {
        return Room::find($id);
    }

    public static function useCollectionFilters($filters)
    {
        if($filters == null) return [];

        $params = [];
        
        if(isset($filters['room'])) $filters['room'];
        if(isset($filters['room_type_id'])) $filters['room_type_id'];
        if(isset($filters['status'])) $filters['status'];
        if(isset($filters['cleaning_status'])) $filters['cleaning_status'];
        if(isset($filters['pax'])) $filters['pax'];
        if(isset($filters['ext_number'])) $filters['ext_number'];
        if(isset($filters['cleaning_time'])) $filters['cleaning_time'];

        return $params;
    }
}