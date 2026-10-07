@php
    $s = strtolower($status ?? '');
    $isAkan = in_array($s, ['akan-datang', 'future', 'upcoming']);
    $label  = $isAkan ? 'Akan Datang' : 'Selesai';
    $style  = $isAkan
        ? 'background:linear-gradient(135deg,#f59e0b,#fbbf24);'
        : 'background:linear-gradient(135deg,#22c55e,#4ade80);';
@endphp
<span style="{{ $style }} color:#fff; padding:4px 10px; border-radius:999px; font-size:11px; font-weight:700; display:inline-block; white-space:nowrap;">
    {{ $label }}
</span>
