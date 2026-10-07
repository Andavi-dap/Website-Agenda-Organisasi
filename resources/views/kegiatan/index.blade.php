<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Kegiatan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:
radial-gradient(circle at 20% 20%, rgba(96,165,250,.40), transparent 40%),
radial-gradient(circle at 80% 10%, rgba(59,130,246,.28), transparent 40%),
linear-gradient(135deg,#e0f2fe,#f8fafc);
display:flex;
min-height:100vh;
color:#1e293b;
overflow-x:hidden;
}

/* SIDEBAR */
.sidebar{
width:250px;
padding:25px;
background:rgba(255,255,255,.55);
backdrop-filter:blur(24px);
flex-shrink:0;
}

.logo{
display:flex;
justify-content:center;
margin-bottom:35px;
}

.logo img{
width:190px;
max-width:100%;
filter:drop-shadow(0 8px 18px rgba(59,130,246,.25));
transition:.3s;
}

.logo img:hover{
transform:scale(1.04);
}

/* MENU */
.menu a{
display:flex;
align-items:center;
gap:12px;
padding:13px 14px;
margin:8px 0;
border-radius:14px;
text-decoration:none;
color:#1e3a8a;
background:rgba(255,255,255,.45);
font-weight:600;
transition:.3s;
position:relative;
overflow:hidden;
}

