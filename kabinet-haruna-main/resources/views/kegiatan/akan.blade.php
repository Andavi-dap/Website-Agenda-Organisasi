<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AGENDA AKAN DATANG</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:
radial-gradient(circle at 20% 20%, rgba(96,165,250,0.35), transparent 35%),
radial-gradient(circle at 80% 10%, rgba(59,130,246,0.28), transparent 35%),
linear-gradient(135deg,#e0f2fe,#f8fafc);
min-height:100vh;
padding:40px;
color:#1e293b;
}

.container{
max-width:1100px;
margin:auto;
}

/* HEADER */
.header{
display:flex;
align-items:center;
gap:16px;
margin-bottom:25px;
}

.header img{
width:80px;
height:80px;
object-fit:contain;
}

.title{
font-size:32px;
font-weight:800;

background:linear-gradient(135deg,#1d4ed8,#38bdf8);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

text-shadow:
0 4px 10px rgba(37,99,235,0.25),
0 1px 2px rgba(0,0,0,0.08);

/* sedikit glow */
filter:drop-shadow(0 6px 18px rgba(59,130,246,0.25));
}

.subtitle{
color:#64748b;
font-size:14px;
margin-top:5px;
}

/* SEARCH */
.search-row{
display:flex;
gap:12px;
margin:20px 0 30px;
}

.search{
flex:1;
padding:14px 16px;
border-radius:16px;
border:none;
background:rgba(255,255,255,0.75);
backdrop-filter:blur(10px);
box-shadow:0 0 0 1px #e2e8f0;
transition:all 0.25s ease;
}

/* ICON 🔍 */
.search{
padding-left:45px;
background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'/%3E%3C/svg%3E");
background-repeat:no-repeat;
background-position:14px center;
background-size:18px;
}

.search:focus{
outline:none;
transform:scale(1.02);
box-shadow:
0 0 0 2px rgba(59,130,246,0.5),
0 0 18px rgba(59,130,246,0.35),
0 10px 25px rgba(59,130,246,0.15);
}

/* SEARCH + FILTER POP EFFECT */
.search,
.filter{
transition: all 0.25s ease;
position: relative;
}

/* hover naik */
.search:hover,
.filter:hover{
transform: translateY(-3px) scale(1.02);
box-shadow:
0 12px 30px rgba(59,130,246,0.18),
0 0 0 2px rgba(59,130,246,0.08);
}

/* klik/focus */
.search:focus,
.filter:focus{
transform: scale(1.04);
box-shadow:
0 0 0 3px rgba(59,130,246,0.25),
0 10px 30px rgba(59,130,246,0.25);
}

.search, .filter{
position: relative;
overflow: hidden;
}

/* DROPDOWN */
.filter{
appearance:none;
-webkit-appearance:none;
-moz-appearance:none;

padding:14px 50px 14px 18px; /* kasih ruang kanan */

border-radius:18px;
border:none;

background-color:rgba(255,255,255,0.85);

/* ICON PANAH */
background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='none' stroke='%233b82f6' stroke-width='2.5' viewBox='0 0 24 24'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");

background-repeat:no-repeat;
background-position:right 16px center;
background-size:18px;

font-weight:600;
cursor:pointer;

box-shadow:0 0 0 1px #e2e8f0;
}

.filter:hover{
transform:translateY(-2px);
box-shadow:0 10px 25px rgba(59,130,246,0.25);
}

.filter:focus{
outline:none;
box-shadow:
0 0 0 3px rgba(59,130,246,0.25),
0 10px 25px rgba(59,130,246,0.25);
}

.ripple{
position:absolute;
border-radius:50%;
background:rgba(59,130,246,.25);
transform:scale(0);
animation:rippleAnim .6s linear;
pointer-events:none;
}

@keyframes rippleAnim{
to{
transform:scale(4);
opacity:0;
}
}

.search::placeholder{
transition:0.3s;
}

.search:focus::placeholder{
opacity:0.5;
transform:translateX(5px);
}

/* MONTH */
.month-title{
font-size:20px;
font-weight:800;
margin:20px 0 12px;
color:#2563eb;
}

/* CARD */
.card{
display:flex;
justify-content:space-between;
align-items:center;
background:rgba(255,255,255,0.75);
backdrop-filter:blur(16px);
padding:18px;
border-radius:18px;
margin-bottom:14px;
box-shadow:0 12px 25px rgba(0,0,0,0.06);
transition:0.3s;
}

.card{
transition:0.3s, opacity 0.2s;
}

.card:hover{
transform:translateY(-4px);
box-shadow:0 18px 35px rgba(0,0,0,0.08);
}

.card-left{
display:flex;
gap:14px;
align-items:center;
}

.card-title{
font-weight:800;
font-size:16px;
}

.card-info{
font-size:13px;
color:#64748b;
margin-top:4px;
}

/* BADGE GLOSSY */
.badge{
padding:8px 18px;
border-radius:999px;
font-size:12px;
font-weight:800;
color:#fff;
position:relative;
overflow:hidden;
box-shadow:0 6px 18px rgba(0,0,0,0.2);
}

.long{
background:linear-gradient(135deg,#3b82f6,#60a5fa);
}

.near{
background:linear-gradient(135deg,#f59e0b,#fbbf24);
}

.soon{
background:linear-gradient(135deg,#ef4444,#f87171);
}

.badge::before{
content:'';
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;
background:linear-gradient(120deg,transparent,rgba(255,255,255,0.6),transparent);
transition:0.6s;
}

.badge:hover::before{
left:100%;
}

/* COUNTDOWN */
.countdown{
font-size:12px;
color:#475569;
margin-top:4px;
}

/* PROGRESS */
.progress{
height:5px;
background:#e2e8f0;
border-radius:10px;
margin-top:8px;
overflow:hidden;
}

.progress-bar{
height:100%;
background:linear-gradient(135deg,#3b82f6,#60a5fa);
width:0%;
}

/* BUTTON FIX */
.back{
display:inline-flex;
align-items:center;
justify-content:center;
padding:14px 22px;
border-radius:16px;
background:linear-gradient(135deg,#2563eb,#3b82f6);
color:#fff;
font-weight:700;
text-decoration:none;
box-shadow:0 10px 25px rgba(37,99,235,0.35);
position:relative;
overflow:hidden;
transition:0.25s;
margin-top:20px;
}


.back:hover{
transform:translateY(-3px) scale(1.03);
box-shadow:0 15px 35px rgba(37,99,235,0.5);
}

.back:active{
transform:scale(0.95);
}

/* FIX SHINE */
.back::before{
content:'';
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;
background:linear-gradient(120deg,transparent,rgba(255,255,255,0.6),transparent);
transition:0.6s;
}

.back:hover::before{
left:100%;
}
</style>
</head>

<body>

<div class="container">

<div class="header">
<img src="{{ asset('logo/logo1.png') }}">
<div>
<div class="title">AGENDA AKAN DATANG</div>
<div class="subtitle">Daftar kegiatan organisasi yang akan dilaksanakan.</div>
</div>
</div>

<div class="search-row">
<input type="text" id="searchInput" class="search" placeholder="Cari kegiatan...">
<select id="filterBulan" class="filter">
<option value="all">Semua Bulan</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
</div>

@foreach($data as $bulan => $items)
<div class="month-title">{{ $bulan }}</div>

@foreach($items as $item)

@php
$diff = (int) now()->diffInDays($item->tanggal, false);

$class = 'long';
if($diff <= 3 && $diff >= 0) $class = 'soon';
elseif($diff <= 14 && $diff > 3) $class = 'near';
@endphp

<div class="card" 
     data-bulan="{{ \Carbon\Carbon::parse($item->tanggal)->format('m') }}">
<div class="card-left">
<div class="icon"></div>

<div>
<div class="card-title">{{ $item->nama_kegiatan }}</div>
<div class="card-info">
{{ $item->tanggal }} • {{ $item->waktu }} • {{ $item->lokasi }}
</div>

<div class="countdown" data-date="{{ \Carbon\Carbon::parse($item->tanggal . ' ' . $item->waktu)->format('Y-m-d\TH:i:s') }}"></div>
<div class="progress">
<div class="progress-bar" data-date="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}"></div>
</div>

</div>
</div>

<div>
<div class="badge {{ $class }}">
@if($diff >= 0)
H-{{ $diff }}
@else
H+{{ abs($diff) }}
@endif
</div>
</div>

</div>

@endforeach
@endforeach

<div id="noData" style="
display:none;
text-align:center;
margin-top:40px;
padding:20px;
border-radius:16px;
background:rgba(255,255,255,0.6);
backdrop-filter:blur(10px);
box-shadow:0 10px 25px rgba(0,0,0,0.05);
font-weight:600;
color:#64748b;
">Tidak ada agenda di bulan ini
</div>

<a href="/" class="back">← Kembali ke Dashboard</a>

</div>

<script>
function updateCountdown(){
document.querySelectorAll('.countdown').forEach(el=>{
let target = new Date(el.dataset.date).getTime();
let now = new Date().getTime();
let diff = target - now;

if(diff <= 0){
el.innerText = "Sedang berlangsung / selesai";
return;
}

let d = Math.floor(diff/(1000*60*60*24));
let h = Math.floor((diff%(1000*60*60*24))/(1000*60*60));
let m = Math.floor((diff%(1000*60*60))/(1000*60));

el.innerText = `${d} hari ${h} jam ${m} menit`;
});
}

function updateProgress(){
document.querySelectorAll('.progress-bar').forEach(el=>{
let target = new Date(el.dataset.date).getTime();
let now = new Date().getTime();
let total = 1000*60*60*24*30;
let diff = target - now;

let percent = 100 - (diff / total * 100);

if(percent < 0) percent = 100;
if(percent > 100) percent = 100;

el.style.width = percent + "%";
});
}

setInterval(updateCountdown,1000);
updateCountdown();
updateProgress();
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const filterBulan = document.getElementById("filterBulan");
    const noData = document.getElementById("noData");

    function filterData() {
        const keyword = searchInput.value.toLowerCase().trim();
        const bulan = filterBulan.value;
        let visibleCount = 0;

        document.querySelectorAll(".card").forEach(card => {
            const text = card.innerText.toLowerCase();
            const cardBulan = (card.dataset.bulan || "").padStart(2, "0");

            const cocokSearch = text.includes(keyword);
            const cocokBulan = (bulan === "all" || bulan === cardBulan);

            const tampil = cocokSearch && cocokBulan;
            card.style.display = tampil ? "flex" : "none";

            if (tampil) visibleCount++;
        });

        document.querySelectorAll(".month-title").forEach(title => {
            let show = false;
            let next = title.nextElementSibling;

            while (next && !next.classList.contains("month-title")) {
                if (next.classList.contains("card") && next.style.display !== "none") {
                    show = true;
                    break;
                }
                next = next.nextElementSibling;
            }

            title.style.display = show ? "block" : "none";
        });

        if (noData) {
            noData.style.display = visibleCount === 0 ? "block" : "none";
        }
    }

    searchInput.addEventListener("input", filterData);
    filterBulan.addEventListener("change", filterData);

    filterData();
});
</script>

</body>
</html>