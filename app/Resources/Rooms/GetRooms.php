<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\Room;

class GetRooms {
    
        public static function GetCollection($limit = 15, $params = [])
        {
            $params = array_filter($params);
            if (count($params) > 0) {
                return Room::where($params)->paginate($limit);
            }
            return Room::paginate($limit);
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