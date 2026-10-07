<div style="display:flex;gap:6px;">
    <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}"
       class="btn-edit">
       ✏️ Edit
    </a>
    <button class="btn-del btn-del-single"
            data-id="{{ $kegiatan->id }}"
            data-url="{{ route('admin.kegiatan.destroy', $kegiatan) }}">
        🗑️ Hapus
    </button>
</div>
