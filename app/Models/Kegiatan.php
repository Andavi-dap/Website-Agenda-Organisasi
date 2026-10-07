<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans'; // opsional (kalau nama tabel beda)

    public function getStatusAttribute($value)
    {
        if (!$this->tanggal) {
            return $value;
        }

        return $this->tanggal <= now()->toDateString()
            ? 'selesai'
            : 'akan datang';
    }

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu',
        'lokasi',
        'status',
        'divisi',
        'pic'
    ];
}