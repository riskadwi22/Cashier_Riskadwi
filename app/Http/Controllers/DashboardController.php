<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Selling;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        // Data total hari ini
        $transaction = Selling::whereBetween('created_at', [$today, $tomorrow])->get();
        $count = $transaction->count();

        $updated = Selling::orderBy('created_at', 'desc')->first();

        // 🔥 Data untuk chart: penjualan 7 hari terakhir
        $last7Days = Carbon::now()->subDays(6); // Mulai dari 6 hari lalu sampai hari ini
        $salesPerDay = Selling::where('created_at', '>=', $last7Days)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->locale('id')->translatedFormat('l'); // Hari dalam Bahasa Indonesia
            })
            ->map(function($sales) {
                return $sales->count();
            });

        // Pastikan urutan hari tetap: Senin → Minggu
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $chartLabels = [];
        $chartData = [];

        foreach ($days as $day) {
            $chartLabels[] = $day;
            $chartData[] = $salesPerDay->get($day, 0); // 0 jika tidak ada data
        }

        return view('dashboard', compact('count', 'updated', 'chartLabels', 'chartData'));
    }

}



