<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class KegiatanManageController extends Controller
{
    /**
     * Display a listing of the resource.
     * Returns the Blade view for normal requests and JSON for DataTables AJAX.
     */
    public function index(Request $request)
    {
        // AJAX request from DataTables – return JSON payload
        if ($request->ajax()) {
            $query = Kegiatan::query();

            // ---------- Search (q) ----------
            if ($search = $request->input('q')) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kegiatan', 'like', "%{$search}%")
                      ->orWhere('lokasi', 'like', "%{$search}%")
                      ->orWhere('pic', 'like', "%{$search}%");
                });
            }

            // ---------- Filters ----------
            // divisi (use "empty" for rows without a division)
            if ($divisi = $request->input('divisi')) {
                if ($divisi === 'empty') {
                    $query->whereNull('divisi')->orWhere('divisi', '');
                } else {
                    $query->where('divisi', $divisi);
                }
            }

            // status: "akan-datang" (future) or "selesai" (past) — derived from tanggal
            $statusInput = $request->input('status');
            if (in_array($statusInput, ['akan-datang', 'selesai'], true)) {
                if ($statusInput === 'akan-datang') {
                    $query->whereDate('tanggal', '>', now()->toDateString());
                } else {
                    $query->whereDate('tanggal', '<=', now()->toDateString());
                }
            }

            // bulan in format YYYY-MM
            if ($bulan = $request->input('bulan')) {
                if (preg_match('/^\d{4}-\d{2}$/', $bulan)) {
                    [$year, $month] = explode('-', $bulan);
                    $query->whereYear('tanggal', $year)
                          ->whereMonth('tanggal', $month);
                }
            }

            // lengkap=belum – rows where divisi or pic is missing
            if ($lengkap = $request->input('lengkap')) {
                if ($lengkap === 'belum') {
                    $query->where(function ($q) {
                        $q->whereNull('divisi')->orWhere('divisi', '')
                          ->orWhereNull('pic')->orWhere('pic', '');
                    });
                }
            }

            // ---------- Sorting ----------
            // 'status' is NOT a real DB column — computed from tanggal — so excluded from DB sort
            $allowedSort = ['tanggal', 'nama_kegiatan', 'divisi', 'pic', 'lokasi'];
            $sort = $request->input('sort');
            $dir  = in_array(strtolower((string) $request->input('dir', 'asc')), ['asc', 'desc'])
                        ? strtolower($request->input('dir', 'asc'))
                        : 'asc';
            if (in_array($sort, $allowedSort, true)) {
                $query->orderBy($sort, $dir);
            } else {
                // default: upcoming first
                $query->orderBy('tanggal', 'desc');
            }

            // ---------- Pagination for DataTables ----------
            $start  = $request->input('start', 0);
            $length = $request->input('length', 10);
            $total  = $query->count();

            $records = $query->skip($start)->take($length)->get();

            $now = now()->toDateString();
            $data = $records->map(function (Kegiatan $item, $idx) use ($start, $now) {
                // Compute status dynamically from tanggal (no stored status column needed)
                $computedStatus = ($item->tanggal && $item->tanggal <= $now)
                    ? 'selesai'
                    : 'akan-datang';

                try {
                    $badgeHtml = view('components.status-badge', ['status' => $computedStatus])->render();
                } catch (\Throwable $e) {
                    $badgeHtml = '<span class="badge badge-secondary">' . e($computedStatus) . '</span>';
                }
                try {
                    $aksiHtml = view('admin.kegiatan_actions', ['kegiatan' => $item])->render();
                } catch (\Throwable $e) {
                    $aksiHtml = '';
                }

                return [
                    'checkbox'      => '<input type="checkbox" class="row-select" value="' . e($item->id) . '">',
                    'no'            => $start + $idx + 1,
                    'nama_kegiatan' => e($item->nama_kegiatan),
                    'divisi'        => e($item->divisi ?? '-'),
                    'pic'           => e($item->pic ?? '-'),
                    'tanggal_waktu' => e($item->tanggal ?? '') . ($item->waktu ? ' ' . e($item->waktu) : ''),
                    'lokasi'        => e($item->lokasi ?? '-'),
                    'status'        => $badgeHtml,
                    'aksi'          => $aksiHtml,
                ];
            });


            return response()->json([
                'draw'            => intval($request->input('draw')),
                'recordsTotal'    => $total,
                'recordsFiltered' => $total,
                'data'            => $data,
            ]);
        }

        // Normal request – show the Blade view
        return view('admin.kegiatan');
    }

    /**
     * Show the form for creating a new Kegiatan.
     */
    public function create()
    {
        return view('admin.kegiatan_create');
    }

    /**
     * Store a newly created Kegiatan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'divisi'        => 'nullable|string|max:255',
            'pic'           => 'nullable|string|max:255',
            'tanggal'       => 'required|date',
            'waktu'         => 'required|string',
            'lokasi'        => 'required|string|max:255',
            'status'        => 'required|in:akan-datang,selesai',
        ]);

        Kegiatan::create($validated);

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified Kegiatan.
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan_show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified Kegiatan.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan_edit', compact('kegiatan'));
    }

    /**
     * Update the specified Kegiatan in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'divisi'        => 'nullable|string|max:255',
            'pic'           => 'nullable|string|max:255',
            'tanggal'       => 'required|date',
            'waktu'         => 'required|string',
            'lokasi'        => 'required|string|max:255',
            'status'        => 'required|in:akan-datang,selesai',
        ]);

        $kegiatan->update($validated);

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified Kegiatan from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return response()->json(['message' => 'Kegiatan berhasil dihapus.']);
    }

    /**
     * Bulk delete selected Kegiatan records.
     * Expects an array of IDs under the "ids" request parameter.
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No IDs provided.'], 400);
        }
        Kegiatan::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Selected kegiatan berhasil dihapus.']);
    }
}
