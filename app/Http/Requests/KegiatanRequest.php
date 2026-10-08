<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['required'],
            'lokasi' => ['required', 'string', 'max:255'],
            'divisi' => ['required', Rule::in(config('haruna.divisi'))],
            'pic' => ['nullable', 'string', 'max:100'],
        ];
    }
}
