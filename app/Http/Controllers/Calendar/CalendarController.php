<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Resources\Calendar\GetDates;
use App\Resources\Rooms\GetRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    
    public function index($from_date = null, $to_date = null)
    {
        $Dates = GetDates::getCollection($from_date, $to_date, 30);

        $from_date = $from_date ?? date('Y-m-d');
        $to_date = $to_date ?? date('Y-m-d', strtotime('30 days'));
        if($Dates->count() == 0) {
            return response()->json([
                'message' => 'No dates found',
                'from_date' => $from_date,
                'to_date' => $to_date,
            ]);
        }
        return inertia('Frontend/Calendar/IndexCalendar', [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'Dates' => GetDates::getCollection($from_date, $to_date, 30),
            'Rooms' => GetRooms::GetCollectionGroupedBy()
        ]);
    }
    public function store($from_date = null, $to_date = null)
    {
        // Check if from_date is a valid date
        $ValidateDates = $this->validateDatesResponse($from_date, $to_date);

        if (!$ValidateDates['is_valid_date']) {
            return response()->json($ValidateDates);
        }

        $response = $this->validateLastDates($from_date);
        if(!$response['validate']) {
            return response()->json($response);
        }

        $from_date = $from_date ?? date('Y-m-d');
        $to_date = $to_date ?? date('Y-m-d', strtotime('+2 years'));
        $dates = [];
        $from_date = strtotime($from_date);
        $to_date = strtotime($to_date);
        for ($i = $from_date; $i <= $to_date; $i = strtotime('+1 day', $i)) {
            $dates[] = [
                'day' => date('d', $i),
                'month' => date('m', $i),
                'year' => date('Y', $i),
            ];
        }
        DB::table('calendar')->insert($dates);

        return response()->json([
            'message' => 'Dates inserted successfully',
        ]);
    }

    public function validateDatesResponse($from_date, $to_date)
    {
        $response = [];
        if (!strtotime($from_date) || !strtotime($to_date)) {
            $response = [
                'message' => 'Invalid date format',
                'string'=> $from_date,
                'format'=> 'Y-m-d',
                'example'=> date('Y-m-d'),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'is_valid_date' => false,
            ];
        } else {
            $response = [
                'message' => 'Valid date format',
                'string'=> $from_date,
                'stringtotime'=> strtotime($from_date),
                'date' => date('Y-m-d', strtotime($from_date)),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'is_valid_date' => true,
            ];
        }
        return $response;
    }
    public function validateLastDates($from_date)
    {
        $response = [];
        $last_date = DB::table('calendar')->latest()->first();
        if (!$last_date) {
            return [
                'message' => 'No dates found',
                'last_date' => null,
                'from_date' => date('Y-m-d', strtotime($from_date)),
                'validate' => true,
            ];
        }
        $last_date = strtotime($last_date->year . '-' . $last_date->month . '-' . $last_date->day);
        $from_date = strtotime($from_date);
        if ($from_date >= $last_date) {
            $response = [
                'message' => 'Dates are not up to date',
                'last_date' => strtotime('Y-m-d', $last_date),
                'from_date' => date('Y-m-d', $from_date),
                'validate' => true,
            ];
        } else {
            $response =[
                'message' => 'Dates are up to date',
                'last_date' => strtotime('Y-m-d', $last_date),
                'from_date' => date('Y-m-d', $from_date),
                'validate' => false,
                
            ];
        }

        return $response;
    }
}