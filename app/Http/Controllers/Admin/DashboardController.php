<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $total = Kegiatan::count();
        $upcoming = Kegiatan::akanDatang()->count();
        $finished = Kegiatan::selesai()->count();
        $sevenDaysAhead = Kegiatan::akanDatang()
            ->where('tanggal', '<=', $now->copy()->addDays(7)->toDateString())
            ->count();

        $incomplete = Kegiatan::whereNull('divisi')
            ->orWhereNull('pic')
            ->orWhere('divisi', '')
            ->orWhere('pic', '')
            ->count();

        $divisions = config('haruna.divisi');
        $divisionCounts = [];
        foreach ($divisions as $div) {
            $divisionCounts[$div] = Kegiatan::where('divisi', $div)->count();
        }

        $undefinedCount = Kegiatan::where(function ($q) {
            $q->whereNull('divisi')->orWhere('divisi', '');
        })->count();
        if ($undefinedCount > 0) {
            $divisionCounts['Belum ditentukan'] = $undefinedCount;
        }

        $year = $now->year;
        $monthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyCounts[$m] = Kegiatan::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $m)
                ->count();
        }

        $nearest = Kegiatan::akanDatang()->orderBy('tanggal', 'asc')->orderBy('waktu', 'asc')->limit(5)->get();
        $incompleteList = Kegiatan::whereNull('divisi')->orWhereNull('pic')->orWhere('divisi', '')->orWhere('pic', '')->limit(5)->get();

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
