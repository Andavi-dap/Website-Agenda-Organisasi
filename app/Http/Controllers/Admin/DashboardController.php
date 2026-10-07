<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic statistics
        $total = Kegiatan::count();
        $upcoming = Kegiatan::whereDate('tanggal', '>', now()->toDateString())->count();
        $finished = Kegiatan::whereDate('tanggal', '<=', now()->toDateString())->count();

        // 7 days ahead (including today)
        $now = Carbon::now();
        $sevenDaysAhead = Kegiatan::where(function ($q) use ($now) {
            $q->whereDate('tanggal', '>=', $now->toDateString())
              ->whereDate('tanggal', '<=', $now->copy()->addDays(7)->toDateString());
        })->count();

        // Incomplete (divisi or pic null/empty)
        $incomplete = Kegiatan::whereNull('divisi')
            ->orWhereNull('pic')
            ->count();

        // Activities per division (including null as "Belum ditentukan")
        $divisions = config('haruna.divisi');
        $divisionCounts = [];
        foreach ($divisions as $div) {
            $divisionCounts[$div] = Kegiatan::where('divisi', $div)->count();
        }
        // Count for not defined division
        $undefinedCount = Kegiatan::whereNull('divisi')->count();
        if ($undefinedCount > 0) {
            $divisionCounts['Belum ditentukan'] = $undefinedCount;
        }

        // Activities per month for current year
        $year = $now->year;
        $monthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $count = Kegiatan::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $m)
                ->count();
            $monthlyCounts[$m] = $count;
        }

        // Nearest upcoming 5 activities
        $nearest = Kegiatan::whereDate('tanggal', '>', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->orderBy('waktu', 'asc')
            ->limit(5)
            ->get();

        // Incomplete list (max 5)
        $incompleteList = Kegiatan::whereNull('divisi')
            ->orWhereNull('pic')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'total',
            'upcoming',
            'finished',
            'sevenDaysAhead',
            'incomplete',
            'divisionCounts',
            'monthlyCounts',
            'nearest',
            'incompleteList'
        ));
    }
}