.menu a:hover{
background:linear-gradient(135deg,#3b82f6,#60a5fa);
color:#fff;
transform:translateX(6px);
box-shadow:0 10px 20px rgba(59,130,246,.18);
}

.side-icon{
width:18px;
height:18px;
stroke:#1e3a8a;
stroke-width:2.2;
flex-shrink:0;
}

.menu a:hover .side-icon{
stroke:#fff;
}

/* MAIN */
.main{
flex:1;
padding:28px;
min-width:0;
}

/* HEADER */
/* HEADER FINAL */
.header-wrap{
display:grid;
grid-template-columns:1fr auto;
align-items:center;
gap:24px;
margin-bottom:28px;
width:100%;
}

.header-left{
min-width:0;
}

.header-left h2{
font-size:24px;
font-weight:800;
color:#0f172a;
margin:0 0 6px 0;
line-height:1.2;
}

.desc{
color:#64748b;
font-size:14px;
line-height:1.5;
margin:0;
max-width:560px;
}

.header-right{
display:flex;
align-items:center;
justify-content:flex-end;
gap:14px;
flex-wrap:nowrap;
}

/* RESPONSIVE */
@media(max-width:1050px){
.header-wrap{
grid-template-columns:1fr;
}

.header-right{
justify-content:flex-start;
flex-wrap:wrap;
}
}

/* SEARCH */
/* SEARCH PREMIUM */
.search-wrap{
position:relative;
display:flex;
align-items:center;
}

.search{
width:260px;
height:48px;
padding:0 18px 0 46px;
border:none;
outline:none;
border-radius:999px;

background:rgba(255,255,255,.88);
backdrop-filter:blur(14px);

font-size:14px;
font-weight:500;
color:#1e293b;

box-shadow:
0 10px 22px rgba(59,130,246,.10),
inset 0 1px 0 rgba(255,255,255,.9);

transition:.28s ease;
}

/* ICON 🔍 */
.search{
padding-left:45px;
background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'/%3E%3C/svg%3E");
background-repeat:no-repeat;
background-position:14px center;
background-size:18px;
}

.search::placeholder{
color:#94a3b8;
font-weight:500;
}

.search:focus{
width:300px;
box-shadow:
0 14px 28px rgba(59,130,246,.18),
0 0 0 4px rgba(59,130,246,.08);
}

/* icon search */
.search-icon{
position:absolute;
left:16px;
width:18px;
height:18px;
stroke:#3b82f6;
stroke-width:2.2;
pointer-events:none;
}

/* NOTIF */
.notif-btn{
width:50px;
height:50px;
min-width:50px;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
position:relative;
text-decoration:none;
cursor:pointer;
border:none;
outline:none;

background:linear-gradient(145deg,#ffffff,#eef4ff);
backdrop-filter:blur(14px);

box-shadow:
0 10px 22px rgba(59,130,246,.14),
inset 0 1px 0 rgba(255,255,255,.9);

transition:all .28s ease;

/* penting */
overflow:visible;
}

/* icon di tengah */
.notif-btn svg,
.notif-btn i{
width:22px;
height:22px;
color:#2563eb;
stroke:#2563eb;
stroke-width:2.2;
z-index:2;
position:relative;
}

/* hover */
.notif-btn:hover{
transform:translateY(-3px) scale(1.06);
box-shadow:
0 16px 28px rgba(59,130,246,.22),
0 0 0 6px rgba(59,130,246,.08);
}

/* klik */
.notif-btn:active{
transform:scale(.96);
}

/* badge merah di LUAR lingkaran */
.notif-badge{
position:absolute;
top:-5px;
right:-5px;

width:22px;
height:22px;
border-radius:50%;

background:#ef4444;
color:#fff;

font-size:10px;
font-weight:800;
line-height:1;

display:flex;
align-items:center;
justify-content:center;

border:2px solid #ffffff;
box-shadow:0 4px 10px rgba(239,68,68,.28);

z-index:20;

animation:notifPulse 1.5s infinite;
}

/* animasi kecil */
@keyframes notifPulse{
0%{transform:scale(1);}
50%{transform:scale(1.1);}
100%{transform:scale(1);}
}

/* PROFILE */
.profile{
position:relative;
}

.profile-box{
display:flex;
align-items:center;
gap:10px;
padding:8px 14px;
border-radius:18px;
background:rgba(255,255,255,.75);
cursor:pointer;
transition:.3s;
position:relative;
overflow:hidden;
}

.profile-box:hover{
transform:translateY(-2px);
box-shadow:0 8px 18px rgba(59,130,246,.16);
}

.profile-box img{
width:42px;
height:42px;
border-radius:50%;
object-fit:cover;
border:2px solid #60a5fa;
}

.dropdown{
display:none;
position:absolute;
right:0;
top:62px;
background:#fff;
border-radius:14px;
overflow:hidden;
box-shadow:0 18px 35px rgba(0,0,0,.12);
min-width:180px;
z-index:999;
animation:fadeDown .25s ease;
}

.dropdown a{
display:block;
padding:12px 15px;
text-decoration:none;
color:#1e293b;
font-size:14px;
}

.dropdown a:hover{
background:#3b82f6;
color:#fff;
}

@keyframes fadeDown{
from{opacity:0;transform:translateY(-8px);}
to{opacity:1;transform:translateY(0);}
}


.stat-card{
background:rgba(255,255,255,.35);
backdrop-filter:blur(12px);
border:1px solid rgba(255,255,255,.35);
border-radius:22px;
padding:20px 22px;
display:flex;
align-items:center;
gap:18px;
min-height:145px;
transition:.3s ease;
box-shadow:0 10px 20px rgba(0,0,0,.04);
}

/* TEXT AREA */
.stat-text{
display:flex;
flex-direction:column;
justify-content:center;
height:100%;
line-height:1.2;
}

.stat-text h4{
font-size:14px;
font-weight:700;
color:#1e3a8a;
margin:0 0 10px 0;
min-height:18px;   /* semua judul sejajar */
}

.stat-text h2{
font-size:48px;
font-weight:800;
color:#0f172a;
margin:0 0 10px 0;
line-height:1;
min-height:48px;   /* angka rata */
display:flex;
align-items:center;
}

.stat-text p{
font-size:13px;
color:#64748b;
font-weight:500;
margin:0;
min-height:34px;   /* subtitle sejajar */
display:flex;
align-items:flex-start;
}

.stat-card{
background:rgba(255,255,255,.35);
backdrop-filter:blur(12px);
border:1px solid rgba(255,255,255,.35);
border-radius:22px;
padding:20px 22px;
display:flex;
align-items:center;
gap:18px;
min-height:140px;
transition:.3s ease;
box-shadow:0 10px 20px rgba(0,0,0,.04);
}

.stat-card:hover{
transform:translateY(-6px);
box-shadow:0 18px 25px rgba(59,130,246,.12);
}

.icon-circle{
width:58px;
height:58px;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
color:white;
flex-shrink:0;
box-shadow:0 10px 18px rgba(0,0,0,.08);
position:relative;
}

.icon-circle svg{
width:28px;
height:28px;
stroke:white;
}

/* warna */
.blue{
background:linear-gradient(135deg,#3b82f6,#60a5fa);
}

.green{
background:linear-gradient(135deg,#22c55e,#34d399);
}

.purple{
background:linear-gradient(135deg,#7c3aed,#8b5cf6);
}

.cyan{
background:linear-gradient(135deg,#3b82f6,#60a5fa);
}

/* lingkaran luar partisipasi */
.double-ring::before{
content:'';
position:absolute;
inset:-10px;
border-radius:50%;
border:8px solid rgba(255,255,255,.35);
}

/* GANTI BAGIAN CSS STATS INI AGAR TIDAK TURUN KE BAWAH */

.stats{
display:grid;
grid-template-columns:repeat(4,minmax(0,1fr));
gap:18px;
margin-bottom:25px;
width:100%;
}

/* CARD */
.stat-card{
background:rgba(255,255,255,.35);
backdrop-filter:blur(12px);
border:1px solid rgba(255,255,255,.35);
border-radius:22px;
padding:20px 22px;
display:flex;
align-items:center;
gap:18px;
min-height:145px;
transition:.3s ease;
box-shadow:0 10px 20px rgba(0,0,0,.04);
overflow:hidden;
}

.stat-card:hover{
transform:translateY(-6px);
box-shadow:0 18px 25px rgba(59,130,246,.12);
}

/* TEXT */
.stat-text{
display:flex;
flex-direction:column;
justify-content:center;
line-height:1.2;
flex:1;
min-width:0;
}

.stat-text h4{
font-size:14px;
font-weight:700;
color:#1e3a8a;
margin:0 0 10px 0;
min-height:18px;
}

.stat-text h2{
font-size:48px;
font-weight:800;
color:#0f172a;
margin:0 0 10px 0;
line-height:1;
min-height:48px;
display:flex;
align-items:center;
}

.stat-text p{
font-size:13px;
color:#64748b;
font-weight:500;
margin:0;
min-height:34px;
display:flex;
align-items:flex-start;
}

/* RESPONSIVE */
@media(max-width:1200px){
.stats{
grid-template-columns:repeat(2,1fr);
}
}

@media(max-width:700px){
.stats{
grid-template-columns:1fr;
}
}

/* CONTENT */
.content{
display:grid;
grid-template-columns:2fr 1fr;
gap:20px;
align-items:start;
}

.glass{
background:rgba(255,255,255,.68);
padding:20px;
border-radius:22px;
box-shadow:0 10px 20px rgba(0,0,0,.04);
}

/* LEGEND */
.legend{
display:flex;
gap:15px;
font-size:13px;
margin-bottom:15px;
}

.legend span{
display:flex;
align-items:center;
gap:6px;
}

.dot{
width:10px;
height:10px;
border-radius:50%;
}

.yellow{background:#f59e0b;}
.green{background:#22c55e;}

/* ROW */
.row{
display:flex;
justify-content:space-between;
align-items:center;
padding:14px;
margin-bottom:12px;
border-radius:14px;
background:rgba(255,255,255,.85);
transition:.3s;
position:relative;
overflow:hidden;
}

.row:hover{
transform:translateY(-3px);
box-shadow:0 10px 18px rgba(0,0,0,.05);
}

.row.akan{
border-left:4px solid #f59e0b;
}

.row.selesai{
border-left:4px solid #22c55e;
}

/* ===== STATUS BADGE DASHBOARD ===== */
.status-badge{
display:inline-flex;
align-items:center;
gap:6px;

padding:8px 14px;
border-radius:999px;

font-size:12px;
font-weight:700;
color:white;

position:relative;
overflow:hidden;

transition:0.3s;
box-shadow:0 6px 15px rgba(0,0,0,0.15);
}

/* HOVER HIDUP */
.status-badge:hover{
transform:translateY(-2px) scale(1.05);
}

/* SHINE EFFECT */
.status-badge::before{
content:'';
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;
background:linear-gradient(120deg,transparent,rgba(255,255,255,0.6),transparent);
transition:0.6s;
}

.status-badge:hover::before{
left:100%;
}

/* ===== WARNA ===== */
.status-akan{
background:linear-gradient(135deg,#f59e0b,#fbbf24);
box-shadow:0 8px 18px rgba(245,158,11,0.4);
}

.status-selesai{
background:linear-gradient(135deg,#22c55e,#4ade80);
box-shadow:0 8px 18px rgba(34,197,94,0.4);
}

/* CALENDAR */
#calendar{
min-height:420px;
}

.fc-toolbar-title{
font-size:16px !important;
font-weight:700 !important;
}

.fc-button{
border:none !important;
border-radius:10px !important;
font-size:12px !important;
padding:6px 10px !important;
}

/* RIPPLE */
.ripple{
position:absolute;
border-radius:50%;
background:rgba(59,130,246,.35);
transform:scale(0);
animation:ripple .6s linear;
pointer-events:none;
}

@keyframes ripple{
to{
transform:scale(4);
opacity:0;
}
}

/* RESPONSIVE */
@media(max-width:1200px){
.stats{
grid-template-columns:repeat(2,1fr);
}
}

@media(max-width:900px){
.content{
grid-template-columns:1fr;
}
}

@media(max-width:768px){
body{
flex-direction:column;
}

.sidebar{
width:100%;
}

.stats{
grid-template-columns:1fr;
}
}
</style>
</head>

@php
$jabatan = session('user.jabatan', '');
$isAdmin = session('user.is_admin') ?? (
    $jabatan === 'Ketua Himpunan' ||
    $jabatan === 'Wakil Ketua Himpunan' ||
    str_starts_with($jabatan, 'Ketua Divisi')
);
@endphp

<body>

<!-- SIDEBAR -->
<div class="sidebar">

<div class="logo">
<img src="{{ asset('logo/logo.png') }}" alt="Logo">
</div>

<div class="menu">

<a href="/">
<svg class="side-icon" viewBox="0 0 24 24" fill="none">
<path d="M3 10.5L12 3l9 7.5"/>
<path d="M5 9.5V20h14V9.5"/>
</svg>
Dashboard
</a>

<a href="{{ route('kegiatan.kalender') }}">
<svg class="side-icon" viewBox="0 0 24 24" fill="none">
<rect x="3" y="5" width="18" height="16" rx="2"/>
<line x1="3" y1="10" x2="21" y2="10"/>
</svg>
Kalender
</a>

<a href="{{ route('kegiatan.akan') }}">
<svg class="side-icon" viewBox="0 0 24 24" fill="none">
<circle cx="12" cy="12" r="9"/>
<path d="M12 7v5l3 2"/>
</svg>
Akan Datang
</a>

<a href="{{ route('kegiatan.selesai') }}">
<svg class="side-icon" viewBox="0 0 24 24" fill="none">
<circle cx="12" cy="12" r="9"/>
<path d="M8.5 12.5l2.2 2.2L16 9"/>
</svg>
Selesai
</a>

</div>
</div>

<!-- MAIN -->
<div class="main">

@if(session('error'))
<div style="background:rgba(239,68,68,0.12); border:1px solid #ef4444; color:#991b1b; padding:14px 18px; border-radius:16px; margin-bottom:20px; font-weight:600; display:flex; align-items:center; gap:10px;">
    <span>⚠️ {{ session('error') }}</span>
</div>
@endif
@if(session('success'))
<div style="background:rgba(34,197,94,0.12); border:1px solid #22c55e; color:#166534; padding:14px 18px; border-radius:16px; margin-bottom:20px; font-weight:600; display:flex; align-items:center; gap:10px;">
    <span>✅ {{ session('success') }}</span>
</div>
@endif

<!-- HEADER -->
<div class="header-wrap">

<div class="header-left">
<h2>Halo, {{ session('user.nama') }} 👋</h2>
<p class="desc">
Kelola dan pantau kegiatan himpunan mahasiswa multimedia dengan mudah
</p>
</div>

<div class="header-right">

<a href="{{ route('kegiatan.akan') }}" class="notif-btn">
🔔
@if($notif > 0)
<span class="notif-badge">{{ $notif }}</span>
@endif
</a>

<div class="search-wrap">

<svg class="search-icon" viewBox="0 0 24 24" fill="none">
<circle cx="11" cy="11" r="7"></circle>
<path d="M20 20L17 17"></path>
</svg>

<input type="text" id="search" class="search" placeholder="Cari kegiatan...">

</div>

<div class="profile">

<div class="profile-box" onclick="toggleProfile()">
<img src="{{ asset('foto/'.session('user.foto')) }}">
<div>
<b>{{ session('user.nama') }}</b><br>
<small style="color:#64748b">{{ session('user.jabatan') }}</small>
@if($isAdmin)
<br><span style="background:linear-gradient(135deg,#7c3aed,#6366f1);color:white;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;display:inline-block;margin-top:2px;">Admin</span>
@else
<br><span style="background:linear-gradient(135deg,#3b82f6,#60a5fa);color:white;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;display:inline-block;margin-top:2px;">Anggota</span>
@endif
</div>
</div>

<div id="dropdown" class="dropdown">
<div style="padding:10px 15px; border-bottom:1px solid #f1f5f9; font-size:12px; color:#64748b; background:rgba(248,250,252,0.85);">
Peran: <strong style="color:{{ $isAdmin ? '#7c3aed' : '#2563eb' }}">{{ $isAdmin ? 'Admin' : 'Anggota' }}</strong>
</div>
<a href="{{ route('profile.view') }}">View Profile</a>
@if($isAdmin)
    <a href="{{ route('admin.dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal ml-2">
        Admin Dashboard
    </a>
@endif
<a href="/logout">Logout</a>
</div>

</div>

</div>
</div>

<!-- STATS -->
<!-- GANTI BAGIAN HTML STATS LAMA DENGAN INI -->

<div class="stats">

<!-- TOTAL -->
<div class="stat-card">
<div class="icon-circle blue">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
<rect x="3" y="5" width="18" height="16" rx="2"/>
<line x1="3" y1="10" x2="21" y2="10"/>
<line x1="8" y1="3" x2="8" y2="7"/>
<line x1="16" y1="3" x2="16" y2="7"/>
</svg>
</div>

<div class="stat-text">
<h4>Total Kegiatan</h4>
<h2>{{ $data->count() }}</h2>
<p>Semua waktu</p>
</div>
</div>

<!-- AKAN DATANG -->
<div class="stat-card">
<div class="icon-circle yellow">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="12" cy="12" r="9"/>
<path d="M12 7v5l3 2"/>
</svg>
</div>

<div class="stat-text">
<h4>Akan Datang</h4>
<h2>{{ $data->where('status','akan datang')->count() }}</h2>
<p>Belum dilaksanakan</p>
</div>
</div>

<!-- SELESAI -->
<div class="stat-card">
<div class="icon-circle green">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="12" cy="12" r="9"/>
<path d="M8.5 12.5l2.2 2.2L16 9"/>
</svg>
</div>

<div class="stat-text">
<h4>Selesai</h4>
<h2>{{ $data->where('status','selesai')->count() }}</h2>
<p>Telah dilaksanakan</p>
</div>
</div>

<!-- PARTISIPASI -->
<div class="stat-card">
<div class="icon-circle cyan double-ring">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
<circle cx="9" cy="8" r="2.2"/>
<circle cx="16" cy="8" r="2.2"/>
<path d="M4 18c1.2-2.7 3.6-4 5.2-4s4 1.3 5.2 4"/>
<path d="M12 18c1-2.2 2.8-3.3 4.5-3.3S20 15.7 21 18"/>
</svg>
</div>

<div class="stat-text">
<h4>Partisipan Aktif</h4>
<h2>71</h2>
<p>Total anggota</p>
</div>
</div>

</div>

<!-- CONTENT -->
<div class="content">

<div class="glass">

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
<h3>Daftar Kegiatan</h3>
<a href="/semua-kegiatan" style="text-decoration:none;color:#2563eb;font-size:13px;font-weight:700;">Lihat Semua</a>
</div>

<div class="legend">
<span><div class="dot yellow"></div>Akan Datang</span>
<span><div class="dot green"></div>Selesai</span>
</div>

@foreach($latest as $d)
<div class="row {{ $d->status=='selesai' ? 'selesai':'akan' }}">

<div>
<strong>{{ $d->nama_kegiatan }}</strong><br>
<small>{{ $d->tanggal }} | {{ $d->waktu }}</small>
</div>

<div class="status-badge {{ $d->status == 'selesai' ? 'status-selesai' : 'status-akan' }}">
{{ $d->status == 'selesai' ? 'Selesai' : 'Akan Datang' }}
</div>

</div> {{-- INI YANG KURANG --}}
@endforeach

</div>

<div class="glass">
<h3 style="margin-bottom:15px;">Kalender</h3>
<div id="calendar"></div>
</div>

</div>

</div>

<script>

// SEARCH REALTIME KEGIATAN
document.getElementById('search').addEventListener('keyup', function(){

let keyword = this.value.toLowerCase();
let items = document.querySelectorAll('.row');

items.forEach(function(item){

let text = item.innerText.toLowerCase();

if(text.includes(keyword)){
item.style.display = 'flex';
}else{
item.style.display = 'none';
}

});

});

function toggleProfile(){
let d=document.getElementById('dropdown');
d.style.display=d.style.display==='block'?'none':'block';
}

window.onclick=function(e){
if(!e.target.closest('.profile')){
document.getElementById('dropdown').style.display='none';
}
};

var calendar=new FullCalendar.Calendar(document.getElementById('calendar'),{
initialView:'dayGridMonth',
headerToolbar:{left:'prev,next today',center:'title',right:''},
events:[
@foreach($data as $d)
{
title:"{{ $d->nama_kegiatan }}",
start:"{{ $d->tanggal }}",
color:"{{ $d->status=='selesai' ? '#22c55e':'#3b82f6' }}"
},
@endforeach
]
});

calendar.render();

/* Ripple */
document.querySelectorAll('.menu a,.notif-btn,.profile-box,.stat-card,.row').forEach(el=>{
el.addEventListener('click',function(e){

let ripple=document.createElement('span');
ripple.classList.add('ripple');

let rect=this.getBoundingClientRect();
let size=Math.max(rect.width,rect.height);

ripple.style.width=size+'px';
ripple.style.height=size+'px';
ripple.style.left=(e.clientX-rect.left-size/2)+'px';
ripple.style.top=(e.clientY-rect.top-size/2)+'px';

this.appendChild(ripple);

setTimeout(()=>ripple.remove(),600);

});
});
</script>

</body>
</html>