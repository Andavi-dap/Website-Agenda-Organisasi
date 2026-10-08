<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Profile</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:
radial-gradient(circle at 20% 20%, rgba(96,165,250,.35), transparent 40%),
linear-gradient(135deg,#e0f2fe,#f8fafc);
padding:20px;
}

.card{
width:100%;
max-width:420px;
background:rgba(255,255,255,.75);
backdrop-filter:blur(20px);
padding:30px;
border-radius:24px;
box-shadow:0 20px 40px rgba(0,0,0,.08);
text-align:center;
}

img{
width:120px;
height:120px;
border-radius:50%;
object-fit:cover;
border:4px solid #60a5fa;
margin-bottom:18px;
}

h2{
font-size:24px;
font-weight:800;
margin-bottom:8px;
background:linear-gradient(135deg,#2563eb,#38bdf8);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

p{
color:#64748b;
font-weight:600;
margin-bottom:25px;
}

.btn{
display:block;
width:100%;
padding:12px;
border:none;
border-radius:14px;
background:linear-gradient(135deg,#3b82f6,#60a5fa);
color:white;
font-weight:700;
text-decoration:none;
margin-top:10px;
transition:.25s;
}

.btn:hover{
transform:translateY(-2px);
box-shadow:0 12px 20px rgba(59,130,246,.22);
}

.btn2{
background:#fff;
color:#2563eb;
border:1px solid #dbeafe;
}
</style>
</head>
@php
$isAdmin = session('user.is_admin') ?? false;
@endphp

<body>

<div class="card">

<img src="{{ asset('foto/'.session('user.foto')) }}">

<h2>{{ session('user.nama') }}</h2>
<p style="margin-bottom: 10px;">{{ session('user.jabatan') }}</p>

<div style="margin-bottom: 25px;">
<div style="font-size:12px; font-weight:600; color:#64748b; margin-bottom:6px;">Peran:</div>
@if($isAdmin)
<span style="background: linear-gradient(135deg,#7c3aed,#6366f1); color:white; font-size:14px; font-weight:700; padding:6px 20px; border-radius:999px; display:inline-block; box-shadow: 0 4px 12px rgba(124,58,237,0.3);">Admin</span>
@else
<span style="background: linear-gradient(135deg,#3b82f6,#60a5fa); color:white; font-size:14px; font-weight:700; padding:6px 20px; border-radius:999px; display:inline-block; box-shadow: 0 4px 12px rgba(59,130,246,0.3);">Anggota</span>
@endif
</div>

<a href="/" class="btn">Kembali Dashboard</a>
<a href="/logout" class="btn btn2">Logout</a>

</div>

</body>
</html>