<?php

namespace App\Resources\Reservations;

use App\Models\Reservation\Reservation;

class GetReservations
{
    public static function GetCollection($limit = 15)
    {
        return Reservation::with('roomType')->orderBy('created_at', 'desc')->paginate($limit);
    }
    public static function GetUpcomingReservations($limit = 15)
    {
        $todayDate = date('Y-m-d');
        return Reservation::with([
                                'roomType' => function($query){
                                    $query->select('id', 'name');
                                },
                                'guests' => function($query){
                                    $query->select('id', 'name', 'lastname');
                                },
                                'user' => function($query){
                                    $query->select('id', 'name');
                                },
                            ])->where('checkin', '>=', $todayDate)->orderBy('checkin', 'asc')->paginate($limit);
    }
    public static function GetReservation($id)
    {
        return Reservation::with([
            'roomType' => function($query){
                $query->select('*');
            },
            'room' => function($query){
                $query->select(['id', 'room_type_id', 'room', 'status']);
            },
            'guests' => function($query){
                $query->select(['id', 'name', 'lastname', 'phone', 'email', 'created_at']);
            },
            'user' => function($query){
                $query->select(['id', 'name', 'email']);
            },
                        ])->find($id);
    }
}