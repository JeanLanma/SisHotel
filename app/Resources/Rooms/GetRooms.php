<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\Room;
use App\Models\Admin\Rooms\RoomType;

class GetRooms {
    
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