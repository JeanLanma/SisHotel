<?php

namespace App\Resources\Rooms;

use App\Models\Admin\Rooms\RoomType;

class GetRoomTypes {

    public static function GetCollection($limit = 15, $params = [])
    {
        $params = array_filter($params);
        if (count($params) > 0) {
            return RoomType::where($params)->paginate($limit);
        }
        return RoomType::paginate($limit);
    }

    public static function useCollectionFilters($filters)
    {
        if($filters == null) return [];

        $params = [];
        
        if(isset($filters['name'])) $filters['name'];
        if(isset($filters['room_type'])) $filters['room_type'];

        return $params;
    }

}