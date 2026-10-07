<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $dashboardData = [
            'totalStudents' => 250,
            'totalCourses' => 12,
            'feesCollected' => 500000,
            'outstandingFees' => 120000,
        ];

        return view('dashboard', $dashboardData);
    }
}
