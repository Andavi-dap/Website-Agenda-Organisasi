<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KegiatanRequest;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanManageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Kegiatan::query();

            if ($search = $request->input('search.value')) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kegiatan', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhere('pic', 'like', "%{$search}%");
                });
            }

            if ($q = $request->input('q')) {
                $query->where(function ($qBuilder) use ($q) {
                    $qBuilder->where('nama_kegiatan', 'like', "%{$q}%")
                        ->orWhere('lokasi', 'like', "%{$q}%")
                        ->orWhere('pic', 'like', "%{$q}%");
                });
            }

            $divisi = $request->input('divisi');
            if ($divisi !== null && $divisi !== '') {
                if ($divisi === 'empty') {
                    $query->where(function ($q) {
                        $q->whereNull('divisi')->orWhere('divisi', '');
                    });
                } elseif (in_array($divisi, config('haruna.divisi', []), true)) {
                    $query->where('divisi', $divisi);
                }
            }

            $statusInput = strtolower((string) $request->input('status'));
            if ($statusInput === 'akan-datang' || $statusInput === 'akan datang') {
                $query->akanDatang();
            } elseif ($statusInput === 'selesai') {
                $query->selesai();
            }

            if ($bulan = $request->input('bulan')) {
                if (preg_match('/^\d{4}-\d{2}$/', $bulan)) {
                    [$year, $month] = explode('-', $bulan);
                    $query->whereYear('tanggal', $year)
                        ->whereMonth('tanggal', $month);
                }
            }

            if ($lengkap = $request->input('lengkap')) {
                if ($lengkap === 'belum') {
                    $query->where(function ($q) {
                        $q->whereNull('divisi')
                            ->orWhere('divisi', '')
                            ->orWhereNull('pic')
                            ->orWhere('pic', '');
                    });
                }
            }

            $columnMap = [
                2 => 'nama_kegiatan',
                3 => 'divisi',
                4 => 'pic',
                5 => 'tanggal',
                6 => 'lokasi',
            ];

            $dir = strtolower((string) $request->input('order.0.dir', 'desc'));
            $dir = in_array($dir, ['asc', 'desc'], true) ? $dir : 'desc';
            $column = (int) $request->input('order.0.column', 5);
            $column = $columnMap[$column] ?? 'tanggal';
            $query->orderBy($column, $dir);

            $start = (int) $request->input('start', 0);
            $length = (int) $request->input('length', 10);
            $total = $query->count();
            $records = $query->skip($start)->take($length)->get();

            $data = $records->map(function (Kegiatan $item, $idx) use ($start) {
                $status = $item->status ?? Kegiatan::hitungStatus($item->tanggal, $item->waktu ?? '00:00:00');
                $badgeHtml = '<span class="badge-' . ($status === 'selesai' ? 'selesai' : 'akan') . '">' . ($status === 'selesai' ? 'Selesai' : 'Akan Datang') . '</span>';

                $aksiHtml = '<div style="display:flex;gap:8px;">'
                    . '<a href="' . route('admin.kegiatan.edit', $item) . '" class="btn-edit">Edit</a>'
                    . '<button type="button" class="btn-del btn-del-single" data-id="' . e($item->id) . '" data-url="' . route('admin.kegiatan.destroy', $item) . '">Hapus</button>'
                    . '</div>';

                return [
                    'checkbox' => '<input type="checkbox" class="row-select" value="' . e($item->id) . '">',
                    'no' => $start + $idx + 1,
                    'nama_kegiatan' => e($item->nama_kegiatan),
                    'divisi' => e($item->divisi ?? 'Belum ditentukan'),
                    'pic' => e($item->pic ?? '-'),
                    'tanggal_waktu' => e($item->tanggal ?? '') . ($item->waktu ? ' ' . e($item->waktu) : ''),
                    'lokasi' => e($item->lokasi ?? '-'),
                    'status' => $badgeHtml,
                    'aksi' => $aksiHtml,
                ];
            });

            return response()->json([
                'draw' => (int) $request->input('draw', 1),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ]);
        }

        return view('admin.kegiatan');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan_edit', compact('kegiatan'));
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatan)
    {
        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'divisi' => $request->divisi,
            'pic' => $request->pic,
            'status' => Kegiatan::hitungStatus($request->tanggal, $request->waktu),
        ]);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return response()->json(['message' => 'Kegiatan berhasil dihapus.', 'deleted' => 1]);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        $validator = Validator::make(
            ['ids' => $ids],
            ['ids' => ['required', 'array'], 'ids.*' => ['integer']]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first('ids') ?: 'Data tidak valid.'], 422);
        }

        $deleted = Kegiatan::whereIn('id', $ids)->delete();

        return response()->json([
            'deleted' => $deleted,
            'message' => "Berhasil menghapus {$deleted} kegiatan.",
        ]);
    }
}

