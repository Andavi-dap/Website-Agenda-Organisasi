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

    public function test_admin_can_bulk_delete_selected_activities(): void
    {
        $this->asAdmin();

        $first = $this->createActivity(['nama_kegiatan' => 'Bulk One']);
        $second = $this->createActivity(['nama_kegiatan' => 'Bulk Two']);
        $third = $this->createActivity(['nama_kegiatan' => 'Bulk Three']);

        $this->deleteJson('/admin/kegiatan/bulk', ['ids' => [$first->id, $second->id]])
            ->assertOk()
            ->assertJsonPath('deleted', 2);

        $this->assertDatabaseMissing('kegiatans', ['id' => $first->id]);
        $this->assertDatabaseMissing('kegiatans', ['id' => $second->id]);
        $this->assertDatabaseHas('kegiatans', ['id' => $third->id]);
    }

    public function test_bulk_delete_rejects_empty_and_non_numeric_ids(): void
    {
        $this->asAdmin();

        $this->deleteJson('/admin/kegiatan/bulk', ['ids' => []])->assertUnprocessable();
        $this->deleteJson('/admin/kegiatan/bulk', ['ids' => [1, 'invalid']])->assertUnprocessable();
    }

    public function test_guest_is_redirected_from_bulk_delete_route(): void
    {
        $this->delete('/admin/kegiatan/bulk', ['ids' => [1]])->assertRedirect('/login');
    }

    public function test_regular_update_validates_division_and_saves_valid_data(): void
    {
        $this->asAdmin();
        $activity = $this->createActivity();

        $this->put("/update/{$activity->id}", $this->validUpdateData(['divisi' => 'Divisi Tidak Ada']))
            ->assertSessionHasErrors('divisi');

        $this->put("/update/{$activity->id}", $this->validUpdateData([
            'nama_kegiatan' => 'Kegiatan Diperbarui',
            'divisi' => 'Bendahara',
            'pic' => 'PIC Baru',
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('kegiatans', [
            'id' => $activity->id,
            'nama_kegiatan' => 'Kegiatan Diperbarui',
            'divisi' => 'Bendahara',
            'pic' => 'PIC Baru',
        ]);
    }

    public function test_admin_update_validates_division_and_saves_valid_data(): void
    {
        $this->asAdmin();
        $activity = $this->createActivity();

        $this->put("/admin/kegiatan/{$activity->id}", $this->validUpdateData(['divisi' => 'Divisi Tidak Ada']))
            ->assertSessionHasErrors('divisi');

        $this->put("/admin/kegiatan/{$activity->id}", $this->validUpdateData([
            'nama_kegiatan' => 'Diperbarui dari Admin',
            'divisi' => 'Bendahara',
            'pic' => 'PIC Admin',
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('kegiatans', [
            'id' => $activity->id,
            'nama_kegiatan' => 'Diperbarui dari Admin',
            'divisi' => 'Bendahara',
            'pic' => 'PIC Admin',
        ]);
    }

    public function test_invalid_time_is_rejected_by_kegiatan_request(): void
    {
        $this->asAdmin();
        $activity = $this->createActivity();

        $this->put("/update/{$activity->id}", $this->validUpdateData(['waktu' => 'not-a-time']))
            ->assertSessionHasErrors('waktu');
    }

    public function test_only_admin_sees_edit_link_on_all_activities_page(): void
    {
        $activity = $this->createActivity();
        $editUrl = route('kegiatan.edit', $activity->id);

        $this->asAdmin();
        $this->get('/semua-kegiatan')->assertOk()->assertSee($editUrl, false);

        $this->withSession([
            'user' => [
                'nama' => 'Anggota',
                'jabatan' => 'Anggota Divisi Sekretaris',
                'foto' => 'default.jpg',
                'is_admin' => false,
            ],
        ]);
        $this->get('/semua-kegiatan')->assertOk()->assertDontSee($editUrl, false);
    }

    public function test_admin_navigation_is_visible_only_to_admin_on_activity_pages(): void
    {
        $future = $this->createActivity([
            'nama_kegiatan' => 'Chip Akan Datang',
            'tanggal' => Carbon::tomorrow()->toDateString(),
            'waktu' => '10:00:00',
            'divisi' => null,
        ]);
        $past = $this->createActivity([
            'nama_kegiatan' => 'Chip Selesai',
            'tanggal' => Carbon::yesterday()->toDateString(),
            'waktu' => '10:00:00',
            'divisi' => null,
            'status' => 'selesai',
        ]);
        $adminLinks = [route('admin.dashboard'), route('admin.kegiatan.index')];
        $adminPages = ['/semua-kegiatan', '/akan-datang', '/selesai', '/kalender'];

        $this->asAdmin();
        foreach ($adminPages as $page) {
            $response = $this->get($page)->assertOk();
            foreach ($adminLinks as $link) {
                $response->assertSee($link, false);
            }
        }
        $this->get('/akan-datang')->assertSee('Belum ditentukan');
        $this->get('/selesai')->assertSee('Belum ditentukan');
        $this->get('/kalender')->assertSee('Belum ditentukan');

        $this->withSession([
            'user' => [
                'nama' => 'Anggota',
                'jabatan' => 'Anggota Divisi Sekretaris',
                'foto' => 'default.jpg',
                'is_admin' => false,
            ],
        ]);
        foreach ($adminPages as $page) {
            $response = $this->get($page)->assertOk();
            foreach ($adminLinks as $link) {
                $response->assertDontSee($link, false);
            }
        }

        $this->assertNotNull($future);
        $this->assertNotNull($past);
    }

    public function test_seven_day_dashboard_count_excludes_earlier_today_events(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-10-08 13:00:00'));

        try {
            $this->asAdmin();
            $this->createActivity([
                'nama_kegiatan' => 'Sudah Lewat Hari Ini',
                'tanggal' => '2026-10-08',
                'waktu' => '12:00:00',
                'status' => 'selesai',
            ]);
            $this->createActivity([
                'nama_kegiatan' => 'Masih Akan Hari Ini',
                'tanggal' => '2026-10-08',
                'waktu' => '14:00:00',
            ]);

            $this->get('/admin')->assertOk()->assertViewHas('sevenDaysAhead', 1);
        } finally {
            Carbon::setTestNow();
        }
    }

    private function asAdmin(): void
    {
        $this->withSession([
            'user' => [
                'nama' => 'Ketua',
                'jabatan' => 'Ketua Himpunan',
                'foto' => 'default.jpg',
                'is_admin' => true,
            ],
        ]);
    }

    private function createActivity(array $overrides = []): Kegiatan
    {
        return Kegiatan::create(array_merge([
            'nama_kegiatan' => 'Kegiatan Tes',
            'tanggal' => Carbon::tomorrow()->toDateString(),
            'waktu' => '10:00:00',
            'lokasi' => 'Lokasi Tes',
            'divisi' => 'Sekretaris',
            'pic' => 'PIC Tes',
            'status' => 'akan datang',
        ], $overrides));
    }

    private function validUpdateData(array $overrides = []): array
    {
        return array_merge([
            'nama_kegiatan' => 'Kegiatan Diubah',
            'tanggal' => Carbon::tomorrow()->toDateString(),
            'waktu' => '10:00',
            'lokasi' => 'Lokasi Baru',
            'divisi' => 'Sekretaris',
            'pic' => 'PIC Baru',
        ], $overrides);
    }
}
