<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Mengembalikan 50 data kegiatan awal HARUNA (diambil dari db_organisasi.sql).
 * Aman dijalankan berulang: baris dengan id yang sama diperbarui, bukan digandakan.
 * Jalan di SQLite maupun MySQL.
 *
 * Jalankan: php artisan db:seed --class=KegiatanSeeder
 */
class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id' => 1, 'nama_kegiatan' => 'TUMISS', 'deskripsi' => null, 'tanggal' => '2026-04-15', 'waktu' => '15:00:00', 'lokasi' => 'Polimedia Gedung E, Lt 2.9 & 2.10', 'status' => 'selesai', 'created_at' => '2026-04-19 00:33:02', 'updated_at' => '2026-04-19 00:33:02'],
            ['id' => 3, 'nama_kegiatan' => 'BANK ASPIRASI 1', 'deskripsi' => null, 'tanggal' => '2026-02-10', 'waktu' => '15:00:00', 'lokasi' => 'Whats App', 'status' => 'selesai', 'created_at' => '2026-04-19 01:29:09', 'updated_at' => '2026-04-19 01:29:09'],
            ['id' => 4, 'nama_kegiatan' => 'FOTO KABINET', 'deskripsi' => null, 'tanggal' => '2026-02-21', 'waktu' => '10:00:00', 'lokasi' => 'Polimedia Pusgiwa Lt.2', 'status' => 'selesai', 'created_at' => '2026-04-19 01:29:41', 'updated_at' => '2026-04-19 01:29:41'],
            ['id' => 5, 'nama_kegiatan' => 'STUDI BANDING', 'deskripsi' => null, 'tanggal' => '2026-02-25', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Hall Gedung E', 'status' => 'selesai', 'created_at' => '2026-04-19 01:30:45', 'updated_at' => '2026-04-19 01:30:45'],
            ['id' => 7, 'nama_kegiatan' => 'TNT 3', 'deskripsi' => null, 'tanggal' => '2026-04-19', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-19 01:33:29', 'updated_at' => '2026-04-19 01:33:29'],
            ['id' => 8, 'nama_kegiatan' => 'TRIVIA 2', 'deskripsi' => null, 'tanggal' => '2026-04-20', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-19 01:34:12', 'updated_at' => '2026-04-19 01:34:12'],
            ['id' => 9, 'nama_kegiatan' => 'KOMIK 1', 'deskripsi' => null, 'tanggal' => '2026-03-02', 'waktu' => '10:00:00', 'lokasi' => 'Polimedia Gedung E, Kelas', 'status' => 'selesai', 'created_at' => '2026-04-19 02:13:00', 'updated_at' => '2026-04-19 02:13:00'],
            ['id' => 10, 'nama_kegiatan' => 'AMUBA 13', 'deskripsi' => null, 'tanggal' => '2026-05-09', 'waktu' => '08:00:00', 'lokasi' => 'Panti Asuhan', 'status' => 'akan datang', 'created_at' => '2026-04-19 03:40:04', 'updated_at' => '2026-05-02 03:55:15'],
            ['id' => 11, 'nama_kegiatan' => 'RGB', 'deskripsi' => null, 'tanggal' => '2026-02-26', 'waktu' => '15:00:00', 'lokasi' => 'Polimedia Kantin Baru', 'status' => 'selesai', 'created_at' => '2026-04-20 20:44:57', 'updated_at' => '2026-04-20 20:44:57'],
            ['id' => 12, 'nama_kegiatan' => 'MUJAJIL', 'deskripsi' => null, 'tanggal' => '2026-03-03', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'selesai', 'created_at' => '2026-04-30 20:42:44', 'updated_at' => '2026-04-30 20:42:44'],
            ['id' => 13, 'nama_kegiatan' => 'MUJAJIL', 'deskripsi' => null, 'tanggal' => '2026-03-04', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'selesai', 'created_at' => '2026-04-30 20:43:26', 'updated_at' => '2026-04-30 20:43:26'],
            ['id' => 14, 'nama_kegiatan' => 'MUGJIL', 'deskripsi' => null, 'tanggal' => '2026-03-05', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'selesai', 'created_at' => '2026-04-30 20:43:51', 'updated_at' => '2026-04-30 20:43:51'],
            ['id' => 15, 'nama_kegiatan' => 'IMAJI', 'deskripsi' => null, 'tanggal' => '2026-03-07', 'waktu' => '16:00:00', 'lokasi' => 'Teras Atas Depok', 'status' => 'selesai', 'created_at' => '2026-04-30 20:44:51', 'updated_at' => '2026-04-30 20:44:51'],
            ['id' => 16, 'nama_kegiatan' => 'BANK ASPIRASI 2', 'deskripsi' => null, 'tanggal' => '2026-03-10', 'waktu' => '12:00:00', 'lokasi' => 'Whats App', 'status' => 'selesai', 'created_at' => '2026-04-30 20:45:38', 'updated_at' => '2026-04-30 20:45:38'],
            ['id' => 17, 'nama_kegiatan' => 'STUBAN (Teknik)', 'deskripsi' => null, 'tanggal' => '2026-03-12', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Pusgiwa Lt.2', 'status' => 'selesai', 'created_at' => '2026-04-30 20:46:10', 'updated_at' => '2026-04-30 20:46:10'],
            ['id' => 18, 'nama_kegiatan' => 'UPGRADING 1', 'deskripsi' => null, 'tanggal' => '2026-03-13', 'waktu' => '13:00:00', 'lokasi' => 'Polimedia Gedung E, Lt 2.9 & 2.10', 'status' => 'selesai', 'created_at' => '2026-04-30 20:46:52', 'updated_at' => '2026-04-30 20:46:52'],
            ['id' => 19, 'nama_kegiatan' => 'FRAME 1', 'deskripsi' => null, 'tanggal' => '2026-03-14', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:47:18', 'updated_at' => '2026-04-30 20:47:18'],
            ['id' => 20, 'nama_kegiatan' => 'KEMASAN 1', 'deskripsi' => null, 'tanggal' => '2026-03-15', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:47:48', 'updated_at' => '2026-04-30 20:47:48'],
            ['id' => 21, 'nama_kegiatan' => 'TNT 1', 'deskripsi' => null, 'tanggal' => '2026-03-19', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:48:12', 'updated_at' => '2026-04-30 20:48:12'],
            ['id' => 22, 'nama_kegiatan' => 'TRIVIA 1', 'deskripsi' => null, 'tanggal' => '2026-03-20', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:48:34', 'updated_at' => '2026-04-30 20:48:34'],
            ['id' => 23, 'nama_kegiatan' => 'AOTM 1', 'deskripsi' => null, 'tanggal' => '2026-03-23', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:48:59', 'updated_at' => '2026-04-30 20:48:59'],
            ['id' => 24, 'nama_kegiatan' => 'TNT 2', 'deskripsi' => null, 'tanggal' => '2026-03-25', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:49:22', 'updated_at' => '2026-04-30 20:49:22'],
            ['id' => 25, 'nama_kegiatan' => 'OBAMA 1', 'deskripsi' => null, 'tanggal' => '2026-03-31', 'waktu' => '16:00:00', 'lokasi' => 'Kolam Renang Batoe 54', 'status' => 'selesai', 'created_at' => '2026-04-30 20:49:50', 'updated_at' => '2026-04-30 20:49:50'],
            ['id' => 26, 'nama_kegiatan' => 'ALAM 1', 'deskripsi' => null, 'tanggal' => '2026-03-31', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:50:10', 'updated_at' => '2026-04-30 20:50:10'],
            ['id' => 27, 'nama_kegiatan' => 'KOMIK 2', 'deskripsi' => null, 'tanggal' => '2026-04-01', 'waktu' => '12:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'selesai', 'created_at' => '2026-04-30 20:54:05', 'updated_at' => '2026-04-30 20:54:05'],
            ['id' => 28, 'nama_kegiatan' => 'MUTER 1', 'deskripsi' => null, 'tanggal' => '2026-04-09', 'waktu' => '12:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'selesai', 'created_at' => '2026-04-30 20:54:33', 'updated_at' => '2026-04-30 20:54:33'],
            ['id' => 29, 'nama_kegiatan' => 'BANK ASPIRASI 3', 'deskripsi' => null, 'tanggal' => '2026-04-10', 'waktu' => '12:00:00', 'lokasi' => 'Whats App', 'status' => 'selesai', 'created_at' => '2026-04-30 20:58:16', 'updated_at' => '2026-04-30 20:58:16'],
            ['id' => 30, 'nama_kegiatan' => 'BESAN 1', 'deskripsi' => null, 'tanggal' => '2026-04-12', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:58:43', 'updated_at' => '2026-04-30 20:58:43'],
            ['id' => 31, 'nama_kegiatan' => 'FRAME 2', 'deskripsi' => null, 'tanggal' => '2026-04-14', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:59:12', 'updated_at' => '2026-04-30 20:59:12'],
            ['id' => 32, 'nama_kegiatan' => 'KEMASAN 2', 'deskripsi' => null, 'tanggal' => '2026-04-15', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 20:59:40', 'updated_at' => '2026-04-30 20:59:40'],
            ['id' => 33, 'nama_kegiatan' => 'KOMED', 'deskripsi' => null, 'tanggal' => '2026-04-23', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'selesai', 'created_at' => '2026-04-30 21:00:34', 'updated_at' => '2026-04-30 21:00:34'],
            ['id' => 34, 'nama_kegiatan' => 'AOTM 2', 'deskripsi' => null, 'tanggal' => '2026-04-23', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 21:01:08', 'updated_at' => '2026-04-30 21:01:08'],
            ['id' => 35, 'nama_kegiatan' => 'TNT 4', 'deskripsi' => null, 'tanggal' => '2026-04-25', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'selesai', 'created_at' => '2026-04-30 21:01:39', 'updated_at' => '2026-04-30 21:01:39'],
            ['id' => 36, 'nama_kegiatan' => 'MARJAN 1', 'deskripsi' => null, 'tanggal' => '2026-05-04', 'waktu' => '16:00:00', 'lokasi' => 'YouTube @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:02:21', 'updated_at' => '2026-04-30 21:02:21'],
            ['id' => 37, 'nama_kegiatan' => 'MUTER 2', 'deskripsi' => null, 'tanggal' => '2026-05-09', 'waktu' => '12:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:02:51', 'updated_at' => '2026-04-30 21:02:51'],
            ['id' => 38, 'nama_kegiatan' => 'BANK ASPIRASI 4', 'deskripsi' => null, 'tanggal' => '2026-05-10', 'waktu' => '16:00:00', 'lokasi' => 'Whats App', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:08:00', 'updated_at' => '2026-04-30 21:08:00'],
            ['id' => 39, 'nama_kegiatan' => 'KOMIK 3', 'deskripsi' => null, 'tanggal' => '2026-05-12', 'waktu' => '12:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:08:34', 'updated_at' => '2026-04-30 21:08:34'],
            ['id' => 40, 'nama_kegiatan' => 'HIMEDIA PLAYBOOK', 'deskripsi' => null, 'tanggal' => '2026-05-14', 'waktu' => '16:00:00', 'lokasi' => 'Website @himediajkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:09:21', 'updated_at' => '2026-04-30 21:09:21'],
            ['id' => 41, 'nama_kegiatan' => 'FRAME 3', 'deskripsi' => null, 'tanggal' => '2026-05-14', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:09:50', 'updated_at' => '2026-04-30 21:09:50'],
            ['id' => 42, 'nama_kegiatan' => 'KEMASAN 3', 'deskripsi' => null, 'tanggal' => '2026-05-15', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:10:17', 'updated_at' => '2026-04-30 21:10:17'],
            ['id' => 43, 'nama_kegiatan' => 'MENTION 1', 'deskripsi' => null, 'tanggal' => '2026-05-16', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Pusgiwa Lt.2', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:10:37', 'updated_at' => '2026-04-30 21:10:37'],
            ['id' => 44, 'nama_kegiatan' => 'TNT 5', 'deskripsi' => null, 'tanggal' => '2026-05-19', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:11:03', 'updated_at' => '2026-04-30 21:11:03'],
            ['id' => 45, 'nama_kegiatan' => 'UPGRADING 2', 'deskripsi' => null, 'tanggal' => '2026-05-21', 'waktu' => '16:00:00', 'lokasi' => 'Polimedia Gedung E, Lt 2.9 & 2.10', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:11:27', 'updated_at' => '2026-04-30 21:11:27'],
            ['id' => 46, 'nama_kegiatan' => 'AOTM 3', 'deskripsi' => null, 'tanggal' => '2026-05-23', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:11:48', 'updated_at' => '2026-04-30 21:11:48'],
            ['id' => 47, 'nama_kegiatan' => 'TNT 6', 'deskripsi' => null, 'tanggal' => '2026-05-25', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:12:22', 'updated_at' => '2026-04-30 21:12:22'],
            ['id' => 48, 'nama_kegiatan' => 'OBAMA 2', 'deskripsi' => null, 'tanggal' => '2026-05-29', 'waktu' => '16:00:00', 'lokasi' => 'TBA', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:13:03', 'updated_at' => '2026-04-30 21:13:03'],
            ['id' => 49, 'nama_kegiatan' => 'KEMUL 1', 'deskripsi' => null, 'tanggal' => '2026-05-30', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:13:30', 'updated_at' => '2026-04-30 21:13:30'],
            ['id' => 50, 'nama_kegiatan' => 'ALAM 2', 'deskripsi' => null, 'tanggal' => '2026-05-31', 'waktu' => '16:00:00', 'lokasi' => 'Instagram @himedia.jkt', 'status' => 'akan datang', 'created_at' => '2026-04-30 21:14:02', 'updated_at' => '2026-04-30 21:14:02'],
            ['id' => 51, 'nama_kegiatan' => 'KOMIK 4', 'deskripsi' => null, 'tanggal' => '2026-06-02', 'waktu' => '12:00:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'akan datang', 'created_at' => '2026-05-11 17:44:59', 'updated_at' => '2026-05-11 17:44:59'],
            ['id' => 52, 'nama_kegiatan' => 'TUMISS', 'deskripsi' => null, 'tanggal' => '2026-05-14', 'waktu' => '08:44:00', 'lokasi' => 'Polimedia Jakarta, Srengseng Sawah', 'status' => 'akan datang', 'created_at' => '2026-05-11 18:45:18', 'updated_at' => '2026-05-11 18:45:18'],
        ];

        foreach (array_chunk($rows, 25) as $chunk) {
            DB::table('kegiatans')->upsert(
                $chunk,
                ['id'],
                ['nama_kegiatan', 'deskripsi', 'tanggal', 'waktu', 'lokasi', 'status', 'created_at', 'updated_at']
            );
        }
    }
}