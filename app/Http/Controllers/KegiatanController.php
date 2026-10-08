<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanRequest;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = Kegiatan::orderBy('tanggal', 'asc')->get();
        $latest = Kegiatan::latest()->take(5)->get();
        $notif = Kegiatan::akanDatang()->count();

        return view('kegiatan.index', compact('data', 'latest', 'notif'));
    }

    public function semua()
    {
        $data = Kegiatan::orderBy('tanggal', 'asc')->get()->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->translatedFormat('F Y');
        });

        return view('kegiatan.semua', compact('data'));
    }

    public function create()
    {
        $jabatan = session('user.jabatan', '');
        $defaultDivisi = 'Umum (Seluruh Himpunan)';
        if (str_starts_with($jabatan, 'Ketua Divisi ')) {
            $defaultDivisi = substr($jabatan, strlen('Ketua Divisi '));
        }

        return view('kegiatan.create', compact('defaultDivisi'));
    }

    public function store(KegiatanRequest $request)
    {
        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'divisi' => $request->divisi,
            'pic' => $request->pic,
            'status' => Kegiatan::hitungStatus($request->tanggal, $request->waktu),
        ]);

        return redirect('/')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Kegiatan::findOrFail($id);
        $jabatan = session('user.jabatan', '');
        $defaultDivisi = 'Umum (Seluruh Himpunan)';
        if (str_starts_with($jabatan, 'Ketua Divisi ')) {
            $defaultDivisi = substr($jabatan, strlen('Ketua Divisi '));
        }

        return view('kegiatan.edit', compact('data', 'defaultDivisi'));
    }

    public function update(KegiatanRequest $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'divisi' => $request->divisi,
            'pic' => $request->pic,
            'status' => Kegiatan::hitungStatus($request->tanggal, $request->waktu),
        ]);

        return back()->with('success', 'Kegiatan berhasil diupdate');
    }

    public function destroy($id)
    {
        Kegiatan::destroy($id);

        return back()->with('success', 'Kegiatan berhasil dihapus');
    }

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
        $data = Kegiatan::akanDatang()->orderBy('tanggal')->orderBy('waktu')->get()->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->translatedFormat('F Y');
        });

        return view('kegiatan.akan', compact('data'));
    }

    public function selesai()
    {
        $data = Kegiatan::selesai()->orderBy('tanggal')->orderBy('waktu')->get()->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->translatedFormat('F Y');
        });

        return view('kegiatan.selesai', compact('data'));
    }
}
