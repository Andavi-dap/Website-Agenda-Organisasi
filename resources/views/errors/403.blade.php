<?php
/**
 * 403 Forbidden error page – HARUNA style
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            background: rgba(255,255,255,0.1);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            backdrop-filter: blur(8px);
        }
        h1 {
            font-size: 4rem;
            margin: 0 0 10px;
        }
        p {
            font-size: 1.2rem;
            margin: 0 0 20px;
        }
        a.button {
            display: inline-block;
            padding: 12px 24px;
            background: #60a5fa;
            color: #1e3a8a;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
        }
        a.button:hover {
            background: #3b82f6;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <p>Anda tidak memiliki hak akses.</p>
        <a href="/" class="button">Kembali ke Dashboard</a>
    </div>
</body>
</html>
