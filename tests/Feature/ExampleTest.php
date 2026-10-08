<?php

namespace Tests\Feature;

use App\Models\Kegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function test_admin_can_open_the_edit_form_for_an_event(): void
    {
        $kegiatan = Kegiatan::create([
            'nama_kegiatan' => 'Rapat Kabinet',
            'tanggal' => '2026-10-10',
            'waktu' => '09:00:00',
            'lokasi' => 'Ruang Rapat',
            'status' => 'akan datang',
        ]);

        $this->withSession([
            'user' => ['jabatan' => 'Ketua Himpunan'],
        ])->get(route('kegiatan.edit', $kegiatan))
            ->assertOk()
            ->assertSee('Rapat Kabinet');
    }
}
