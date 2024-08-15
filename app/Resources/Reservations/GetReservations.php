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
        return Reservation::with([
                                'roomType' => function($query){
                                    $query->select('id', 'name');
                                },
                                'guests' => function($query){
                                    $query->select('id', 'name', 'lastname');
                                },
                            ])->where('checkin', '>=', now())->orderBy('checkin', 'asc')->paginate($limit);
    }
    public static function GetReservation($id)
    {
        return Reservation::with('roomType')->find($id);
    }
}