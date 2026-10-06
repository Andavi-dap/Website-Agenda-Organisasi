<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TAMBAH KEGIATAN</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

/* BACKGROUND */
html{
    min-height:100%;
    background:
        radial-gradient(circle at 20% 30%, rgba(59,130,246,0.25), transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(37,99,235,0.2), transparent 40%),
        linear-gradient(135deg,#eef5ff,#f8fbff);
}

body{
    min-height:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 20px;
}

/* WRAPPER */
.wrapper{
    display:grid;
    grid-template-columns: 1fr 1.2fr;
    gap:30px;
    width:100%;
    max-width:1050px;
}

/* LEFT PANEL */
.left{
    position:relative;
    background:rgba(255,255,255,0.18);
    backdrop-filter:blur(30px);
    -webkit-backdrop-filter:blur(30px);

    border-radius:28px;
    padding:40px 30px;

    /* GLASS BORDER */
    border:1px solid rgba(255,255,255,0.35);

    /* DEPTH */
    box-shadow:
        0 25px 60px rgba(0,0,0,0.12),
        inset 0 1px 1px rgba(255,255,255,0.6);

    overflow:hidden;
    transition:0.35s ease;
}

/* ✨ SOFT LIGHT (ATAS, TIDAK FULL) */
.left::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:120px; /* penting: biar gak nutup semua */

    border-radius:28px;

    background:linear-gradient(
        120deg,
        rgba(255,255,255,0.7),
        rgba(255,255,255,0.2),
        transparent
    );

    opacity:0.45;
    pointer-events:none;
}

/* 🔵 GLOW HALUS */
.left::after{
    content:'';
    position:absolute;
    inset:0;
    border-radius:28px;

    background:radial-gradient(
        circle at top left,
        rgba(59,130,246,0.25),
        transparent 65%
    );

    opacity:0.35;
    pointer-events:none;
}

/* 🔥 HOVER EFFECT */
.left:hover{
    transform:translateY(-6px) scale(1.01);

    box-shadow:
        0 35px 80px rgba(0,0,0,0.18),
        inset 0 1px 2px rgba(255,255,255,0.7);
}

/* ICON BOX */
.left-icon{
    width:70px;
    height:70px;
    border-radius:20px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:28px;
    color:white;

    background:linear-gradient(135deg,#2563eb,#3b82f6);

    box-shadow:
        0 12px 30px rgba(37,99,235,0.45),
        inset 0 2px 4px rgba(255,255,255,0.3);

    transition:0.3s;

    margin-bottom:18px;
}

/* ICON ANIMATION */
.left:hover .left-icon{
    transform:scale(1.08);
}

/* TEXT */
.left h2{
    font-size:26px;
    font-weight:800;
    color:#1e3a8a;
}

.left p{
    font-size:14px;
    color:#475569;
    margin-bottom:30px;
}

/* FEATURE LIST */
.feature{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:18px;
}

/* ICON FEATURE FIX (BIAR GAK JELEK) */
.feature i{
    width:36px;
    height:36px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:white;

    border-radius:12px;

    font-size:14px;

    box-shadow:0 6px 15px rgba(37,99,235,0.35);
}

/* RIGHT CARD */
.card{
    background:rgba(255,255,255,0.65);
    backdrop-filter:blur(18px);
    border-radius:24px;
    padding:30px;
}

/* HEADER */
.header{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:20px;
}


.header-logo img{
    width: 70px;
    height: 70px;
    object-fit:contain;
}

.title{
    font-size:22px;
    font-weight:800;
    color:#1e3a8a;
}

.subtitle{
    font-size:13px;
    color:#64748b;
}

/* FORM */
.group{margin-bottom:16px;}

label{
    font-size:13px;
    font-weight:600;
    color:#334155;
}

/* WRAPPER */
.input-wrap{
    position:relative;
    transition:all 0.25s ease;
}

/* ICON (FIX BIAR GAK PUDAR) */
.input-wrap i{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);

    color:#2563eb; /* 🔥 warna tegas */
    font-size:16px;

    opacity:1 !important; /* ❗ paksa tidak pudar */

    /* 🔥 bikin lebih tajam & hidup */
    filter:
        drop-shadow(0 2px 6px rgba(37,99,235,0.6))
        brightness(1.1);

    transition:all 0.25s ease;
}

.input-wrap i{
    z-index:5; /* ❗ penting */
}

/* INPUT */
input, select{
    width:100%;
    padding:13px 14px 13px 42px;
    border-radius:16px;

    border:none;
    outline:none; /* ❌ hapus border hitam */

    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(10px);

    font-size:14px;

    box-shadow:
        0 2px 6px rgba(0,0,0,0.05),
        0 0 0 1px rgba(226,232,240,0.8);

    transition:all 0.25s ease;
}

