<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $users = [
        [
        'nama' => 'Ramadan Haidar Esa',
        'password' => 'ketua',
        'jabatan' => 'Ketua Himpunan',
        'foto' => 'ramadan_haidar_esa.jpg',
    ],
    [
        'nama' => 'Riana Anggun Khairunisa',
        'password' => 'wakil_ketua',
        'jabatan' => 'Wakil Ketua Himpunan',
        'foto' => 'riana_anggun_khairunisa.jpg',
    ],
    // Sekretaris
    [
        'nama' => 'Shahnaz Alya Rafianti',
        'password' => 'sekretaris',
        'jabatan' => 'Ketua Divisi Sekretaris',
        'foto' => 'shahnaz_alya_rafianti.jpg',
    ],
    [
        'nama' => 'Fauzan Ahmad Melia Putra',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Sekretaris',
        'foto' => 'fauzan_ahmad_melia_putra.jpg',
    ],
    [
        'nama' => 'Friska Andini',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Sekretaris',
        'foto' => 'friska_andini.jpg',
    ],
    [
        'nama' => 'Muhammad Fahry',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Sekretaris',
        'foto' => 'muhammad_fahry.jpg',
    ],
    [
        'nama' => 'Nabila Dwi Maryani',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Sekretaris',
        'foto' => 'nabila_dwi_maryani.jpg',
    ],
    // Bendahara
    [
        'nama' => 'Annisa Putri Azahra',
        'password' => 'bendahara',
        'jabatan' => 'Ketua Divisi Bendahara',
        'foto' => 'annisa_putri_azahra.jpg',
    ],
    [
        'nama' => 'Rakha Maisan',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Bendahara',
        'foto' => 'rakha_maisan.jpg',
    ],
    [
        'nama' => 'Agnesia Putri Adinda',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Bendahara',
        'foto' => 'agnesia_putri_adinda.jpg',
    ],
    [
        'nama' => 'Siti Syifa Nurhayati',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Bendahara',
        'foto' => 'siti_syifa_nurhayati.jpg',
    ],
    // PSDM
    [
        'nama' => 'Denisse Christiano Budihardja',
        'password' => 'psdm',
        'jabatan' => 'Ketua Divisi Pengembangan Sumberdaya Mahasiswa',
        'foto' => 'denisse_christiano_budihardja.jpg',
    ],
    [
        'nama' => 'Azmi Zainab',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli PSDM Pengembangan Sumberdaya Mahasiswa',
        'foto' => 'azmi_zainab.jpg',
    ],
    [
        'nama' => 'Ziddane Ath-Thoriq Ruhyana',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengembangan Sumberdaya Mahasiswa',
        'foto' => 'ziddane_aththoriq_ruhyana.jpg',
    ],
    [
        'nama' => 'Ali Ridho',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengembangan Sumberdaya Mahasiswa',
        'foto' => 'ali_ridho.jpg',
    ],
    [
        'nama' => 'Pratama Raca Setiawan',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengembangan Sumberdaya Mahasiswa',
        'foto' => 'pratama_raca_setiawan.jpg',
    ],
    [
        'nama' => 'Yumna',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengembangan Sumberdaya Mahasiswa',
        'foto' => 'yumna.jpg',
    ],
    // Pengabdian dan Masyarakat
    [
        'nama' => 'Julisca Cindy Larasati',
        'password' => 'pengabdian_masyarakat',
        'jabatan' => 'Ketua Divisi Pengabdian Masyarakat',
        'foto' => 'julisca_cindy_larasati.jpg',
    ],
    [
        'nama' => 'Nayla Ramadhani',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Pengabdian Masyarakat',
        'foto' => 'nayla_ramadhani.jpg',
    ],
    [
        'nama' => 'Subekti Rahman',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Pengabdian Masyarakat',
        'foto' => 'subekti_rahman.jpg',
    ],
    [
        'nama' => 'Muhammad Zaki Adzani',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Pengabdian Masyarakat',
        'foto' => 'muhammad_zaki_adzani.jpg',
    ],
    [
        'nama' => 'Abidzar Titan Zacky',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengabdian Masyarakat',
        'foto' => 'abidzar_titan_zacky.jpg',
    ],
    [
        'nama' => 'Kayla Salsabilah Agustin',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengabdian Masyarakat',
        'foto' => 'kayla_salsabilah_agustin.jpg',
    ],
    [
        'nama' => 'Mahesa Billah Syawali',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengabdian Masyarakat',
        'foto' => 'mahesa_billah_syawali.jpg',
    ],
    [
        'nama' => 'Muhamad Bagas Al Haqqi',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengabdian Masyarakat',
        'foto' => 'muhamad_bagas_al_haqqi.jpg',
    ],
    [
        'nama' => 'Tanjung Loudry Irawan',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Pengabdian Masyarakat',
        'foto' => 'tanjung_loudry_irawan.jpg',
    ],
    // Komunikasi dan Informasi
    [
        'nama' => 'Hazel Yuri Ardiantoro',
        'password' => 'komunikasi_informasi',
        'jabatan' => 'Ketua Divisi Komunikasi dan Informasi',
        'foto' => 'hazel_yuri_ardiantoro.jpg',
    ],
    [
        'nama' => 'Dealova Aura',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Komunikasi dan Informasi',
        'foto' => 'dealova_aura.jpg',
    ],
    [
        'nama' => 'Muhammad Hisyam Patih M',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Komunikasi dan Informasi',
        'foto' => 'muhammad_hisyam_patih_m.jpg',
    ],
    [
        'nama' => 'Muhana Perdana Putra',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Komunikasi dan Informasi',
        'foto' => 'muhana_perdana.jpg',
    ],
    [
        'nama' => 'Achmad Satrio',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Komunikasi dan Informasi',
        'foto' => 'achmad_satrio.jpg',
    ],
    [
        'nama' => 'Rainer Adityama',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Komunikasi dan Informasi',
        'foto' => 'reiner_adityama.jpg',
    ],
    [
        'nama' => 'Athaya Nabila Kayana',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Komunikasi dan Informasi',
        'foto' => 'athaya_nabila_kayana.jpg',
    ],
    [
        'nama' => 'Fahira Aulia Rizki',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Komunikasi dan Informasi',
        'foto' => 'fahira_aulia_rizki.jpg',
    ],
    [
        'nama' => 'Firlia Khansa Fathinah',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Komunikasi dan Informasi',
        'foto' => 'firlia_khansa_fathinah.jpg',
    ],
    [
        'nama' => 'Haniin Az Zahra',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Komunikasi dan Informasi',
        'foto' => 'haniin_az_zahra.jpg',
    ],
    [
        'nama' => 'Nadhin Galuh Ekania Wijanarko',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Komunikasi dan Informasi',
        'foto' => 'nadhin_galuh_ekania_wijanarko.jpg',
    ],
    [
        'nama' => 'Syifa Aulia Ramadhani',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Komunikasi dan Informasi',
        'foto' => 'syifa_aulia_ramadhani.jpg',
    ],
    [
        'nama' => 'Veby Nurfauziah',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Komunikasi dan Informasi',
        'foto' => 'veby_nurfauziah.jpg',
    ],
    // Kemahasiswaan
    [
        'nama' => 'Ladykeiren Sekawanie Loviandri',
        'password' => 'kemahasiswaan',
        'jabatan' => 'Ketua Divisi Kemahasiswaan',
        'foto' => 'ladykeiren_sekawanie_loviandri.jpg',
    ],
    [
        'nama' => 'Aufa Ananda Fizla',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Kemahasiswaan',
        'foto' => 'aufa_ananda_fizla.jpg',
    ],
    [
        'nama' => 'Rafif Pandu Putra',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Kemahasiswaan',
        'foto' => 'rafif_pandu_putra.jpg',
    ],
    [
        'nama' => 'Aditya Indrayana',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Kemahasiswaan',
        'foto' => 'aditya_indrayana.jpg',
    ],
    [
        'nama' => 'Annisa Zhafirah',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Kemahasiswaan',
        'foto' => 'annisa_zhafirah.jpg',
    ],
    [
        'nama' => 'Arifah Dwiyanti',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Kemahasiswaan',
        'foto' => 'arifah_dwiyanti.jpg',
    ],
    [
        'nama' => 'Gandes Sausan Maheswari Harjanto',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Kemahasiswaan',
        'foto' => 'gandes_sausan_maheswari_harjanto.jpg',
    ],
    [
        'nama' => 'Miftahkhul Khoir',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Kemahasiswaan',
        'foto' => 'miftahkhul_khoir.jpg',
    ],
    // Hubungan Masyarakat
    [
        'nama' => 'Irviean Yoga Mahardika',
        'password' => 'hubungan_masyarakat',
        'jabatan' => 'Ketua Divisi Hubungan Masyarakat',
        'foto' => 'irviean_yoga_mahardika.jpg',
    ],
    [
        'nama' => 'Siti Nur Azizah',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Hubungan Masyarakat',
        'foto' => 'siti_nur_azizah.jpg',
    ],
    [
        'nama' => 'Andi Andreas Sakhi',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Hubungan Masyarakat',
        'foto' => 'andy_andreas_sakhi.jpg',
    ],
    [
        'nama' => 'Flavine Ferdiansyah',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Hubungan Masyarakat',
        'foto' => 'flavine_ferdiansyah.jpg',
    ],
    [
        'nama' => 'Helena Aurelia Nurlaily',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Hubungan Masyarakat',
        'foto' => 'helena_aurelia_nurlaily.jpg',
    ],
    [
        'nama' => 'Nadjma Khayla Achmad',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Hubungan Masyarakat',
        'foto' => 'nadjma_khayla_achmad.jpg',
    ],
    [
        'nama' => 'Ridho Gagah Indrayana',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Hubungan Masyarakat',
        'foto' => 'ridho_gagah_indrayana.jpg',
    ],
    // Ekonomi Kreatif
    [
        'nama' => 'Selva Amanda',
        'password' => 'ekonomi_kreatif',
        'jabatan' => 'Ketua Divisi Ekonomi Kreatif',
        'foto' => 'selva_amanda.jpg',
    ],
    [
        'nama' => 'Dzazkiyah Aulia K',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Ekonomi Kreatif',
        'foto' => 'dzazkiyah_aulia_k.jpg',
    ],
    [
        'nama' => 'Anisa Safira Putri',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Ekonomi Kreatif',
        'foto' => 'anisa_safira_putri.jpg',
    ],
    [
        'nama' => 'Daaniys Khalila Ramadhan',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Ekonomi Kreatif',
        'foto' => 'daaniys_khalila_ramadhan.jpg',
    ],
    [
        'nama' => 'Farel Abieza Azri',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Ekonomi Kreatif',
        'foto' => 'farel_abieza_azri.jpg',
    ],
    [
        'nama' => 'Nasywa Syakira Ramadhani',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Ekonomi Kreatif',
        'foto' => 'nasywa_syakira_ramadhani.jpg',
    ],
    // Penelitian dan Pengembangan
    [
        'nama' => 'Mayrel Zico Fadlan',
        'password' => 'penelitian_pengembangan',
        'jabatan' => 'Ketua Divisi Penelitian dan Pengembangan',
        'foto' => 'mayrel_zico_fadlan.jpg',
    ],
    [
        'nama' => 'Samuel Pratama Bangun',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Penelitian dan Pengembangan',
        'foto' => 'samuel_pratama_bangun.jpg',
    ],
    [
        'nama' => 'Naufal Akbar Kaffatah Hakim',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Penelitian dan Pengembangan',
        'foto' => 'naufal_akbar_kaffatah_hakim.jpg',
    ],
    [
        'nama' => 'Muhammad Fachri',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Penelitian dan Pengembangan',
        'foto' => 'muhammad_fachri.jpg',
    ],
    [
        'nama' => 'Muhammad Fauzan Haqqi',
        'password' => 'staff_ahli',
        'jabatan' => 'Staff Ahli Penelitian dan Pengembangan',
        'foto' => 'muhammad_fauzan_haqqi.jpg',
    ],
    [
        'nama' => 'Farhan Awalutfi',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Penelitian dan Pengembangan',
        'foto' => 'farhan_awalutfi.jpg',
    ],
    [
        'nama' => 'Ja’far Kholid Al Munawar',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Penelitian dan Pengembangan',
        'foto' => 'ja_far_kholid_al_munawar.jpg',
    ],
    [
        'nama' => 'Muhammad Yasir',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Penelitian dan Pengembangan',
        'foto' => 'muhammad_yasir.jpg',
    ],
    [
        'nama' => 'Siwi Utami Ramadhani',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Penelitian dan Pengembangan',
        'foto' => 'siwi_utami_ramadhani.jpg',
    ],
    [
        'nama' => 'Yoga Cipta Pratama',
        'password' => 'anggota_divisi',
        'jabatan' => 'Anggota Divisi Penelitian dan Pengembangan',
        'foto' => 'yoga_cipta_pratama.jpg',
    ],
    ];

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        foreach($this->users as $user){

            if(
                strtolower($request->nama) == strtolower($user['nama']) &&
                $request->password == $user['password']
            ){
                $jabatan = $user['jabatan'];
                // Determine admin using Role helper
                $isAdmin = \App\Support\Role::isAdmin($jabatan);
                $user['peran'] = $isAdmin ? 'Admin' : 'Pengguna Umum';
                $user['label_peran'] = $isAdmin ? 'Admin' : 'Anggota';
                $user['is_admin'] = $isAdmin;
                // Remove password before storing in session
                unset($user['password']);
                session(['user' => $user]);
                return redirect('/');
            }
        }

        return back()->with('error','Nama / Password salah');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect('/login');
    }
}