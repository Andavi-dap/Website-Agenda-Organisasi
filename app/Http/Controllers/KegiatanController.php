<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class KegiatanController extends Controller
{
    // Tampilkan Data
    public function index()
{
    $data = Kegiatan::orderBy('tanggal','asc')->get();

    $latest = Kegiatan::latest()->take(5)->get();

    $notif = Kegiatan::whereDate('tanggal', '>', now()->toDateString())->count();

    return view('kegiatan.index', compact(
        'data',
        'latest',
        'notif'
    ));
}

public function semua()
{
    $data = Kegiatan::orderBy('tanggal', 'asc')->get()->groupBy(function($item){
        return \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F Y');
    });

    return view('kegiatan.semua', compact('data'));
}

    private function checkAdmin()
    {
        $user = session('user');
        $peran = $user['peran'] ?? null;
        $jabatan = $user['jabatan'] ?? '';

        return ($peran === 'Admin') || (
            $jabatan === 'Ketua Himpunan' ||
            $jabatan === 'Wakil Ketua Himpunan' ||
            str_starts_with($jabatan, 'Ketua Divisi')
        );
    }

    // Form Tambah
    public function create()
    {
        if (!$this->checkAdmin()) {
            return redirect('/')->with('error', 'Akses ditolak! Anda tidak memiliki hak akses.');
        }
        // Determine default divisi for the logged‑in admin
        $jabatan = session('user.jabatan', '');
        $defaultDivisi = 'Umum (Seluruh Himpunan)';
        if (str_starts_with($jabatan, 'Ketua Divisi ')) {
            $defaultDivisi = substr($jabatan, strlen('Ketua Divisi '));
        }
        return view('kegiatan.create', compact('defaultDivisi'));
    }

    // Simpan Data
    public function store(Request $request)
    {
        if (!$this->checkAdmin()) {
            return redirect('/')->with('error', 'Akses ditolak! Anda tidak memiliki hak akses.');
        }

        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required',
            'divisi' => ['required', Rule::in(config('haruna.divisi'))],
            'pic' => ['nullable', 'string', 'max:100'],
        ]);

        $datetime = Carbon::parse($request->tanggal . ' ' . $request->waktu);

        $status = $datetime->isPast()
            ? 'selesai'
            : 'akan datang';

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'divisi' => $request->divisi,
            'pic' => $request->pic,
            'status' => $status
        ]);

        return redirect('/')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    // Form Edit
    public function edit($id)
    {
        if (!$this->checkAdmin()) {
            return redirect('/')->with('error', 'Akses ditolak! Anda tidak memiliki hak akses.');
        }
        $data = Kegiatan::findOrFail($id);
        // Determine default divisi for the admin (same logic as create)
        $jabatan = session('user.jabatan', '');
        $defaultDivisi = 'Umum (Seluruh Himpunan)';
        if (str_starts_with($jabatan, 'Ketua Divisi ')) {
            $defaultDivisi = substr($jabatan, strlen('Ketua Divisi '));
        }
        return view('kegiatan.edit', compact('data', 'defaultDivisi'));
    }

    // Update Data
    public function update(Request $request, $id)
    {
        if (!$this->checkAdmin()) {
            return redirect('/')->with('error', 'Akses ditolak! Anda tidak memiliki hak akses.');
        }

        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required',
            'divisi' => ['required', Rule::in(config('haruna.divisi'))],
            'pic' => ['nullable', 'string', 'max:100'],
        ]);

        $status = Carbon::parse($request->tanggal)->isPast()
            ? 'selesai'
            : 'akan datang';

        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'divisi' => $request->divisi,
            'pic' => $request->pic,
            'status' => $status
        ]);

        return back()->with('success', 'Kegiatan berhasil diupdate');
    }

    // Hapus Data
    public function destroy($id)
    {
        if (!$this->checkAdmin()) {
            return redirect('/')->with('error', 'Akses ditolak! Anda tidak memiliki hak akses.');
        }
        Kegiatan::destroy($id);
        return back()->with('success', 'Kegiatan berhasil dihapus');
    }

    // Filter Status
    public function filter($status)
    {
        $status = str_replace('-', ' ', $status);
        return redirect('/?status=' . $status);
        }
        public function kalender(Request $request)
{
    $bulan = $request->bulan ?? date('m');
    $tahun = $request->tahun ?? date('Y');

    $jumlahHari = date('t', strtotime("$tahun-$bulan-01"));

    $startDay = date('N', strtotime($tahun . '-' . $bulan . '-01'));

    $data = Kegiatan::whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->get()
        ->groupBy('tanggal');

    $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1, $tahun));

    $prevMonth = $bulan - 1;
    $prevYear = $tahun;

    if ($prevMonth < 1) {
        $prevMonth = 12;
        $prevYear--;
    }

    $nextMonth = $bulan + 1;
    $nextYear = $tahun;

    if ($nextMonth > 12) {
        $nextMonth = 1;
        $nextYear++;
    }

    return view('kegiatan.kalender', compact(
        'bulan',
        'tahun',
        'jumlahHari',
        'startDay',
        'data',
        'namaBulan',
        'prevMonth',
        'prevYear',
        'nextMonth',
        'nextYear'
    ))->with('events', $data);
}

public function akanDatang()
{
    $now = Carbon::now();

    $data = Kegiatan::all()
        ->filter(function($item) use ($now){
            $datetime = Carbon::parse($item->tanggal.' '.$item->waktu);
            return $datetime >= $now;
        })
        ->sortBy('tanggal')
        ->groupBy(function($item){
            return Carbon::parse($item->tanggal)->translatedFormat('F Y');
        });

    return view('kegiatan.akan', compact('data'));
}
public function selesai()
{
    $now = Carbon::now();

    $data = Kegiatan::all()
        ->filter(function($item) use ($now){
            $datetime = Carbon::parse($item->tanggal.' '.$item->waktu);
            return $datetime < $now;
        })
        ->sortBy('tanggal')
        ->groupBy(function($item){
            return Carbon::parse($item->tanggal)->translatedFormat('F Y');
        });

    return view('kegiatan.selesai', compact('data'));
}

}