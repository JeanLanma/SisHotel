<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Resources\Pms\Arrivals\GetArrivals;
use Illuminate\Http\Request;

class ArrivalsController extends Controller
{
    public function getArrivalsJson()
    {
        return response()->json([
            'today' => GetArrivals::GetTodayArrivals(),
        ]);
    }
}
