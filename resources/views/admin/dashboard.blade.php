<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 32px 16px;
            min-height: 100vh;
            background: #eef5ff;
            color: #172554;
            font-family: 'Poppins', sans-serif;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        h1 { margin: 0; font-size: 28px; }
        .badge { background:#2563eb; color:#fff; padding:4px 8px; border-radius:4px; font-size:14px; }
        .btn {
            background:#1d4ed8; color:#fff; padding:10px 16px; border:none; border-radius:6px; font-weight:600; cursor:pointer; text-decoration:none;
        }
        .cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; margin-bottom: 32px; }
        .card { background:#fff; border-radius:12px; padding:16px; box-shadow:0 4px 12px rgba(0,0,0,0.08); }
        .card h2 { margin:0 0 8px; font-size: 18px; }
        .card p { margin:0; font-size:24px; font-weight:600; }
        .charts { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px; }
        .chart-box { background:#fff; border-radius:12px; padding:16px; box-shadow:0 4px 12px rgba(0,0,0,0.08); }
        .table-box { background:#fff; border-radius:12px; padding:16px; box-shadow:0 4px 12px rgba(0,0,0,0.08); margin-bottom:32px; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:8px 12px; border-bottom:1px solid #e2e8f0; text-align:left; }
        th { background:#f1f5f9; }
        .empty-state { text-align:center; padding:40px 0; color:#64748b; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
</head>
<body>
<div class="container">
    <header>
        <div>
            <h1>Halo, {{ session('user')['nama'] ?? 'Admin' }}</h1>
            <span class="badge">Admin</span>
        </div>
        <a href="{{ route('kegiatan.create') }}" class="btn">Tambah Kegiatan</a>
    </header>

    <!-- Statistik Kartu -->
    <section class="cards">
        <div class="card"><h2>Total Kegiatan</h2><p>{{ $total }}</p></div>
        <div class="card"><h2>Akan Datang</h2><p>{{ $upcoming }}</p></div>
        <div class="card"><h2>Selesai</h2><p>{{ $finished }}</p></div>
        <div class="card"><h2>7 Hari ke Depan</h2><p>{{ $sevenDaysAhead }}</p></div>
        <div class="card"><h2>Perlu Dilengkapi</h2><p><a href="/admin/kegiatan?lengkap=belum">{{ $incomplete }}</a></p></div>
    </section>

    <!-- Grafik -->
    <section class="charts">
        <div class="chart-box">
            <h2>Kegiatan per Divisi</h2>
            <canvas id="divisionChart"></canvas>
        </div>
        <div class="chart-box">
            <h2>Kegiatan per Bulan ({{ now()->year }})</h2>
            <canvas id="monthChart"></canvas>
        </div>
    </section>

    <!-- Tabel Kegiatan Terdekat -->
    <section class="table-box">
        <h2>Kegiatan Terdekat</h2>
        @if($nearest->isEmpty())
            <div class="empty-state">Tidak ada kegiatan akan datang.</div>
        @else
            <table>
                <thead>
                    <tr><th>Nama</th><th>Divisi</th><th>PIC</th><th>Tanggal & Waktu</th><th>Lokasi</th></tr>
                </thead>
                <tbody>
                @foreach($nearest as $k)
                    <tr>
                        <td>{{ $k->nama_kegiatan }}</td>
                        <td>{{ $k->divisi ?? '-' }}</td>
                        <td>{{ $k->pic ?? '-' }}</td>
                        <td>{{ $k->tanggal }} {{ $k->waktu }}</td>
                        <td>{{ $k->lokasi }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </section>

    <!-- Panel Perlu Dilengkapi (max 5) -->
    @if(!$incompleteList->isEmpty())
    <section class="table-box">
        <h2>Perlu Dilengkapi ({{ $incompleteList->count() }})</h2>
        <table>
            <thead>
                <tr><th>Nama</th><th>Divisi</th><th>PIC</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            @foreach($incompleteList as $k)
                <tr>
                    <td>{{ $k->nama_kegiatan }}</td>
                    <td>{{ $k->divisi ?? '-' }}</td>
                    <td>{{ $k->pic ?? '-' }}</td>
                    <td><a href="{{ route('kegiatan.edit', $k->id) }}" class="btn" style="background:#3b82f6;">Lengkapi</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
    @endif
</div>

<script>
    const divisionData = @json($divisionCounts);
    const divisionLabels = Object.keys(divisionData);
    const divisionValues = Object.values(divisionData);
    new Chart(document.getElementById('divisionChart'), {
        type: 'bar',
        data: {
            labels: divisionLabels,
            datasets: [{
                label: 'Kegiatan',
                data: divisionValues,
                backgroundColor: '#2563eb'
            }]
        },
        options: { indexAxis: 'y', responsive: true }
    });

    const monthData = @json($monthlyCounts);
    const monthLabels = Object.keys(monthData).map(m => new Date(0, m-1).toLocaleString('id-ID', { month: 'short' }));
    const monthValues = Object.values(monthData);
    new Chart(document.getElementById('monthChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Kegiatan',
                data: monthValues,
                borderColor: '#1d4ed8',
                backgroundColor: 'rgba(29,78,216,0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });
</script>
</body>
</html>
