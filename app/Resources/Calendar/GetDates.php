<?php

namespace App\Resources\Calendar;

use App\Models\Calendar\Calendar;

class GetDates
{
    public static function getCollection($from_date = null, $to_date = null)
    {
        $from_date = $from_date ?? date('Y-m-d');
        $to_date = $to_date ?? date('Y-m-d', strtotime('+1 day'));
        return Calendar::limit(15)->get();
    }
    public function getDates($from_date, $to_date)
    {
        $calendar = new Calendar();
        return $calendar->getPeriod($from_date, $to_date);
    }
}