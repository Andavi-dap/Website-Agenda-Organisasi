<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Manajemen Kegiatan — Admin</title>
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
  text-decoration:none;color:#1e3a8a;background:rgba(255,255,255,.45);font-weight:600;transition:.3s;overflow:hidden;
}
.menu a:hover,.menu a.active{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff;transform:translateX(6px);box-shadow:0 10px 20px rgba(59,130,246,.18);}
.side-icon{width:18px;height:18px;stroke:#1e3a8a;stroke-width:2.2;flex-shrink:0;}
.menu a:hover .side-icon,.menu a.active .side-icon{stroke:#fff;}

/* ── MAIN ── */
.main{flex:1;padding:28px;min-width:0;}

/* ── HEADER ── */
.page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;}
.page-header h2{font-size:24px;font-weight:800;color:#0f172a;margin:0;}
.page-header p{color:#64748b;font-size:14px;margin:4px 0 0;}
.btn-tambah{
  display:inline-flex;align-items:center;gap:8px;padding:10px 20px;
  background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff;border:none;border-radius:999px;
  font-weight:700;font-size:14px;cursor:pointer;text-decoration:none;transition:.3s;
}
.btn-tambah:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(59,130,246,.28);color:#fff;}

/* ── FILTER BAR ── */
.filter-bar{
  background:rgba(255,255,255,.68);backdrop-filter:blur(14px);border-radius:18px;
  padding:16px 20px;margin-bottom:20px;box-shadow:0 10px 20px rgba(0,0,0,.04);
  display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;
}
.filter-bar label{font-size:12px;font-weight:700;color:#1e3a8a;display:block;margin-bottom:4px;}
.filter-bar input,.filter-bar select{
  border:1.5px solid rgba(59,130,246,.2);border-radius:10px;padding:8px 12px;
  font-size:13px;font-family:'Poppins',sans-serif;background:rgba(255,255,255,.85);
  outline:none;transition:.25s;color:#1e293b;
}
.filter-bar input:focus,.filter-bar select:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.12);}
.btn-filter,.btn-reset{
  padding:9px 18px;border-radius:999px;font-size:13px;font-weight:700;border:none;cursor:pointer;transition:.3s;
}
.btn-filter{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff;}
.btn-filter:hover{transform:translateY(-2px);box-shadow:0 8px 16px rgba(59,130,246,.25);}
.btn-reset{background:rgba(0,0,0,.06);color:#64748b;}
.btn-reset:hover{background:rgba(0,0,0,.1);}

/* ── TABLE CARD ── */
.table-card{background:rgba(255,255,255,.68);backdrop-filter:blur(14px);border-radius:20px;padding:20px;box-shadow:0 10px 20px rgba(0,0,0,.04);}
.table-toolbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;flex-wrap:wrap;gap:10px;}
.table-toolbar h3{font-size:16px;font-weight:700;color:#1e3a8a;margin:0;}

.btn-bulk-del{
  padding:8px 18px;background:linear-gradient(135deg,#ef4444,#f87171);color:#fff;border:none;
  border-radius:999px;font-weight:700;font-size:13px;cursor:pointer;transition:.3s;
}
.btn-bulk-del:hover{transform:translateY(-2px);box-shadow:0 8px 16px rgba(239,68,68,.25);}

/* ── DataTables override ── */
table.dataTable thead th{background:rgba(59,130,246,.07);color:#1e3a8a;font-weight:700;font-size:13px;border-bottom:2px solid rgba(59,130,246,.12);}
table.dataTable tbody td{font-size:13px;vertical-align:middle;border-bottom:1px solid rgba(0,0,0,.04);}
table.dataTable tbody tr:hover td{background:rgba(59,130,246,.04);}
.dataTables_wrapper .dataTables_filter input{border:1.5px solid rgba(59,130,246,.2);border-radius:10px;padding:6px 12px;font-family:'Poppins',sans-serif;font-size:13px;}
.dataTables_wrapper .dataTables_length select{border:1.5px solid rgba(59,130,246,.2);border-radius:10px;padding:4px 8px;font-family:'Poppins',sans-serif;}
.dataTables_wrapper .dataTables_paginate .paginate_button.current{background:linear-gradient(135deg,#3b82f6,#60a5fa)!important;color:#fff!important;border-radius:8px!important;border:none!important;}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover{background:rgba(59,130,246,.08)!important;border-radius:8px!important;}

/* ── Status badge ── */
.badge-akan{background:linear-gradient(135deg,#f59e0b,#fbbf24);color:#fff;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:700;}
.badge-selesai{background:linear-gradient(135deg,#22c55e,#4ade80);color:#fff;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:700;}

/* ── Action buttons ── */
.btn-edit{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff;border:none;border-radius:8px;padding:5px 12px;font-size:12px;font-weight:700;text-decoration:none;cursor:pointer;transition:.25s;}
.btn-edit:hover{transform:translateY(-1px);color:#fff;}
.btn-del{background:linear-gradient(135deg,#ef4444,#f87171);color:#fff;border:none;border-radius:8px;padding:5px 12px;font-size:12px;font-weight:700;cursor:pointer;transition:.25s;}
.btn-del:hover{transform:translateY(-1px);}

@media(max-width:768px){body{flex-direction:column;}.sidebar{width:100%;}
.filter-bar{flex-direction:column;}.page-header{flex-direction:column;align-items:flex-start;gap:12px;}}
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
    <a href="{{ route('admin.dashboard') }}">
      <svg class="side-icon" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Admin Dashboard
    </a>
    <a href="{{ route('admin.kegiatan.index') }}" class="active">
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

  <!-- Page Header -->
  <div class="page-header">
    <div>
      <h2>📋 Manajemen Kegiatan</h2>
      <p>Cari, filter, dan kelola seluruh kegiatan himpunan.</p>
    </div>
    <a href="{{ route('kegiatan.create') }}" class="btn-tambah">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
      Tambah Kegiatan
    </a>
  </div>

  @if(session('success'))
  <div style="background:rgba(34,197,94,.12);border:1px solid #22c55e;color:#166534;padding:12px 18px;border-radius:14px;margin-bottom:16px;font-weight:600;">
    ✅ {{ session('success') }}
  </div>
  @endif

  <!-- Filter Bar -->
  <form method="GET" action="{{ route('admin.kegiatan.index') }}" id="filter-form">
    <div class="filter-bar">
      <div>
        <label>🔍 Cari</label>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Nama, lokasi, PIC..." style="width:220px;">
      </div>
      <div>
        <label>📂 Divisi</label>
        <select name="divisi">
          <option value="">Semua Divisi</option>
          <option value="empty" {{ request('divisi')==='empty'?'selected':'' }}>Belum Ditentukan</option>
          @foreach(config('haruna.divisi', []) as $div)
            <option value="{{ $div }}" {{ request('divisi')===$div?'selected':'' }}>{{ $div }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label>🏷️ Status</label>
        <select name="status">
          <option value="">Semua Status</option>
          <option value="akan-datang" {{ request('status')==='akan-datang'?'selected':'' }}>Akan Datang</option>
          <option value="selesai" {{ request('status')==='selesai'?'selected':'' }}>Selesai</option>
        </select>
      </div>
      <div>
        <label>📅 Bulan</label>
        <input type="month" name="bulan" value="{{ request('bulan') }}">
      </div>
      <div>
        <label>⚠️ Kelengkapan</label>
        <select name="lengkap">
          <option value="">Semua</option>
          <option value="belum" {{ request('lengkap')==='belum'?'selected':'' }}>Belum Lengkap</option>
        </select>
      </div>
      <div style="display:flex;gap:8px;">
        <button type="submit" class="btn-filter">Filter</button>
        <a href="{{ route('admin.kegiatan.index') }}" class="btn-reset">Reset</a>
      </div>
    </div>
  </form>

  <!-- Table Card -->
  <div class="table-card">
    <div class="table-toolbar">
      <h3>Daftar Kegiatan</h3>
      <button class="btn-bulk-del" id="btn-bulk-delete" disabled>
        🗑️ Hapus Terpilih (<span id="selected-count">0</span>)
      </button>
    </div>

    <div class="table-responsive">
      <table id="kegiatan-table" class="table table-hover align-middle" style="width:100%">
        <thead>
          <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>No</th>
            <th>Nama Kegiatan</th>
            <th>Divisi</th>
            <th>PIC</th>
            <th>Tanggal &amp; Waktu</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

</div><!-- /main -->

<!-- ── Scripts ── -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(function(){
  // Build extra params from URL
  function getParam(k){ return new URLSearchParams(window.location.search).get(k) || ''; }

  const table = $('#kegiatan-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ route('admin.kegiatan.index') }}',
      data: function(d){
        d.q       = getParam('q');
        d.divisi  = getParam('divisi');
        d.status  = getParam('status');
        d.bulan   = getParam('bulan');
        d.lengkap = getParam('lengkap');
      }
    },
    columns: [
      { data:'checkbox',  orderable:false, searchable:false, width:'36px' },
      { data:'no',        orderable:false, searchable:false, width:'48px' },
      { data:'nama_kegiatan', orderable:true, searchable:false },
      { data:'divisi', orderable:true, searchable:false },
      { data:'pic', orderable:true, searchable:false },
      { data:'tanggal_waktu', orderable:true, searchable:false },
      { data:'lokasi', orderable:true, searchable:false },
      { data:'status', orderable:false, searchable:false },
      { data:'aksi', orderable:false, searchable:false }
    ],
    order: [[5, 'desc']],
    language:{
      processing:'<div style="padding:16px;color:#3b82f6;font-weight:600;">Memuat data…</div>',
      zeroRecords:'<div style="padding:24px;text-align:center;color:#94a3b8;">Tidak ada kegiatan ditemukan.</div>',
      paginate:{ previous:'‹', next:'›' }
    },
    pageLength:10,
    dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'>>rt<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
  });

  // Select all
  $('#select-all').on('change', function(){
    const checked = this.checked;
    $('.row-select').prop('checked', checked);
    updateBulkBtn();
  });

  $(document).on('change','.row-select', updateBulkBtn);

  function updateBulkBtn(){
    const n = $('.row-select:checked').length;
    $('#selected-count').text(n);
    $('#btn-bulk-delete').prop('disabled', n === 0);
  }

  // Bulk delete
  $('#btn-bulk-delete').on('click', function(){
    const ids = $('.row-select:checked').map(function(){ return $(this).val(); }).get();
    if(!ids.length) return;
    if(!confirm('Hapus ' + ids.length + ' kegiatan yang dipilih?')) return;

    $.ajax({
      url: '{{ route('admin.kegiatan.bulk-destroy') }}',
      method: 'DELETE',
      data: { ids: ids },
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      success: function(res){
        table.ajax.reload(null, false);
        updateBulkBtn();
        showToast(res.message || 'Berhasil dihapus.', 'success');
      },
      error: function(){ showToast('Gagal menghapus.', 'danger'); }
    });
  });

  // Single delete (delegated)
  $(document).on('click','.btn-del-single', function(){
    const id  = $(this).data('id');
    const url = $(this).data('url');
    if(!confirm('Hapus kegiatan ini?')) return;
    $.ajax({
      url: url,
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      success: function(res){
        table.ajax.reload(null,false);
        showToast(res.message || 'Berhasil dihapus.','success');
      },
      error: function(){ showToast('Gagal menghapus.','danger'); }
    });
  });

  function showToast(msg, type){
    const bg = type==='success' ? 'rgba(34,197,94,.9)' : 'rgba(239,68,68,.9)';
    const t  = $('<div>').text(msg).css({
      position:'fixed', bottom:'28px', right:'28px', background:bg, color:'#fff',
      padding:'12px 22px', borderRadius:'14px', fontWeight:'700', fontSize:'14px',
      boxShadow:'0 12px 28px rgba(0,0,0,.15)', zIndex:9999, opacity:0
    }).appendTo('body');
    t.animate({opacity:1, bottom:'34px'},200).delay(2500).animate({opacity:0},300, ()=>t.remove());
  }
});
</script>
</body>
</html>
