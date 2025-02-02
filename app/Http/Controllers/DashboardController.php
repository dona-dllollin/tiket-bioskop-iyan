<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function managerDashboard()
    {
        $totalMovies = Movie::count();
        $activeMovies = Movie::where('is_showing', true)->count();
        
        // Laporan penjualan bulanan
        $monthlyRevenue = Booking::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');
            
        // Laporan penjualan tahunan
        $yearlyRevenue = Booking::whereYear('created_at', now()->year)
            ->sum('total_price');

        return view('dashboard.manager', compact(
            'totalMovies',
            'activeMovies',
            'monthlyRevenue',
            'yearlyRevenue'
        ));
    }

    public function adminDashboard()
    {
        $todayBookings = Booking::whereDate('created_at', Carbon::today())->count();
        $activeMovies = Movie::where('is_showing', true)->get();
        
        return view('dashboard.admin', compact('todayBookings', 'activeMovies'));
    }

}
