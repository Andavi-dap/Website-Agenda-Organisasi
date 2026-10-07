<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KALENDER KEGIATAN</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:linear-gradient(135deg,#e0f2fe,#f8fafc);
min-height:100vh;
padding:30px;
}

.container{
max-width:1100px;
margin:auto;
}

/* HEADER */
.topbar{
display:flex;
justify-content:space-between;
align-items:center;
gap:20px;
margin-bottom:25px;
flex-wrap:wrap; /* FIX */
}

/* LOGO + TITLE */
.header-left{
display:flex;
align-items:center;
gap:12px;
}

.logo-img{
width:80px;
height:80px;
object-fit:contain;
filter:drop-shadow(0 6px 12px rgba(37,99,235,0.3));
transition:0.3s;
}

.logo-img:hover{
transform:scale(1.08);
filter:drop-shadow(0 10px 18px rgba(37,99,235,0.5));
}

.title{
font-size:28px;
font-weight:800;
background:linear-gradient(135deg,#3b82f6,#2563eb);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.subtitle{
color:#64748b;
font-size:14px;
margin-top:4px;
}

.nav-month{
display:flex;
align-items:center;
gap:10px;
flex-wrap:wrap;
white-space:nowrap;
}

.month-name{
font-weight:800;
color:#1e293b;
min-width:170px;
text-align:center;
font-size:16px;
}

/* BUTTON */
.btn,
.small-btn{
position:relative;
overflow:hidden;
text-decoration:none;
cursor:pointer;
user-select:none;
display:inline-flex;
align-items:center;
justify-content:center;
white-space:nowrap;
transition:all .28s ease;
flex-shrink:0;
}

.btn{
padding:12px 18px;
border-radius:14px;
background:linear-gradient(135deg,#3b82f6,#60a5fa);
color:#fff;
font-weight:700;
font-size:14px;
box-shadow:0 10px 20px rgba(59,130,246,.18);
}

.small-btn{
padding:10px 14px;
border-radius:12px;
background:#fff;
color:#2563eb;
font-weight:700;
box-shadow:0 0 0 1px #dbeafe;
}

.btn:hover,
.small-btn:hover{
transform:translateY(-2px) scale(1.02);
box-shadow:0 14px 24px rgba(0,0,0,.08);
}

.btn:active,
.small-btn:active{
transform:scale(.96);
}

/* RIPPLE */
.ripple{
position:absolute;
border-radius:50%;
transform:scale(0);
background:rgba(255,255,255,.45);
animation:rippleSmooth .7s ease-out;
pointer-events:none;
filter:blur(1px);
}

@keyframes rippleSmooth{
to{
transform:scale(4.5);
opacity:0;
}
}

/* CARD */
.card{
background:rgba(255,255,255,.75);
backdrop-filter:blur(18px);
border-radius:22px;
padding:25px;
box-shadow:0 15px 35px rgba(0,0,0,.08);
}

/* CALENDAR */
.calendar{
display:grid;
grid-template-columns:repeat(7,1fr);
gap:12px;
}

.day-name{
text-align:center;
font-weight:700;
color:#334155;
padding:10px 0;
}

.box{
min-height:130px;
background:#fff;
border-radius:16px;
padding:10px;
box-shadow:0 0 0 1px #e5e7eb;
transition:.25s;
}

.empty{
background:transparent;
box-shadow:none;
}

.number{
font-size:15px;
font-weight:800;
color:#1e293b;
margin-bottom:8px;
}

.today{
box-shadow:0 0 0 2px rgba(59,130,246,.35);
}

.clickable{
cursor:pointer;
}

.clickable:hover{
transform:translateY(-4px);
box-shadow:0 15px 20px rgba(0,0,0,.08);
}

.event{
background:#dbeafe;
color:#1d4ed8;
padding:6px 8px;
border-radius:10px;
font-size:12px;
margin-bottom:6px;
font-weight:600;
}

.time{
display:block;
font-size:11px;
opacity:.8;
margin-top:3px;
}

/* MODAL */
.modal{
position:fixed;
inset:0;
background:rgba(0,0,0,.45);
display:none;
justify-content:center;
align-items:center;
z-index:999;
}

.modal-box{
width:95%;
max-width:520px;
background:#fff;
border-radius:22px;
padding:25px;
animation:pop .25s ease;
}

@keyframes pop{
from{transform:scale(.8);opacity:0;}
to{transform:scale(1);opacity:1;}
}

.modal-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.modal-header h2{
font-size:20px;
color:#1e293b;
}

.modal-header button{
border:none;
background:#ef4444;
color:#fff;
width:36px;
height:36px;
border-radius:50%;
cursor:pointer;
}

.item{
background:#f8fafc;
padding:14px;
border-radius:14px;
margin-bottom:12px;
}

.item-title{
font-weight:700;
color:#2563eb;
margin-bottom:6px;
}

.item small{
display:block;
color:#64748b;
margin-top:4px;
}

/* RESPONSIVE */
@media(max-width:900px){
.topbar{
flex-direction:column;
align-items:flex-start;
}

.nav-month{
width:100%;
overflow-x:auto;
padding-bottom:5px;
}

.calendar{
grid-template-columns:repeat(2,1fr);
}

.day-name{
display:none;
}
}

@media(max-width:600px){
.calendar{
grid-template-columns:1fr;
}
}
</style>
</head>

<body>

<div class="container">

<div class="topbar">

<div class="header-left">
<img src="{{ asset('logo/logo1.png') }}" class="logo-img">

<div>
<div class="title">KALENDER KEGIATAN</div>
<div class="subtitle">Semua kegiatan organisasi berdasarkan tanggal</div>
</div>
</div>

<div class="nav-month">
<a href="{{ url('/kalender?bulan='.$prevMonth.'&tahun='.$prevYear) }}" class="small-btn">← Bulan Sebelumnya</a>

<div class="month-name">{{ $namaBulan }} {{ $tahun }}</div>

<a href="{{ url('/kalender?bulan='.$nextMonth.'&tahun='.$nextYear) }}" class="small-btn">Bulan Berikutnya →</a>

<a href="/" class="btn">Kembali Dashboard</a>
</div>

</div>

<div class="card">

<div class="calendar">

<div class="day-name">Sen</div>
<div class="day-name">Sel</div>
<div class="day-name">Rab</div>
<div class="day-name">Kam</div>
<div class="day-name">Jum</div>
<div class="day-name">Sab</div>
<div class="day-name">Min</div>

@for($i=1; $i < $startDay; $i++)
<div class="box empty"></div>
@endfor

@for($tgl=1; $tgl <= $jumlahHari; $tgl++)

@php
$fullDate = $tahun.'-'.str_pad($bulan,2,'0',STR_PAD_LEFT).'-'.str_pad($tgl,2,'0',STR_PAD_LEFT);
$list = $events[$fullDate] ?? [];
$isToday = $fullDate == date('Y-m-d');
@endphp

<div class="box {{ $isToday ? 'today' : '' }} {{ count($list) ? 'clickable' : '' }}"
@if(count($list)) onclick="showEvent('{{ $fullDate }}')" @endif>

<div class="number">{{ $tgl }}</div>

@foreach($list as $item)
<div class="event">
{{ $item->nama_kegiatan }}
<span class="time">{{ $item->waktu }}</span>
</div>
@endforeach

</div>

@endfor

</div>
</div>

</div>

<!-- MODAL -->
<div class="modal" id="eventModal">
<div class="modal-box">

<div class="modal-header">
<h2>Agenda Tanggal <span id="modalDate"></span></h2>
<button onclick="closeModal()">✕</button>
</div>

<div id="modalContent"></div>

</div>
</div>

<script>
document.querySelectorAll('.btn,.small-btn').forEach(button=>{
button.addEventListener('click',function(e){

const ripple=document.createElement('span');
ripple.classList.add('ripple');

const rect=this.getBoundingClientRect();
const size=Math.max(rect.width,rect.height);

ripple.style.width=size+'px';
ripple.style.height=size+'px';
ripple.style.left=(e.clientX-rect.left-size/2)+'px';
ripple.style.top=(e.clientY-rect.top-size/2)+'px';

this.appendChild(ripple);

setTimeout(()=>{
ripple.remove();
},700);

});
});

const agendaData = {
@foreach($events as $tanggal => $items)
"{{ $tanggal }}":[
@foreach($items as $item)
{
nama:"{{ $item->nama_kegiatan }}",
waktu:"{{ $item->waktu }}",
lokasi:"{{ $item->lokasi }}",
status:"{{ $item->status }}"
},
@endforeach
],
@endforeach
};

function showEvent(date){
if(!agendaData[date]) return;

document.getElementById('eventModal').style.display='flex';
document.getElementById('modalDate').innerText=date;

let html='';

agendaData[date].forEach(item=>{
html += `
<div class="item">
<div class="item-title">${item.nama}</div>
<small>🕒 ${item.waktu}</small>
<small>📍 ${item.lokasi}</small>
<small>📌 ${item.status}</small>
</div>
`;
});

document.getElementById('modalContent').innerHTML=html;
}

function closeModal(){
document.getElementById('eventModal').style.display='none';
}

window.onclick=function(e){
const modal=document.getElementById('eventModal');
if(e.target===modal){
closeModal();
}
}
</script>

</body>
</html>