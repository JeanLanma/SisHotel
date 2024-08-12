<?php

namespace App\Resources\Calendar;

use App\Models\Calendar\Calendar;

class GetDates
{
    public static function getCollection($from_date = null, $to_date = null, $limit = 15)
    {
        $from_date = $from_date ?? date('Y-m-d');
        $to_date = $to_date ?? date('Y-m-d', strtotime('+1 day'));
        return Calendar::where('day', '>=', $from_date)
            ->where('day', '<=', $to_date)
            ->limit($limit)->get();
    }
    public function getDates($from_date, $to_date)
    {
        $calendar = new Calendar();
        return $calendar->getPeriod($from_date, $to_date);
    }
}