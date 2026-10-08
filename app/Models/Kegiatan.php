<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    public function scopeAkanDatang($q)
    {
        $today = now()->toDateString();
        $jam = now()->format('H:i:s');

        return $q->where(function ($w) use ($today, $jam) {
            $w->where('tanggal', '>', $today)
                ->orWhere(function ($x) use ($today, $jam) {
                    $x->where('tanggal', $today)
                        ->where('waktu', '>=', $jam);
                });
        });
    }

    public function scopeSelesai($q)
    {
        $today = now()->toDateString();
        $jam = now()->format('H:i:s');

        return $q->where(function ($w) use ($today, $jam) {
            $w->where('tanggal', '<', $today)
                ->orWhere(function ($x) use ($today, $jam) {
                    $x->where('tanggal', $today)
                        ->where('waktu', '<', $jam);
                });
        });
    }

    public static function hitungStatus($tanggal, $waktu): string
    {
        if (empty($tanggal) || empty($waktu)) {
            return 'akan datang';
        }

        return Carbon::parse("{$tanggal} {$waktu}")->isPast() ? 'selesai' : 'akan datang';
    }

    public function getStatusAttribute($value)
    {
        if (empty($this->tanggal) || empty($this->waktu)) {
            return $value;
        }

        return self::hitungStatus($this->tanggal, $this->waktu);
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