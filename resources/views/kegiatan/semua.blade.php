<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DAFTAR SEMUA</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
background:
radial-gradient(circle at 20% 20%, rgba(96,165,250,0.35), transparent 35%),
radial-gradient(circle at 80% 10%, rgba(59,130,246,0.28), transparent 35%),
linear-gradient(135deg,#e0f2fe,#f8fafc);
padding:40px;
color:#1e293b;
}

.container{max-width:1100px;margin:auto;}

/* HEADER */
.header{
display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;
}
.header-left{display:flex;align-items:center;gap:16px;}

.logo-img{
width:80px;
height:80px;
object-fit:contain;
filter:drop-shadow(0 6px 12px rgba(37,99,235,0.3));
transition:0.3s;
}

.title{
font-size:30px;font-weight:800;
background:linear-gradient(135deg,#1d4ed8,#38bdf8);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.subtitle{font-size:14px;color:#64748b;}

.add-btn{
background:linear-gradient(135deg,#2563eb,#3b82f6);
color:#fff;
padding:14px 24px;
border-radius:18px;

font-weight:700;
text-decoration:none;

box-shadow:
0 12px 30px rgba(37,99,235,0.35);

position:relative;
overflow:hidden;

transition:all 0.3s ease;
}

/* hover naik + glow */
.add-btn:hover{
transform:translateY(-4px) scale(1.05);

box-shadow:
0 18px 45px rgba(37,99,235,0.5),
0 0 20px rgba(59,130,246,0.5);
}

/* klik */
.add-btn:active{
transform:scale(0.95);
}

/* shine effect */
.add-btn::before{
content:'';
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;

background:linear-gradient(120deg,transparent,rgba(255,255,255,0.7),transparent);

transition:0.6s;
}

.add-btn:hover::before{
left:100%;
}

/* SEARCH */
.search{
width:100%;
padding:14px 18px;
border-radius:18px;
border:none;
outline:none;

background:rgba(255,255,255,0.75);
backdrop-filter:blur(12px);

box-shadow:
0 0 0 1px #e2e8f0,
0 8px 25px rgba(0,0,0,0.05);

transition:all 0.35s ease;

position:relative;
overflow:hidden;
}

/* ICON 🔍 */
.search{
padding-left:45px;
background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'/%3E%3C/svg%3E");
background-repeat:no-repeat;
background-position:14px center;
background-size:18px;
}

/* HOVER */
.search:hover{
transform:translateY(-3px) scale(1.01);
box-shadow:
0 12px 30px rgba(0,0,0,0.08),
0 0 12px rgba(59,130,246,0.2);
}

/* FOCUS GLOW */
.search:focus{
transform:scale(1.03);
background:white;

box-shadow:
0 0 0 2px rgba(59,130,246,0.6),
0 0 25px rgba(59,130,246,0.5),
0 15px 40px rgba(59,130,246,0.25);
}

/* placeholder animasi */
.search::placeholder{
color:#94a3b8;
transition:0.3s;
}

.search:focus::placeholder{
opacity:0.4;
transform:translateX(5px);
}

.ripple{
position:absolute;
border-radius:50%;
background:rgba(255,255,255,0.5);
transform:scale(0);
animation:ripple 0.6s linear;
pointer-events:none;
}



@keyframes ripple{
to{
transform:scale(4);
opacity:0;
}
}

/* CARD */
.month-title{
font-size:20px;font-weight:800;
margin:25px 0 10px;color:#2563eb;
}

.card{
display:flex;justify-content:space-between;align-items:center;
padding:20px;border-radius:20px;
background:rgba(255,255,255,0.75);
backdrop-filter:blur(16px);
box-shadow:0 12px 25px rgba(0,0,0,0.08);
margin-bottom:12px;
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
box-shadow:0 20px 40px rgba(0,0,0,0.12);
}

.card-title{font-weight:800;}
.card-info{font-size:13px;color:#64748b;}

.right{display:flex;align-items:center;gap:10px;}

.badge{
display:flex;
align-items:center;
gap:6px;

padding:8px 14px;
border-radius:12px;

font-size:12px;
font-weight:700;
color:white;

box-box-shadow:0 6px 15px rgba(0,0,0,0.12);
transition:.25s;
}

.badge:hover{transform:translateY(-2px) scale(1.05);}

.aksi-btn{
display:inline-flex;
align-items:center;
justify-content:center;
padding:8px 12px;
border:0;
border-radius:10px;
color:#fff;
font-size:12px;
font-weight:700;
font-family:'Poppins',sans-serif;
text-decoration:none;
cursor:pointer;
transition:.25s;
}
.aksi-btn:hover{color:#fff;transform:translateY(-2px);box-shadow:0 8px 16px rgba(0,0,0,.16);}
.aksi-edit{background:linear-gradient(135deg,#3b82f6,#60a5fa);}
.aksi-hapus{background:linear-gradient(135deg,#ef4444,#f87171);}

.selesai{
background:linear-gradient(135deg,#22c55e,#4ade80);
box-shadow:0 8px 18px rgba(34,197,94,0.35);
}

.akan{
background:linear-gradient(135deg,#f59e0b,#fbbf24);
box-shadow:0 8px 18px rgba(245,158,11,0.35);
}

/* PAGINATION */
.pagination{display:flex;justify-content:center;gap:8px;margin-top:20px;}
.page-btn,.nav-btn{
padding:8px 12px;border-radius:10px;background:white;
cursor:pointer;box-shadow:0 5px 12px rgba(0,0,0,0.1);
}
.page-btn.active{background:#3b82f6;color:white;}
</style>
</head>

@php
$isAdmin = session('user.is_admin') ?? false;
@endphp

<body>

<div class="container">

<div class="header">
<div class="header-left">
<img src="{{ asset('logo/logo1.png') }}" class="logo-img">
<div>
<div class="title">DAFTAR SEMUA KEGIATAN</div>
<div class="subtitle">Kelola kegiatan organisasi</div>
</div>
</div>

<a href="/" class="add-btn">← Kembali ke Dashboard</a>
</div>

@if(session('success'))
<div style="margin-bottom:16px;padding:12px 16px;border:1px solid #22c55e;border-radius:12px;background:#dcfce7;color:#166534;font-weight:600;">{{ session('success') }}</div>
@endif
@if(session('error'))
<div style="margin-bottom:16px;padding:12px 16px;border:1px solid #ef4444;border-radius:12px;background:#fee2e2;color:#991b1b;font-weight:600;">{{ session('error') }}</div>
@endif
@if($errors->any())
<div style="margin-bottom:16px;padding:12px 16px;border:1px solid #ef4444;border-radius:12px;background:#fee2e2;color:#991b1b;">
    <ul style="margin:0;padding-left:20px;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if($isAdmin)
<nav style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:18px;">
    <a href="{{ route('admin.dashboard') }}" class="aksi-btn aksi-edit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard Admin
    </a>
    <a href="{{ route('admin.kegiatan.index') }}" class="aksi-btn aksi-edit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/><line x1="8" y1="3" x2="8" y2="7"/><line x1="16" y1="3" x2="16" y2="7"/></svg>
        Kelola Kegiatan
    </a>
</nav>
@endif

<input type="text" id="searchInput" class="search" placeholder="Cari kegiatan...">

@php
$grouped = collect($data)->filter(fn($items)=>$items->count()>0)->values();
@endphp

<div id="monthContainer">

@foreach($grouped as $items)
<div class="month-group">

<div class="month-title">
{{ \Carbon\Carbon::parse($items[0]->tanggal)->translatedFormat('F Y') }}
</div>

@foreach($items as $item)
<div class="card data-item">

<div>
<div class="card-title">{{ $item->nama_kegiatan }}</div>
<div class="card-info">
{{ $item->tanggal }} • {{ $item->waktu }} • {{ $item->lokasi }}
</div>
<div style="margin-top:8px;"><x-divisi-chip :divisi="$item->divisi" /></div>
</div>

<div class="right">

<div class="badge {{ $item->status=='selesai'?'selesai':'akan' }}">
{{ ucfirst($item->status) }}
</div>
@if($isAdmin)
<div style="display:flex;gap:8px;align-items:center;">
<a href="{{ route('kegiatan.edit', $item->id) }}" class="aksi-btn aksi-edit">Edit</a>
<form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kegiatan ini?');">
  @csrf
  @method('DELETE')
  <button type="submit" class="aksi-btn aksi-hapus">Hapus</button>
</form>
</div>
@endif

</div>

</div>
@endforeach

</div>
@endforeach

</div>

<div class="pagination" id="pagination"></div>

</div>



<script>
// SEARCH
searchInput.onkeyup=function(){
let keyword=this.value.toLowerCase();
document.querySelectorAll('.data-item').forEach(card=>{
card.style.display=card.innerText.toLowerCase().includes(keyword)?'flex':'none';
});
};

// PAGINATION
const months=document.querySelectorAll('.month-group');
let currentPage=1;
const perPage=2;

function showPage(page){
currentPage=page;
months.forEach((m,i)=>{
m.style.display=(i>= (page-1)*perPage && i<page*perPage)?'block':'none';
});
renderPagination();
}

function renderPagination(){
pagination.innerHTML="";
let totalPages=Math.ceil(months.length/perPage);

let prev=document.createElement('div');
prev.innerHTML="‹";
prev.className="nav-btn";
prev.onclick=()=>currentPage>1&&showPage(currentPage-1);
pagination.appendChild(prev);

for(let i=Math.max(1,currentPage-1);i<=Math.min(totalPages,currentPage+1);i++){
let btn=document.createElement('div');
btn.innerText=i;
btn.className="page-btn";
if(i===currentPage)btn.classList.add('active');
btn.onclick=()=>showPage(i);
pagination.appendChild(btn);
}

let next=document.createElement('div');
next.innerHTML="›";
next.className="nav-btn";
next.onclick=()=>currentPage<totalPages&&showPage(currentPage+1);
pagination.appendChild(next);
}

showPage(1);

// AUTO STATUS
document.querySelectorAll('.card').forEach(card=>{
let tanggalText=card.querySelector('.card-info').innerText.split('•')[0].trim();
let tanggal=new Date(tanggalText);
let now=new Date();

if(tanggal < now){
let badge=card.querySelector('.badge');
badge.innerText="Selesai";
badge.classList.remove('akan');
badge.classList.add('selesai');
}
});
</script>

<script>
document.querySelectorAll('.add-btn, .search').forEach(el=>{
el.addEventListener('click', function(e){

let ripple = document.createElement('span');
ripple.classList.add('ripple');

let rect = this.getBoundingClientRect();
let size = Math.max(rect.width, rect.height);

ripple.style.width = size + 'px';
ripple.style.height = size + 'px';
ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
ripple.style.top = (e.clientY - rect.top - size/2) + 'px';

this.appendChild(ripple);

setTimeout(()=>ripple.remove(),600);
});
});
</script>

</body>
</html>