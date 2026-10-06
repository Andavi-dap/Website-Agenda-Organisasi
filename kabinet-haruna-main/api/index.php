<?php

// 1. Buat folder storage & bootstrap/cache di /tmp
$storagePath = '/tmp/storage';
foreach ([
    '/framework/views',
    '/framework/cache/data',
    '/framework/sessions',
    '/logs',
    '/bootstrap/cache',
] as $dir) {
    if (!is_dir($storagePath . $dir)) {
        mkdir($storagePath . $dir, 0777, true);
    }
}

// 2. Buat file SQLite otomatis di /tmp/database.sqlite jika belum ada
$sqlitePath = '/tmp/database.sqlite';
if (!file_exists($sqlitePath)) {
    touch($sqlitePath);
    try {
        $pdo = new PDO('sqlite:' . $sqlitePath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Buat tabel kegiatans otomatis supaya KegiatanController tidak error
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS kegiatans (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nama_kegiatan VARCHAR(255) NULL,
                judul VARCHAR(255) NULL,
                deskripsi TEXT NULL,
                keterangan TEXT NULL,
                tanggal DATE NULL,
                waktu VARCHAR(100) NULL,
                tempat VARCHAR(255) NULL,
                lokasi VARCHAR(255) NULL,
                divisi VARCHAR(255) NULL,
                status VARCHAR(100) NULL,
                foto VARCHAR(255) NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            );
        ");
    } catch (\Throwable $e) {
        // Lewati jika gagal inisialisasi awal
    }
}

// 3. Bersihkan variabel kosong sisa .env.example
foreach ($_ENV as $k => $v) {
    if ($v === '' || $v === 'null') {
        unset($_ENV[$k], $_SERVER[$k]);
        putenv($k);
    }
}

// 4. Paksa konfigurasi Laravel + arahkan DB_DATABASE ke /tmp/database.sqlite
$forcedEnv = [
    'APP_NAME'               => 'Kabinet Haruna',
    'APP_DEBUG'              => 'true',
    'APP_ENV'                => 'production',
    'APP_KEY'                => 'base64:8T9vK2mP5qR8wY1zB4nV7cX0lJ3hG6fD9sA2eW5uI8o=',
    'APP_MAINTENANCE_DRIVER' => 'file',
    'DB_CONNECTION'          => 'sqlite',
    'DB_DATABASE'            => $sqlitePath,
    'LOG_CHANNEL'            => 'stderr',
    'SESSION_DRIVER'         => 'cookie',
    'CACHE_STORE'            => 'array',
    'CACHE_DRIVER'           => 'array',
    'QUEUE_CONNECTION'       => 'sync',
    'BROADCAST_CONNECTION'   => 'log',
    'FILESYSTEM_DISK'        => 'local',
    'MAIL_MAILER'            => 'log',
    'VIEW_COMPILED_PATH'     => $storagePath . '/framework/views',
    'APP_SERVICES_CACHE'     => $storagePath . '/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE'     => $storagePath . '/bootstrap/cache/packages.php',
    'APP_CONFIG_CACHE'       => $storagePath . '/bootstrap/cache/config.php',
    'APP_ROUTES_CACHE'       => $storagePath . '/bootstrap/cache/routes.php',
    'APP_EVENTS_CACHE'       => $storagePath . '/bootstrap/cache/events.php',
];

foreach ($forcedEnv as $key => $val) {
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
    putenv("$key=$val");
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath($storagePath);

$request = Illuminate\Http\Request::capture();
$app->handleRequest($request);
