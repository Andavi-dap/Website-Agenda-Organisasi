<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 32px 16px; min-height: 100vh; display: grid; place-items: center; background: #eef5ff; color: #172554; font-family: 'Poppins', sans-serif; }
        main { width: min(100%, 560px); padding: 32px; background: #fff; border-radius: 12px; box-shadow: 0 18px 50px rgba(30, 64, 175, .12); }
        h1 { margin: 0 0 24px; font-size: 24px; }
        label { display: block; margin: 16px 0 6px; font-size: 14px; font-weight: 600; }
        input { width: 100%; min-height: 44px; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font: inherit; }
        input:focus { outline: 2px solid #2563eb; outline-offset: 1px; }
        .error { margin: 4px 0 0; color: #b91c1c; font-size: 13px; }
        .actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 24px; }
        .actions a, .actions button { min-height: 42px; padding: 10px 16px; border: 0; border-radius: 6px; font: inherit; font-weight: 600; text-decoration: none; cursor: pointer; }
        .actions button { background: #1d4ed8; color: #fff; }
        .actions a { background: #e2e8f0; color: #172554; }
    </style>
</head>
<body>
    <main>
        <h1>Edit Kegiatan</h1>
        <form action="{{ route('kegiatan.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input id="nama_kegiatan" name="nama_kegiatan" type="text" value="{{ old('nama_kegiatan', $data->nama_kegiatan) }}" required>
            @error('nama_kegiatan')<p class="error">{{ $message }}</p>@enderror

            <label for="tanggal">Tanggal</label>
            <input id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', date('Y-m-d', strtotime($data->tanggal))) }}" required>
            @error('tanggal')<p class="error">{{ $message }}</p>@enderror

            <label for="waktu">Waktu</label>
            <input id="waktu" name="waktu" type="time" value="{{ old('waktu', substr($data->waktu, 0, 5)) }}" required>
            @error('waktu')<p class="error">{{ $message }}</p>@enderror

            <label for="lokasi">Lokasi</label>
            <input id="lokasi" name="lokasi" type="text" value="{{ old('lokasi', $data->lokasi) }}" required>
                            @error('lokasi')
                <p class="error">{{ $message }}</p>
                @enderror

                <!-- Divisi Penyelenggara -->
                <label for="divisi">Divisi Penyelenggara</label>
                <select name="divisi" required>
                @if($defaultDivisi !== 'Umum (Seluruh Himpunan)')
                    <option value="{{ $defaultDivisi }}" selected>{{ $defaultDivisi }}</option>
                @else
                    @foreach(config('haruna.divisi') as $div)
                        <option value="{{ $div }}" {{ (old('divisi', $data->divisi) == $div) ? 'selected' : '' }}>{{ $div }}</option>
                    @endforeach
                @endif
                </select>
                @error('divisi')
                    <p class="error">{{ $message }}</p>
                @enderror

                <!-- PIC (Penanggung Jawab) -->
                <label for="pic">PIC (Penanggung Jawab)</label>
                <input type="text" name="pic" maxlength="100" placeholder="Opsional" value="{{ old('pic', $data->pic) }}">
                @error('pic')
                    <p class="error">{{ $message }}</p>
                @enderror

            <div class="actions">
                <button type="submit">Simpan Perubahan</button>
                <a href="{{ route('kegiatan.index') }}">Kembali</a>
            </div>
        </form>
    </main>
</body>
</html>
