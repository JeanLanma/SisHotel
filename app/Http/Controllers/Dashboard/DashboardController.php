<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Resources\Pms\Arrivals\GetArrivals;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $arrivals = GetArrivals::GetDashboard();
        // return response()->json($arrivals);
        return inertia('Frontend/Dashboard/IndexDashboard',[
            'Arrivals' => $arrivals
        ]);
    }
}
