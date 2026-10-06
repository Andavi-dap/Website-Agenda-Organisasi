<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AGENDA SELESAI</title>

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
padding:35px;
color:#1e293b;
}

.container{
max-width:980px;
margin:auto;
}

/* HEADER */
.header{
display:flex;
align-items:center;
gap:15px;
margin-bottom:20px;
}

.header img{
width:80px;
height:80px;
}

.title{
font-size:34px;
font-weight:800;
background:linear-gradient(135deg,#2563eb,#38bdf8);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
text-shadow:0 6px 18px rgba(37,99,235,0.35);
}

.subtitle{
color:#64748b;
font-size:14px;
margin-top:5px;
}

/* FILTER BAR */
.filter-bar{
display:flex;
gap:15px;
margin:20px 0;
}

/* SEARCH */
.search{
flex:1;
padding:14px 16px;
border-radius:16px;
border:none;
outline:none;

background:rgba(255,255,255,0.7);
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

.search:hover{
transform:translateY(-2px);
box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.search:focus{
transform:scale(1.02);
box-shadow:
0 0 0 2px rgba(59,130,246,0.5),
0 0 20px rgba(59,130,246,0.35),
0 10px 25px rgba(59,130,246,0.2);
background:white;
}

/* DROPDOWN */
select{
padding:12px 16px;
border-radius:14px;
border:none;
outline:none;

background:rgba(255,255,255,0.75);
backdrop-filter:blur(10px);

box-shadow:0 0 0 1px rgba(255,255,255,0.6);

cursor:pointer;
font-weight:600;
transition:all 0.25s ease;
}

select:hover{
transform:translateY(-2px);
box-shadow:
0 10px 25px rgba(37,99,235,0.25);
}

select:focus{
transform:scale(1.05);
box-shadow:
0 0 0 2px rgba(59,130,246,0.5),
0 0 18px rgba(59,130,246,0.35),
0 10px 25px rgba(59,130,246,0.2);
background:white;
}

/* MONTH */
.month{
margin-bottom:25px;
transition:all 0.35s ease;
}

.month-title{
font-size:22px;
font-weight:800;
color:#2563eb;
margin-bottom:10px;
}

/* CARD */
.card{
background:rgba(255,255,255,0.7);
backdrop-filter:blur(14px);
padding:18px;
border-radius:18px;
margin-bottom:12px;
display:flex;
justify-content:space-between;
align-items:center;
transition:0.25s;
}

.card:hover{
transform:translateY(-4px);
box-shadow:0 15px 25px rgba(0,0,0,0.08);
}

.card-title{
font-weight:800;
font-size:16px;
letter-spacing:0.3px;
color:#0f172a;
}

.card-info{
font-size:13px;
color:#64748b;
margin-top:4px;
font-weight:500;
}

.card small{
color:#64748b;
}

/* STATUS BADGE */
.status{
position:relative;   /* WAJIB */
overflow:hidden;     /* WAJIB */

padding:8px 16px;
border-radius:999px;

font-size:12px;
font-weight:700;
color:white;

background:linear-gradient(135deg,#22c55e,#4ade80);

box-shadow:0 8px 18px rgba(34,197,94,0.35);
transition:0.25s;
}

.status:hover{
transform:translateY(-2px) scale(1.05);
}

.status::before{
content:'';
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;
background:linear-gradient(120deg,transparent,rgba(255,255,255,0.6),transparent);
transition:0.6s;
}

.status:hover::before{
left:100%;
}

/* BACK BUTTON */
.back{
display:inline-block;
margin-top:30px;
padding:14px 22px;
border-radius:16px;
font-weight:700;
background:linear-gradient(135deg,#3b82f6,#60a5fa);
color:white;
text-decoration:none;
transition:0.25s;
}

.back:hover{
transform:translateY(-3px);
box-shadow:0 12px 25px rgba(59,130,246,0.4);
}

/* EMPTY */
.empty{
background:rgba(255,255,255,0.7);
padding:18px;
border-radius:18px;
color:#64748b;
}

/* ANIMATION */
.fade{
animation:fade .35s ease;
}

@keyframes fade{
from{opacity:0;transform:translateY(10px);}
to{opacity:1;transform:translateY(0);}
}

.no-data-box{
display:none;
text-align:center;
border:1px solid rgba(255,255,255,0.4);

padding:35px 20px;
margin:30px 0;

border-radius:22px;

background:rgba(255,255,255,0.65);
backdrop-filter:blur(14px);

box-shadow:
0 15px 35px rgba(0,0,0,0.06),
inset 0 1px 0 rgba(255,255,255,0.6);

animation:fadeUp 0.4s ease;
}

/* ICON */
.no-data-icon{
font-size:38px;
margin-bottom:10px;

animation:float 2.5s ease-in-out infinite;
}

/* TITLE */
.no-data-title{
font-size:16px;
font-weight:700;
color:#1e293b;
margin-bottom:6px;
}

/* DESC */
.no-data-desc{
font-size:13px;
color:#64748b;
}

.no-data-box::after{
content:'';
position:absolute;
inset:0;
border-radius:22px;

background:radial-gradient(circle at top, rgba(59,130,246,0.15), transparent 70%);
pointer-events:none;
}

/* ANIMASI */
@keyframes fadeUp{
from{
opacity:0;
transform:translateY(15px);
}
to{
opacity:1;
transform:translateY(0);
}
}

@keyframes float{
0%,100%{transform:translateY(0);}
50%{transform:translateY(-6px);}
}

</style>
</head>

<body>

<div class="container">

<!-- HEADER -->
<div class="header">
<img src="{{ asset('logo/logo1.png') }}">
<div>
<div class="title">AGENDA SELESAI</div>
<div class="subtitle">Kegiatan yang telah dilaksanakan</div>
</div>
</div>

<!-- FILTER -->
<div class="filter-bar">
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

<!-- LIST -->
<div id="listContainer">

@forelse($data as $bulan => $items)

<div class="month">
    
    <!-- Judul Bulan -->
    <div class="month-title">{{ $bulan }}</div>

    @foreach($items as $item)

    <div class="card" data-bulan="{{ \Carbon\Carbon::parse($item->tanggal)->format('m') }}">
        
        <div class="card-left">
            <div>
                <div class="card-title">{{ $item->nama_kegiatan }}</div>
                <div class="card-info">
                    {{ $item->tanggal }} • {{ $item->waktu }} • {{ $item->lokasi }}
                </div>
            </div>
        </div>

        <!-- STATUS HARUS DI DALAM CARD -->
        <div class="status">Selesai</div>

    </div>

    @endforeach

</div>

@empty
<p>Tidak ada data</p>
@endforelse

<div id="noData" class="no-data-box">

    <div class="no-data-title">
        Tidak ada agenda di bulan ini
    </div>

    <div class="no-data-desc">
        Coba pilih bulan lain atau tambahkan kegiatan baru
    </div>

</div>
<a href="/" class="back">← Kembali ke Dashboard</a>

</div>

<script>

</script>
<script>
let searchInput = document.getElementById("searchInput");
let filterBulan = document.getElementById("filterBulan");

function filterData(){
    let keyword = searchInput.value.toLowerCase();
    let bulan = filterBulan.value;

    let visibleCount = 0;

    document.querySelectorAll(".month").forEach(month=>{
        let cards = month.querySelectorAll(".card");
        let monthVisible = 0;

        cards.forEach(card=>{
            let text = card.innerText.toLowerCase();
            let cardBulan = card.dataset.bulan;

            let cocokSearch = text.includes(keyword);
            let cocokBulan = (bulan === "all" || bulan === cardBulan);

            if(cocokSearch && cocokBulan){
                card.style.display = "flex";
                monthVisible++;
                visibleCount++;
            }else{
                card.style.display = "none";
            }
        });

        month.style.display = monthVisible > 0 ? "block" : "none";
    });

    let noData = document.getElementById("noData");
    if(noData){
        noData.style.display = visibleCount === 0 ? "block" : "none";
    }
}

searchInput.addEventListener("keyup", filterData);
filterBulan.addEventListener("change", filterData);

filterData();
</script>

<script>
let searchInput = document.getElementById("searchInput");
let filterBulan = document.getElementById("filterBulan");

function filterData(){
    let keyword = searchInput.value.toLowerCase();
    let bulan = filterBulan.value;

    let visibleCount = 0;

    document.querySelectorAll(".month").forEach(month=>{
        let cards = month.querySelectorAll(".card");
        let monthVisible = 0;

        cards.forEach(card=>{
            let text = card.innerText.toLowerCase();
            let cardBulan = card.dataset.bulan;

            let cocokSearch = text.includes(keyword);
            let cocokBulan = (bulan === "all" || Number(bulan) === Number(cardBulan));

            if(cocokSearch && cocokBulan){
                card.style.display = "flex";
                monthVisible++;
                visibleCount++;
            }else{
                card.style.display = "none";
            }
        });

        month.style.display = monthVisible > 0 ? "block" : "none";
    });

    let noData = document.getElementById("noData");
    if(noData){
        noData.style.display = visibleCount === 0 ? "block" : "none";
    }
}

searchInput.addEventListener("keyup", filterData);
filterBulan.addEventListener("change", filterData);

filterData();
</script>

</body>
</html>