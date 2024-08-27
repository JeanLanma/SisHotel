<?php

namespace App\Resources\Pms\Arrivals;

use App\Models\Admin\Rooms\Room;
use App\Models\Admin\Rooms\RoomType;
use App\Models\Reservation\Reservation;
use App\Resources\Rooms\GetRooms;
use Carbon\Carbon;

class GetArrivals {

    public static function GetDashboard()
    {
        // Variables
        $Dashboard = [];
        $tomorrowDate = Carbon::now()->addDay()->format('Y-m-d');
        //
        $Dashboard['today'] = self::GetTodayArrivals();
        $Dashboard['upcoming'] = self::GetArrivalsByDate($tomorrowDate);
        $Dashboard['departures'] = self::GetTodayDepartures();
        $Dashboard['occupied_rooms'] = Room::where('status', 'occupied')->count();
        $Dashboard['available_rooms'] = Room::where('status', 'available')->count();

        return $Dashboard;
    }
    public static function GetTodayArrivals($limit = 100)
    {
        $todayDate = date('Y-m-d');
        return self::GetArrivalsByDate($todayDate, $limit);
    }
    public static function GetTodayDepartures($limit = 100)
    {
        $todayDate = date('Y-m-d');
        return self::GetDeparturesByDate($todayDate, $limit);
    }
    public static function GetArrivalsByDate($date, $limit = 100)
    {
        return Reservation::with([
                                'roomType' => function($query){
                                    $query->select('id', 'name', 'room_type');
                                },
                                'guests' => function($query){
                                    $query->select('id', 'name', 'lastname');
                                },
                                'user' => function($query){
                                    $query->select('id', 'name');
                                },
                            ])
                            ->where('status', 'pending')
                            ->where('checkin', $date)->orderBy('checkin', 'asc')->paginate($limit);
    }
    public static function GetDeparturesByDate($date, $limit = 100)
    {
        return Reservation::with([
                                'roomType' => function($query){
                                    $query->select('id', 'name', 'room_type');
                                },
                                'guests' => function($query){
                                    $query->select('id', 'name', 'lastname');
                                },
                                'user' => function($query){
                                    $query->select('id', 'name');
                                },
                            ])->where('checkout', $date)
                            ->whereNot('status', 'checkedout')
                            ->orderBy('checkout', 'asc')->paginate($limit);
    }
    public static function getArrivalsByPeriod($checkin, $checkout, $limit = 100)
    {
        return Reservation::with([
                                'roomType' => function($query){
                                    $query->select('id', 'name', 'room_type');
                                },
                                'guests' => function($query){
                                    $query->select('id', 'name', 'lastname');
                                },
                                'user' => function($query){
                                    $query->select('id', 'name');
                                },
                            ])->where('checkin', '>=', $checkin)
                            ->where('checkin', '<=', $checkout)
                            ->orderBy('checkin', 'asc')->paginate($limit);
    }

}