/* HOVER HALUS */
.input-wrap:hover input{
    box-shadow:
        0 6px 18px rgba(0,0,0,0.08),
        0 0 0 1px rgba(226,232,240,1);
}

/* 🔥 FOCUS (POP + GLOW) */
.input-wrap:focus-within{
    transform:translateY(-2px);
}

/* GLOW TANPA BORDER */
.input-wrap:focus-within input,
.input-wrap:focus-within select{
    background:white;

    box-shadow:
        0 10px 30px rgba(59,130,246,0.25),
        0 0 18px rgba(59,130,246,0.35);
}

/* ICON IKUT HIDUP */
.input-wrap:focus-within i{
    transform:translateY(-50%) scale(1.15);
    color:#1d4ed8;
    filter:drop-shadow(0 4px 10px rgba(37,99,235,0.6));
}

/* ✨ ANIMASI POP YANG BENAR */
input:focus{
    animation:inputPop 0.25s ease;
}

@keyframes inputPop{
    0%{ transform:scale(1); }
    50%{ transform:scale(1.02); }
    100%{ transform:scale(1.02); }
}

/* BUTTON */
.btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:14px;
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:white;
    font-weight:700;
    cursor:pointer;
    position:relative;
    overflow:hidden;
    transition:0.25s;
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(37,99,235,0.4);
}

.btn:active{
    transform:scale(0.96);
}

/* SHINE */
.btn::before{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    opacity:0;
}

.btn:hover::before{
    opacity:1;
    animation:shine 1s linear;
}

@keyframes shine{
    from{transform:translateX(-100%)}
    to{transform:translateX(100%)}
}

/* BACK BUTTON */
.btn-back{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    margin-top:12px;
    padding:12px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
    color:#2563eb;
    background:rgba(255,255,255,0.6);
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,0.5);
}

.btn-back:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(37,99,235,0.2);
}

/* RESPONSIVE */
@media(max-width:900px){
    .wrapper{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body>

<div class="wrapper">

<!-- LEFT -->
<div class="left">
    <div class="left-icon">
        <i class="fa-solid fa-clipboard-list"></i>
    </div>

    <h2>TAMBAH KEGIATAN</h2>
    <p>Isi data kegiatan organisasi dengan lengkap untuk mencatat kegiatan baru.</p>

    <div class="feature">
        <i class="fa-solid fa-calendar"></i>
        <div>Catat kegiatan dengan mudah</div>
    </div>

    <div class="feature">
        <i class="fa-solid fa-location-dot"></i>
        <div>Kelola lokasi kegiatan</div>
    </div>

    <div class="feature">
        <i class="fa-solid fa-clock"></i>
        <div>Pantau jadwal kegiatan</div>
    </div>
</div>

<!-- RIGHT -->
<div class="card">

<div class="header">
    <div class="header-logo">
        <img src="{{ asset('logo/logo1.png') }}" alt="Logo">
    </div>
    <div>
        <div class="title">TAMBAH KEGIATAN</div>
        <div class="subtitle">Isi data kegiatan organisasi dengan lengkap</div>
    </div>
</div>

<form action="{{ route('kegiatan.store') }}" method="POST">
    @csrf

<div class="group">
<label>Nama Kegiatan</label>
<div class="input-wrap">
<i class="fa-solid fa-pen"></i>
<input type="text" name="nama_kegiatan" required>
</div>
</div>

<div class="group">
<label>Tanggal</label>
<div class="input-wrap">
<i class="fa-solid fa-calendar"></i>
<input type="date" name="tanggal" required>
</div>
</div>

<div class="group">
<label>Waktu</label>
<div class="input-wrap">
<i class="fa-solid fa-clock"></i>
<input type="time" name="waktu" required>
</div>
</div>

<div class="group">
<label>Lokasi</label>
<div class="input-wrap">
<i class="fa-solid fa-location-dot"></i>
<input type="text" name="lokasi" required>
</div>
</div>

<div class="group">
<label>Status</label>
<div class="input-wrap">
<i class="fa-solid fa-flag"></i>
<select>
<option>Akan Datang</option>
<option>Selesai</option>
</select>
</div>
</div>

<button type="submit" class="btn">
<i class="fa-solid fa-floppy-disk"></i>
Simpan Kegiatan
</button>

<a href="/" class="btn-back">
<i class="fa-solid fa-arrow-left"></i>
Kembali ke Dashboard
</a>

</form>

</div>

</div>

</body>
</html>