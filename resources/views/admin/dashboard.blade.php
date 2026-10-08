<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Admin Dashboard — Agenda Organisasi</title>
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
  background:
    radial-gradient(circle at 20% 20%,rgba(96,165,250,.40),transparent 40%),
    radial-gradient(circle at 80% 10%,rgba(59,130,246,.28),transparent 40%),
    linear-gradient(135deg,#e0f2fe,#f8fafc);
  display:flex;min-height:100vh;color:#1e293b;overflow-x:hidden;
}

/* ── SIDEBAR ── */
.sidebar{width:250px;padding:25px;background:rgba(255,255,255,.55);backdrop-filter:blur(24px);flex-shrink:0;}
.logo{display:flex;justify-content:center;margin-bottom:35px;}
.logo img{width:190px;max-width:100%;filter:drop-shadow(0 8px 18px rgba(59,130,246,.25));transition:.3s;}
.logo img:hover{transform:scale(1.04);}
.menu a{
  display:flex;align-items:center;gap:12px;padding:13px 14px;margin:8px 0;border-radius:14px;
  text-decoration:none;color:#1e3a8a;background:rgba(255,255,255,.45);font-weight:600;transition:.3s;
  position:relative;overflow:hidden;
}
.menu a:hover,.menu a.active{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff;transform:translateX(6px);box-shadow:0 10px 20px rgba(59,130,246,.18);}
.side-icon{width:18px;height:18px;stroke:#1e3a8a;stroke-width:2.2;flex-shrink:0;}
.menu a:hover .side-icon,.menu a.active .side-icon{stroke:#fff;}

/* ── MAIN ── */
.main{flex:1;padding:28px;min-width:0;}

/* ── HEADER ── */
.header-wrap{display:grid;grid-template-columns:1fr auto;align-items:center;gap:24px;margin-bottom:28px;}
.header-left h2{font-size:24px;font-weight:800;color:#0f172a;margin:0 0 6px;}
.desc{color:#64748b;font-size:14px;margin:0;}
.header-right{display:flex;align-items:center;gap:14px;}

.profile-box{display:flex;align-items:center;gap:10px;padding:8px 14px;border-radius:18px;background:rgba(255,255,255,.75);cursor:pointer;transition:.3s;position:relative;}
.profile-box:hover{box-shadow:0 8px 18px rgba(59,130,246,.16);}
.profile-box img{width:42px;height:42px;border-radius:50%;object-fit:cover;border:2px solid #60a5fa;}
.dropdown{display:none;position:absolute;right:0;top:62px;background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 18px 35px rgba(0,0,0,.12);min-width:180px;z-index:999;}
.dropdown a{display:block;padding:12px 15px;text-decoration:none;color:#1e293b;font-size:14px;}
.dropdown a:hover{background:#3b82f6;color:#fff;}
.profile{position:relative;}

/* ── STATS GRID ── */
.stats{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:16px;margin-bottom:28px;}
.stat-card{
  background:rgba(255,255,255,.55);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.35);
  border-radius:20px;padding:18px 20px;display:flex;align-items:center;gap:16px;
  transition:.3s;box-shadow:0 10px 20px rgba(0,0,0,.04);text-decoration:none;color:inherit;
}
.stat-card:hover{transform:translateY(-6px);box-shadow:0 18px 25px rgba(59,130,246,.12);}
.icon-circle{width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 10px 18px rgba(0,0,0,.08);}
.icon-circle svg{width:24px;height:24px;stroke:white;stroke-width:2.2;fill:none;}
.ic-blue{background:linear-gradient(135deg,#3b82f6,#60a5fa);}
.ic-amber{background:linear-gradient(135deg,#f59e0b,#fbbf24);}
.ic-green{background:linear-gradient(135deg,#22c55e,#34d399);}
.ic-purple{background:linear-gradient(135deg,#7c3aed,#8b5cf6);}
.ic-red{background:linear-gradient(135deg,#ef4444,#f87171);}
.stat-text h4{font-size:12px;font-weight:700;color:#64748b;margin:0 0 4px;text-transform:uppercase;letter-spacing:.5px;}
.stat-text h2{font-size:36px;font-weight:800;color:#0f172a;margin:0;line-height:1;}

/* ── CHARTS ── */
.charts{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:28px;}
.glass{background:rgba(255,255,255,.68);padding:20px;border-radius:22px;box-shadow:0 10px 20px rgba(0,0,0,.04);}
.glass h3{font-size:16px;font-weight:700;color:#1e3a8a;margin:0 0 16px;}

/* ── TABLES ── */
.table-section{background:rgba(255,255,255,.68);border-radius:22px;padding:20px;box-shadow:0 10px 20px rgba(0,0,0,.04);margin-bottom:20px;}
.table-section h3{font-size:16px;font-weight:700;color:#1e3a8a;margin:0 0 16px;}
.table-section table{width:100%;border-collapse:collapse;font-size:14px;}
.table-section th{background:rgba(59,130,246,.07);padding:10px 12px;text-align:left;font-weight:700;color:#1e3a8a;border-radius:0;}
.table-section td{padding:10px 12px;border-bottom:1px solid rgba(0,0,0,.05);}
.table-section tr:last-child td{border-bottom:none;}
.table-section tr:hover td{background:rgba(59,130,246,.04);}

.badge-admin{background:linear-gradient(135deg,#7c3aed,#6366f1);color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;display:inline-block;}
.btn-link{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff;padding:6px 14px;border-radius:999px;font-size:12px;font-weight:700;text-decoration:none;transition:.3s;}
.btn-link:hover{transform:translateY(-2px);box-shadow:0 8px 16px rgba(59,130,246,.25);}
.empty-state{text-align:center;padding:40px;color:#94a3b8;font-size:14px;}

@media(max-width:1200px){.stats{grid-template-columns:repeat(3,1fr);}}
@media(max-width:900px){.charts{grid-template-columns:1fr;}}
@media(max-width:768px){body{flex-direction:column;}.sidebar{width:100%;}.stats{grid-template-columns:repeat(2,1fr);}}
@media(max-width:500px){.stats{grid-template-columns:1fr;}.header-wrap{grid-template-columns:1fr;}}
</style>
</head>

@php
  $isAdmin = session('user.is_admin') ?? false;
@endphp

<body>

<!-- ── SIDEBAR ── -->
<div class="sidebar">
  <div class="logo">
    <img src="{{ asset('logo/logo.png') }}" alt="Logo">
  </div>
  <div class="menu">
    <a href="{{ route('kegiatan.index') }}">
      <svg class="side-icon" viewBox="0 0 24 24" fill="none"><path d="M3 10.5L12 3l9 7.5"/><path d="M5 9.5V20h14V9.5"/></svg>
      Dashboard
    </a>
    <a href="{{ route('admin.dashboard') }}" class="active">
      <svg class="side-icon" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Admin Dashboard
    </a>
    <a href="{{ route('admin.kegiatan.index') }}">
      <svg class="side-icon" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="8" y1="3" x2="8" y2="7"/><line x1="16" y1="3" x2="16" y2="7"/></svg>
      Manajemen Kegiatan
    </a>
    <a href="{{ route('kegiatan.kalender') }}">
      <svg class="side-icon" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      Kalender
    </a>
    <a href="{{ route('logout') }}">
      <svg class="side-icon" viewBox="0 0 24 24" fill="none"><path d="M17 16l4-4m0 0l-4-4m4 4H7"/><path d="M9 20H5a2 2 0 01-2-2V6a2 2 0 012-2h4"/></svg>
      Logout
    </a>
  </div>
</div>

<!-- ── MAIN ── -->
<div class="main">

  <!-- Header -->
  <div class="header-wrap">
    <div class="header-left">
      <h2>Admin Dashboard</h2>
      <p class="desc">Selamat datang, <strong>{{ session('user.nama','Admin') }}</strong> — pantau statistik & kelola kegiatan himpunan.</p>
    </div>
    <div class="header-right">
      <div class="profile">
        <div class="profile-box" onclick="toggleProfile()">
          <img src="{{ asset('foto/'.session('user.foto','default.jpg')) }}" alt="">
          <div>
            <b>{{ session('user.nama','Admin') }}</b><br>
            <small style="color:#64748b">{{ session('user.jabatan','') }}</small><br>
            <span class="badge-admin">Admin</span>
          </div>
        </div>
        <div id="dropdown" class="dropdown">
          <a href="{{ route('profile.view') }}">Profil Saya</a>
          <a href="{{ route('kegiatan.index') }}">Kembali ke App</a>
          <a href="{{ route('logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="stats">
    <div class="stat-card">
      <div class="icon-circle ic-blue">
        <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      </div>
      <div class="stat-text">
        <h4>Total Kegiatan</h4>
        <h2>{{ $total }}</h2>
      </div>
    </div>
    <div class="stat-card">
      <div class="icon-circle ic-amber">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2" stroke-linecap="round"/></svg>
      </div>
      <div class="stat-text">
        <h4>Akan Datang</h4>
        <h2>{{ $upcoming }}</h2>
      </div>
    </div>
    <div class="stat-card">
      <div class="icon-circle ic-green">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.2 2.2L16 9" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div class="stat-text">
        <h4>Selesai</h4>
        <h2>{{ $finished }}</h2>
      </div>
    </div>
    <div class="stat-card">
      <div class="icon-circle ic-purple">
        <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/><circle cx="12" cy="16" r="2"/></svg>
      </div>
      <div class="stat-text">
        <h4>7 Hari ke Depan</h4>
        <h2>{{ $sevenDaysAhead }}</h2>
      </div>
    </div>
    <a class="stat-card" href="{{ route('admin.kegiatan.index') }}?lengkap=belum" style="text-decoration:none;">
      <div class="icon-circle ic-red">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12"/><circle cx="12" cy="16" r=".5" fill="white"/></svg>
      </div>
      <div class="stat-text">
        <h4>Perlu Dilengkapi</h4>
        <h2>{{ $incomplete }}</h2>
      </div>
    </a>
  </div>

  <!-- Charts -->
  <div class="charts">
    <div class="glass">
      <h3>📊 Kegiatan per Divisi</h3>
      <canvas id="divisionChart"></canvas>
    </div>
    <div class="glass">
      <h3>📈 Kegiatan per Bulan ({{ now()->year }})</h3>
      <canvas id="monthChart"></canvas>
    </div>
  </div>

  <!-- Kegiatan Terdekat -->
  <div class="table-section">
    <h3>🗓️ Kegiatan Terdekat</h3>
    @if($nearest->isEmpty())
      <div class="empty-state">Tidak ada kegiatan akan datang.</div>
    @else
      <table>
        <thead>
          <tr>
            <th>Nama Kegiatan</th>
            <th>Divisi</th>
            <th>PIC</th>
            <th>Tanggal &amp; Waktu</th>
            <th>Lokasi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($nearest as $k)
          <tr>
            <td><strong>{{ $k->nama_kegiatan }}</strong></td>
            <td>{{ $k->divisi ?? '-' }}</td>
            <td>{{ $k->pic ?? '-' }}</td>
            <td>{{ $k->tanggal }} {{ $k->waktu }}</td>
            <td>{{ $k->lokasi }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <!-- Perlu Dilengkapi -->
  @if(!$incompleteList->isEmpty())
  <div class="table-section">
    <h3>⚠️ Perlu Dilengkapi ({{ $incompleteList->count() }})</h3>
    <table>
      <thead>
        <tr>
          <th>Nama Kegiatan</th>
          <th>Divisi</th>
          <th>PIC</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($incompleteList as $k)
        <tr>
          <td><strong>{{ $k->nama_kegiatan }}</strong></td>
          <td>{{ $k->divisi ?? '<span style="color:#ef4444;font-weight:700;">Belum diisi</span>' }}</td>
          <td>{{ $k->pic ?? '<span style="color:#ef4444;font-weight:700;">Belum diisi</span>' }}</td>
          <td><a href="{{ route('admin.kegiatan.edit', $k) }}" class="btn-link">Lengkapi</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif

</div><!-- /main -->

<script>
function toggleProfile(){
  const d = document.getElementById('dropdown');
  d.style.display = d.style.display === 'block' ? 'none' : 'block';
}
document.addEventListener('click', e => {
  if(!e.target.closest('.profile')) document.getElementById('dropdown').style.display = 'none';
});

const divisionData   = @json($divisionCounts);
const divisionLabels = Object.keys(divisionData);
const divisionValues = Object.values(divisionData);
new Chart(document.getElementById('divisionChart'),{
  type:'bar',
  data:{
    labels:divisionLabels,
    datasets:[{label:'Kegiatan',data:divisionValues,backgroundColor:'rgba(59,130,246,.75)',borderRadius:8,borderSkipped:false}]
  },
  options:{indexAxis:'y',responsive:true,plugins:{legend:{display:false}},scales:{x:{grid:{color:'rgba(0,0,0,.04)'}},y:{grid:{display:false}}}}
});

const monthData   = @json($monthlyCounts);
const monthLabels = Object.keys(monthData).map(m=>new Date(0,m-1).toLocaleString('id-ID',{month:'short'}));
const monthValues = Object.values(monthData);
new Chart(document.getElementById('monthChart'),{
  type:'line',
  data:{
    labels:monthLabels,
    datasets:[{label:'Kegiatan',data:monthValues,borderColor:'#3b82f6',backgroundColor:'rgba(59,130,246,.12)',fill:true,tension:.4,pointBackgroundColor:'#3b82f6',pointRadius:5}]
  },
  options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,grid:{color:'rgba(0,0,0,.04)'}},x:{grid:{display:false}}}}
});
</script>
</body>
</html>
