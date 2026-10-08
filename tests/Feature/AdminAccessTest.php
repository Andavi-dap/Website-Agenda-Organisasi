<?php

namespace Tests\Feature;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_public_pages(): void
    {
        $this->get('/')->assertRedirect('/login');
        $this->get('/kalender')->assertRedirect('/login');
        $this->get('/profile')->assertRedirect('/login');
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_non_admin_is_forbidden_on_admin_and_crud_routes(): void
    {
        $this->withSession([
            'user' => [
                'nama' => 'Anggota',
                'jabatan' => 'Anggota Divisi Sekretaris',
                'foto' => 'default.jpg',
                'is_admin' => false,
            ],
        ]);

        $this->get('/tambah')->assertForbidden();
        $this->get('/admin')->assertForbidden();
        $this->get('/admin/kegiatan')->assertForbidden();
        $this->delete('/delete/1')->assertForbidden();
        $this->delete('/admin/kegiatan/bulk', ['ids' => [1]])->assertForbidden();
    }

    public function test_admin_can_access_admin_pages(): void
    {
        $this->withSession([
            'user' => [
                'nama' => 'Ketua',
                'jabatan' => 'Ketua Himpunan',
                'foto' => 'default.jpg',
                'is_admin' => true,
            ],
        ]);

        $this->get('/admin')->assertOk();
        $this->get('/admin/kegiatan')->assertOk();
    }

    public function test_scope_logic_separates_today_by_time(): void
    {
        $now = Carbon::now();

        Kegiatan::create([
            'nama_kegiatan' => 'Hari Ini Akan Datang',
            'tanggal' => $now->toDateString(),
            'waktu' => $now->copy()->addHours(2)->format('H:i:s'),
            'lokasi' => 'A',
            'divisi' => 'Sekretaris',
            'pic' => 'PIC',
            'status' => 'akan datang',
        ]);

        Kegiatan::create([
            'nama_kegiatan' => 'Hari Ini Selesai',
            'tanggal' => $now->toDateString(),
            'waktu' => $now->copy()->subHours(2)->format('H:i:s'),
            'lokasi' => 'B',
            'divisi' => 'Sekretaris',
            'pic' => 'PIC',
            'status' => 'selesai',
        ]);

        $this->assertCount(1, Kegiatan::akanDatang()->get());
        $this->assertCount(1, Kegiatan::selesai()->get());
    }

    public function test_ajax_admin_filters_and_ordering_work(): void
    {
        $this->withSession([
            'user' => [
                'nama' => 'Ketua',
                'jabatan' => 'Ketua Himpunan',
                'foto' => 'default.jpg',
                'is_admin' => true,
            ],
        ]);

        Kegiatan::create([
            'nama_kegiatan' => 'Zeta Event',
            'tanggal' => Carbon::yesterday()->toDateString(),
            'waktu' => '08:00:00',
            'lokasi' => 'Lokasi A',
            'divisi' => 'Sekretaris',
            'pic' => 'PIC',
            'status' => 'selesai',
        ]);

        Kegiatan::create([
            'nama_kegiatan' => 'TNT Event',
            'tanggal' => Carbon::yesterday()->toDateString(),
            'waktu' => '09:00:00',
            'lokasi' => 'Lokasi B',
            'divisi' => 'Sekretaris',
            'pic' => 'PIC',
            'status' => 'selesai',
        ]);

        Kegiatan::create([
            'nama_kegiatan' => 'Alpha Event',
            'tanggal' => Carbon::tomorrow()->toDateString(),
            'waktu' => '10:00:00',
            'lokasi' => 'Lokasi C',
            'divisi' => 'Bendahara',
            'pic' => 'PIC',
            'status' => 'akan datang',
        ]);

        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->getJson('/admin/kegiatan?draw=1&start=0&length=10&divisi=Sekretaris&status=selesai&q=TNT&order%5B0%5D%5Bcolumn%5D=2&order%5B0%5D%5Bdir%5D=asc');

        $response->assertOk();
        $data = $response->json('data');
        $this->assertCount(1, $data);
        $this->assertSame('TNT Event', $data[0]['nama_kegiatan']);
    }
}
