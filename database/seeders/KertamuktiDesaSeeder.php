<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Situs;
use App\Models\Kontak;
use App\Models\VideoProfil;
use App\Models\Sejarah;
use App\Models\KepalaDesa;
use App\Models\VisiMisi;
use App\Models\Wilayah;
use App\Models\Peta;
use App\Models\Agama;
use App\Models\JenisKelamin;
use App\Models\Pekerjaan;
use App\Models\PerangkatDesa;
use App\Models\Lkd;
use App\Models\LkdMember;
use App\Models\Layanan;
use App\Models\PostStatus;
use App\Models\Kategori;
use App\Models\Berita;
use App\Models\Announcement;
use App\Models\Umkm;
use App\Models\Anggaran;
use App\Models\Buku;
use App\Models\Slider;
use App\Models\Gallery;

class KertamuktiDesaSeeder extends Seeder
{
    /**
     * Run the database seeds for Desa Kertamukti, Kec. Ciawi, Kab. Tasikmalaya.
     */
    public function run(): void
    {
        // 1. Sinkronisasi struktur tabel & kolom agar seluruh fitur aplikasi berjalan tanpa error
        $this->syncDatabaseSchema();

        // 2. Buat akun Admin Utama (pertahankan jika sudah ada)
        $adminFoto = $this->ensurePlaceholderImage('img-profil/admin-kertamukti.jpg', 'ADMIN DESA', 'Desa Kertamukti', 400, 400, [22, 101, 52]);
        $admin = User::first();
        if (!$admin) {
            $admin = User::create([
                'name'     => 'Admin Desa Kertamukti',
                'email'    => 'admin@kertamuktidesa.id',
                'password' => Hash::make('kertamukti123'),
                'foto'     => $adminFoto,
            ]);
        } elseif (!$admin->foto) {
            $admin->update(['foto' => $adminFoto]);
        }
        $userId = $admin->id;

        // 3. Identitas Situs (Pertahankan logo jika sudah diupload oleh admin)
        $existingSitus = Situs::first();
        $logoPath = ($existingSitus && $existingSitus->logo)
            ? $existingSitus->logo
            : $this->ensurePlaceholderImage('img-logo/logo-kertamukti.png', 'DESA KERTAMUKTI', 'Kab. Tasikmalaya', 400, 400, [22, 101, 52]);

        Situs::updateOrCreate(
            ['id' => $existingSitus ? $existingSitus->id : 1],
            [
                'logo'      => $logoPath,
                'nm_desa'   => 'Desa Kertamukti',
                'kecamatan' => 'Kecamatan Ciawi',
                'kabupaten' => 'Kabupaten Tasikmalaya',
                'provinsi'  => 'Jawa Barat',
                'kode_pos'  => '46156',
                'user_id'   => $userId,
            ]
        );

        // 4. Kontak Desa
        $existingKontak = Kontak::first();
        Kontak::updateOrCreate(
            ['id' => $existingKontak ? $existingKontak->id : 1],
            [
                'lokasi'  => 'Jl. Desa Kertamukti, Dusun Kertamukti, Desa Kertamukti, Kec. Ciawi, Kabupaten Tasikmalaya, Jawa Barat 46156',
                'email'   => 'pemdes@kertamuktidesa.id',
                'no_hp'   => '81223456789',
                'user_id' => $userId,
            ]
        );

        // 5. Video Profil
        $existingVideo = VideoProfil::first();
        VideoProfil::updateOrCreate(
            ['id' => $existingVideo ? $existingVideo->id : 1],
            [
                'url_video' => 'https://www.youtube.com/embed/6stlCkUDG_s',
                'user_id'   => $userId,
            ]
        );

        // 6. Sejarah Desa Kertamukti (Data Asli Pemekaran 20 Mei 1980 dari Desa Gombong)
        $sejarahBody = <<<'HTML'
<p><strong>Desa Kertamukti</strong> merupakan salah satu desa di wilayah Kecamatan Ciawi, Kabupaten Tasikmalaya, Provinsi Jawa Barat yang memiliki sejarah panjang dalam perkembangan masyarakat dan wilayahnya. Secara historis, Desa Kertamukti merupakan hasil pemekaran dari <strong>Desa Gombong</strong>, Kecamatan Ciawi.</p>

<p>Seiring dengan bertambahnya jumlah penduduk dan meningkatnya kebutuhan akan efektivitas pelayanan pemerintahan serta pemerataan pembangunan di kawasan lereng timur Gunung Talaga Bodas, para tokoh masyarakat, sesepuh, dan warga setempat mengusulkan pembentukan desa baru. Atas prakarsa dan musyawarah tersebut, Desa Kertamukti secara resmi disahkan dan berdiri sebagai desa otonom pada tanggal <strong>20 Mei 1980</strong>. Tanggal 20 Mei kemudian ditetapkan dan diperingati setiap tahunnya sebagai Hari Jadi (Milangkala) Desa Kertamukti.</p>

<h4>Masa Awal Pemerintahan</h4>
<p>Pada awal berdirinya sebagai desa persiapan hingga desa definitif (tahun 1981–1983), roda pemerintahan Desa Kertamukti dipimpin oleh Penjabat Sementara (PJS) Kepala Desa pertama, yaitu Bapak <strong>Endang Suherlan</strong>. Beliau bertugas menata struktur organisasi pemerintahan desa awal, pembagian wilayah kedusunan, serta mempersiapkan pemilihan kepala desa definitif.</p>

<p>Pada akhir tahun <strong>1983</strong>, Desa Kertamukti menyelenggarakan Pemilihan Kepala Desa definitif untuk pertama kalinya secara demokratis. Dalam pemilihan bersejarah tersebut, Bapak <strong>Yuha Djuhana</strong> terpilih sebagai Kepala Desa definitif pertama dan memimpin Desa Kertamukti selama periode 1983 hingga 1992.</p>

<h4>Perkembangan Wilayah & Pembangunan</h4>
<p>Secara administratif dan kewilayahan, Desa Kertamukti berkembang menjadi <strong>6 (enam) Kedusunan</strong>, yang mencakup <strong>12 Rukun Warga (RW)</strong> dan <strong>32 Rukun Tetangga (RT)</strong>, yaitu:</p>
<ol>
    <li><strong>Dusun Kertamukti</strong></li>
    <li><strong>Dusun Cibuyut</strong></li>
    <li><strong>Dusun Karangmukti</strong></li>
    <li><strong>Dusun Sukamaju</strong></li>
    <li><strong>Dusun Jamilega</strong></li>
    <li><strong>Dusun Mulyarasa</strong></li>
</ol>

<p>Dari masa ke masa, kepemimpinan di Desa Kertamukti terus berlanjut secara berkesinambungan melalui para kepala desa dan penjabat kepala desa yang berdedikasi membangun infrastruktur jalan desa, sarana peribadatan, fasilitas pendidikan (PAUD dan sekolah dasar), fasilitas kesehatan masyarakat seperti Puskesmas Pembantu (Pustu) dan Posyandu, hingga penguatan ekonomi masyarakat berbasis pertanian, perkebunan lereng Gunung Talaga Bodas, dan UMKM desa.</p>
HTML;

        $existingSejarah = Sejarah::first();
        Sejarah::updateOrCreate(
            ['id' => $existingSejarah ? $existingSejarah->id : 1],
            [
                'judul'   => 'Sejarah Berdirinya Desa Kertamukti',
                'body'    => $sejarahBody,
                'user_id' => $userId,
            ]
        );

        // 7. Riwayat Kepala Desa Kertamukti (10 Kepala Desa Asli dari 1981 - Sekarang)
        $kepalaDesaList = [
            [
                'nama'            => 'Endang Suherlan',
                'periode_mulai'   => '1981',
                'periode_selesai' => '1983',
                'catatan'         => 'Penjabat Sementara (PJS) Kepala Desa pertama pasca pemekaran Desa Kertamukti dari Desa Gombong (20 Mei 1980).',
            ],
            [
                'nama'            => 'Yuha Djuhana',
                'periode_mulai'   => '1983',
                'periode_selesai' => '1992',
                'catatan'         => 'Kepala Desa Definitif pertama hasil Pemilihan Kepala Desa Kertamukti pada akhir tahun 1983.',
            ],
            [
                'nama'            => 'Nasum Suherli Wijaya',
                'periode_mulai'   => '1992',
                'periode_selesai' => '1999',
                'catatan'         => 'Kepala Desa Definitif periode kedua yang melanjutkan pembangunan sarana dasar desa.',
            ],
            [
                'nama'            => 'Endang Nedi Sutiadi',
                'periode_mulai'   => '1999',
                'periode_selesai' => '2001',
                'catatan'         => 'Penjabat Sementara (PJS) Kepala Desa pada masa transisi pemerintahan.',
            ],
            [
                'nama'            => 'Marhidin',
                'periode_mulai'   => '2001',
                'periode_selesai' => '2007',
                'catatan'         => 'Kepala Desa Definitif periode 2001–2007.',
            ],
            [
                'nama'            => 'Totong Suryana',
                'periode_mulai'   => '2007',
                'periode_selesai' => '2013',
                'catatan'         => 'Kepala Desa Definitif periode 2007–2013.',
            ],
            [
                'nama'            => 'Esa Sohana',
                'periode_mulai'   => '2013',
                'periode_selesai' => '2013',
                'catatan'         => 'Pelaksana Harian (PLH) Kepala Desa selama masa transisi pemilihan (20 hari).',
            ],
            [
                'nama'            => 'Asep Purnama',
                'periode_mulai'   => '2013',
                'periode_selesai' => '2018',
                'catatan'         => 'Kepala Desa Definitif periode 2013–2018 yang mendorong pembangunan infrastruktur antar-dusun.',
            ],
            [
                'nama'            => 'Odang',
                'periode_mulai'   => '2018',
                'periode_selesai' => '2019',
                'catatan'         => 'Penjabat Sementara (PJS) Kepala Desa Kertamukti.',
            ],
            [
                'nama'            => 'Suganda',
                'periode_mulai'   => '2019',
                'periode_selesai' => 'Sekarang',
                'catatan'         => 'Kepala Desa Definitif yang menjabat saat ini, fokus pada peningkatan layanan publik, fasilitas kesehatan (Pustu), infrastruktur 6 kedusunan, dan pemberdayaan ekonomi masyarakat.',
            ],
        ];

        foreach ($kepalaDesaList as $kd) {
            KepalaDesa::updateOrCreate(
                ['nama' => $kd['nama'], 'periode_mulai' => $kd['periode_mulai']],
                [
                    'periode_selesai' => $kd['periode_selesai'],
                    'catatan'         => $kd['catatan'],
                    'user_id'         => $userId,
                ]
            );
        }

        // 8. Visi & Misi Desa Kertamukti
        $visiText = '<p><strong>"Terwujudnya Desa Kertamukti yang Religius, Mandiri, Sejahtera, dan Unggul Berbasis Potensi Pertanian serta Pelayanan Publik yang Transparan dan Akuntabel"</strong></p>';
        $misiText = <<<'HTML'
<ol>
    <li><strong>Meningkatkan Kualitas Kehidupan Beragama dan Sosial:</strong> Memperkuat nilai-nilai keagamaan, kegotongroyongan, dan kerukunan warga di seluruh wilayah 6 kedusunan Desa Kertamukti.</li>
    <li><strong>Mewujudkan Tata Kelola Pemerintahan Desa yang Profesional & Digital:</strong> Meningkatkan kualitas pelayanan administrasi kependudukan dan layanan publik yang cepat, mudah, ramah, serta transparan melalui sistem informasi desa.</li>
    <li><strong>Mengoptimalkan Pembangunan Infrastruktur Merata:</strong> Melaksanakan pembangunan dan pemeliharaan jalan desa, jalan lingkungan, saluran irigasi pertanian, dan sarana umum di Dusun Kertamukti, Cibuyut, Karangmukti, Sukamaju, Jamilega, dan Mulyarasa.</li>
    <li><strong>Mengembangkan Potensi Ekonomi, Pertanian & UMKM:</strong> Memberdayakan kelompok tani di kawasan lereng Gunung Talaga Bodas serta pelaku Usaha Mikro, Kecil, dan Menengah (UMKM) dan BUMDes agar berdaya saing tinggi.</li>
    <li><strong>Meningkatkan Kualitas Kesehatan dan Pendidikan Masyarakat:</strong> Mengoptimalkan layanan Puskesmas Pembantu (Pustu), Posyandu, pencegahan stunting, serta mendukung sarana pendidikan anak usia dini (PAUD), pendidikan dasar, dan keagamaan.</li>
</ol>
HTML;

        $existingVisiMisi = VisiMisi::first();
        VisiMisi::updateOrCreate(
            ['id' => $existingVisiMisi ? $existingVisiMisi->id : 1],
            [
                'visi'    => $visiText,
                'misi'    => $misiText,
                'user_id' => $userId,
            ]
        );

        // 9. Wilayah Desa Kertamukti (Data Geografis & Administratif Asli)
        $wilayahBody = <<<'HTML'
<p><strong>Desa Kertamukti</strong> terletak di Kecamatan Ciawi, Kabupaten Tasikmalaya, Provinsi Jawa Barat dengan Kode Pos <strong>46156</strong>. Secara geografis, wilayah Desa Kertamukti berada di kawasan lereng bagian timur <strong>Gunung Talaga Bodas</strong>, sehingga memiliki topografi dataran tinggi dan perbukitan yang berhawa sejuk, tanah yang subur, serta sumber daya air yang mendukung sektor pertanian dan perkebunan.</p>

<h4>1. Luas & Jarak Wilayah</h4>
<ul>
    <li><strong>Luas Wilayah Total:</strong> ± 273,636 Hektare (sekitar 2,74 km²)</li>
    <li><strong>Jarak ke Ibu Kota Kecamatan Ciawi:</strong> ± 12 Kilometer ke arah selatan</li>
    <li><strong>Karakteristik Lahan:</strong> Didominasi oleh lahan pertanian sawah, ladang hortikultura, perkebunan rakyat, serta kawasan permukiman penduduk.</li>
</ul>

<h4>2. Pembagian Wilayah Administratif</h4>
<p>Secara administratif, wilayah Desa Kertamukti terdiri atas <strong>6 (enam) Kedusunan</strong>, <strong>12 Rukun Warga (RW)</strong>, dan <strong>32 Rukun Tetangga (RT)</strong>:</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kedusunan</th>
            <th>Keterangan Wilayah</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><strong>Dusun Kertamukti</strong></td>
            <td>Pusat Pemerintahan Desa & Permukiman</td>
        </tr>
        <tr>
            <td>2</td>
            <td><strong>Dusun Cibuyut</strong></td>
            <td>Sentra Pertanian, Permukiman & Pendidikan (PAUD)</td>
        </tr>
        <tr>
            <td>3</td>
            <td><strong>Dusun Karangmukti</strong></td>
            <td>Kawasan Pertanian & Permukiman Warga</td>
        </tr>
        <tr>
            <td>4</td>
            <td><strong>Dusun Sukamaju</strong></td>
            <td>Sentra Hortikultura, Perkebunan & Permukiman</td>
        </tr>
        <tr>
            <td>5</td>
            <td><strong>Dusun Jamilega</strong></td>
            <td>Kawasan Pertanian & Kerajinan Olahan Pangan</td>
        </tr>
        <tr>
            <td>6</td>
            <td><strong>Dusun Mulyarasa</strong></td>
            <td>Kawasan Perkebunan Lereng & Permukiman</td>
        </tr>
    </tbody>
</table>

<h4>3. Batas-Batas Wilayah</h4>
<ul>
    <li><strong>Sebelah Utara:</strong> Berbatasan dengan Desa Gombong / Desa Bugel, Kecamatan Ciawi</li>
    <li><strong>Sebelah Timur:</strong> Berbatasan dengan Desa Gombong / Desa Margasari, Kecamatan Ciawi</li>
    <li><strong>Sebelah Selatan:</strong> Berbatasan dengan Desa Citamba, Kecamatan Ciawi / Kecamatan Sukaresik</li>
    <li><strong>Sebelah Barat:</strong> Berbatasan dengan Kawasan Hutan Lindung Lereng Gunung Talaga Bodas</li>
</ul>
HTML;

        $existingWilayah = Wilayah::first();
        Wilayah::updateOrCreate(
            ['id' => $existingWilayah ? $existingWilayah->id : 1],
            [
                'judul'   => 'Profil Geografis & Pembagian Wilayah Desa Kertamukti',
                'body'    => $wilayahBody,
                'user_id' => $userId,
            ]
        );

        // 10. Peta Desa Kertamukti
        $existingPeta = Peta::first();
        Peta::updateOrCreate(
            ['id' => $existingPeta ? $existingPeta->id : 1],
            [
                'judul'     => 'Peta Wilayah Desa Kertamukti, Kec. Ciawi, Kab. Tasikmalaya',
                'alamat'    => 'Desa Kertamukti, Kecamatan Ciawi, Kabupaten Tasikmalaya, Jawa Barat 46156',
                'body'      => '<p>Lokasi geografis Desa Kertamukti berada di bagian selatan Kecamatan Ciawi, Kabupaten Tasikmalaya, tepat di lereng timur Gunung Talaga Bodas yang meliputi 6 kedusunan: Dusun Kertamukti, Dusun Cibuyut, Dusun Karangmukti, Dusun Sukamaju, Dusun Jamilega, dan Dusun Mulyarasa.</p>',
                'latitude'  => '-7.185600',
                'longitude' => '108.127800',
                'user_id'   => $userId,
            ]
        );

        // 11. Data Demografi: Jenis Kelamin (Total 5.190 Jiwa sesuai data Kecamatan Ciawi)
        $jenisKelaminData = [
            ['jenis_kelamin' => 'Laki-laki', 'jumlah' => 2635],
            ['jenis_kelamin' => 'Perempuan', 'jumlah' => 2555],
        ];
        foreach ($jenisKelaminData as $jk) {
            JenisKelamin::updateOrCreate(
                ['jenis_kelamin' => $jk['jenis_kelamin']],
                [
                    'jumlah'  => $jk['jumlah'],
                    'user_id' => $userId,
                ]
            );
        }

        // 12. Data Demografi: Agama (Total 5.190 Jiwa)
        $agamaData = [
            ['agama' => 'Islam', 'penganut' => 5190],
            ['agama' => 'Kristen', 'penganut' => 0],
            ['agama' => 'Katolik', 'penganut' => 0],
            ['agama' => 'Hindu', 'penganut' => 0],
            ['agama' => 'Buddha', 'penganut' => 0],
            ['agama' => 'Konghucu', 'penganut' => 0],
        ];
        foreach ($agamaData as $ag) {
            Agama::updateOrCreate(
                ['agama' => $ag['agama']],
                [
                    'penganut' => $ag['penganut'],
                    'user_id'  => $userId,
                ]
            );
        }

        // 13. Data Demografi: Pekerjaan Penduduk
        $pekerjaanData = [
            ['pekerjaan' => 'Petani / Pekebun', 'jumlah' => 1420],
            ['pekerjaan' => 'Buruh Tani / Perkebunan', 'jumlah' => 680],
            ['pekerjaan' => 'Mengurus Rumah Tangga', 'jumlah' => 1120],
            ['pekerjaan' => 'Pelajar / Mahasiswa', 'jumlah' => 980],
            ['pekerjaan' => 'Wiraswasta / Pedagang', 'jumlah' => 460],
            ['pekerjaan' => 'Karyawan Swasta', 'jumlah' => 340],
            ['pekerjaan' => 'Guru / Tenaga Pendidik', 'jumlah' => 85],
            ['pekerjaan' => 'PNS / TNI / Polri', 'jumlah' => 45],
            ['pekerjaan' => 'Lainnya / Belum Bekerja', 'jumlah' => 60],
        ];
        foreach ($pekerjaanData as $pk) {
            Pekerjaan::updateOrCreate(
                ['pekerjaan' => $pk['pekerjaan']],
                [
                    'jumlah'  => $pk['jumlah'],
                    'user_id' => $userId,
                ]
            );
        }

        // 14. Perangkat Desa Kertamukti (Kepala Desa, Perangkat, dan 6 Kepala Dusun)
        $perangkatList = [
            ['nama' => 'Suganda', 'jabatan' => 'Kepala Desa Kertamukti'],
            ['nama' => 'Sekretaris Desa', 'jabatan' => 'Sekretaris Desa'],
            ['nama' => 'Kaur Tata Usaha & Umum', 'jabatan' => 'Kaur TU & Umum'],
            ['nama' => 'Kaur Keuangan', 'jabatan' => 'Kaur Keuangan'],
            ['nama' => 'Kaur Perencanaan', 'jabatan' => 'Kaur Perencanaan'],
            ['nama' => 'Kasi Pemerintahan', 'jabatan' => 'Kasi Pemerintahan'],
            ['nama' => 'Kasi Kesejahteraan', 'jabatan' => 'Kasi Kesejahteraan'],
            ['nama' => 'Kasi Pelayanan', 'jabatan' => 'Kasi Pelayanan'],
            ['nama' => 'Kepala Dusun Kertamukti', 'jabatan' => 'Kasun Kertamukti'],
            ['nama' => 'Kepala Dusun Cibuyut', 'jabatan' => 'Kasun Cibuyut'],
            ['nama' => 'Kepala Dusun Karangmukti', 'jabatan' => 'Kasun Karangmukti'],
            ['nama' => 'Kepala Dusun Sukamaju', 'jabatan' => 'Kasun Sukamaju'],
            ['nama' => 'Kepala Dusun Jamilega', 'jabatan' => 'Kasun Jamilega'],
            ['nama' => 'Kepala Dusun Mulyarasa', 'jabatan' => 'Kasun Mulyarasa'],
        ];

        foreach ($perangkatList as $idx => $pr) {
            $slugName = Str::slug($pr['jabatan']);
            $fotoPath = $this->ensurePlaceholderImage(
                "img-perangkat/perangkat-{$slugName}.jpg",
                $pr['nama'],
                $pr['jabatan'],
                500,
                500,
                [34, 139, 94]
            );

            PerangkatDesa::updateOrCreate(
                ['jabatan' => $pr['jabatan']],
                [
                    'nama'    => $pr['nama'],
                    'foto'    => $fotoPath,
                    'user_id' => $userId,
                ]
            );
        }

        // 15. Lembaga Kemasyarakatan Desa (LKD) & Anggota
        $lkdList = [
            [
                'judul'     => 'Badan Permusyawaratan Desa (BPD)',
                'slug'      => 'badan-permusyawaratan-desa-bpd',
                'deskripsi' => 'Lembaga yang melaksanakan fungsi pemerintahan yang anggotanya merupakan wakil dari penduduk Desa Kertamukti berdasarkan keterwakilan wilayah 6 kedusunan dan ditetapkan secara demokratis.',
                'members'   => [
                    ['nama' => 'Ketua BPD Kertamukti', 'jabatan' => 'Ketua BPD', 'kategori' => 'struktur', 'order_no' => 1],
                    ['nama' => 'Wakil Ketua BPD', 'jabatan' => 'Wakil Ketua', 'kategori' => 'struktur', 'order_no' => 2],
                    ['nama' => 'Sekretaris BPD', 'jabatan' => 'Sekretaris', 'kategori' => 'struktur', 'order_no' => 3],
                    ['nama' => 'Perwakilan Dusun Kertamukti', 'jabatan' => 'Anggota BPD', 'kategori' => 'struktur', 'order_no' => 4],
                    ['nama' => 'Perwakilan Dusun Cibuyut', 'jabatan' => 'Anggota BPD', 'kategori' => 'struktur', 'order_no' => 5],
                    ['nama' => 'Perwakilan Dusun Karangmukti', 'jabatan' => 'Anggota BPD', 'kategori' => 'struktur', 'order_no' => 6],
                ],
            ],
            [
                'judul'     => 'Lembaga Pemberdayaan Masyarakat (LPM)',
                'slug'      => 'lembaga-pemberdayaan-masyarakat-lpm',
                'deskripsi' => 'Lembaga kemasyarakatan Desa Kertamukti yang bertugas menyusun rencana pembangunan secara partisipatif, menggerakkan swadaya gotong royong masyarakat, dan melaksanakan serta mengendalikan pembangunan.',
                'members'   => [
                    ['nama' => 'Ketua LPM Kertamukti', 'jabatan' => 'Ketua LPM', 'kategori' => 'struktur', 'order_no' => 1],
                    ['nama' => 'Sekretaris LPM', 'jabatan' => 'Sekretaris', 'kategori' => 'struktur', 'order_no' => 2],
                    ['nama' => 'Bendahara LPM', 'jabatan' => 'Bendahara', 'kategori' => 'struktur', 'order_no' => 3],
                    ['nama' => 'Seksi Pembangunan & Infrastruktur', 'jabatan' => 'Koordinator Pembangunan', 'kategori' => 'struktur', 'order_no' => 4],
                ],
            ],
            [
                'judul'     => 'Tim Penggerak PKK Desa Kertamukti',
                'slug'      => 'tim-penggerak-pkk-desa-kertamukti',
                'deskripsi' => 'Lembaga kemasyarakatan yang memberdayakan perempuan dan keluarga melalui 10 Program Pokok PKK, pembinaan Posyandu, PAUD, kesehatan ibu dan anak, serta peningkatan ekonomi keluarga (UP2K) di Desa Kertamukti.',
                'members'   => [
                    ['nama' => 'Ketua TP-PKK Desa Kertamukti', 'jabatan' => 'Ketua TP-PKK', 'kategori' => 'pkk', 'order_no' => 1],
                    ['nama' => 'Wakil Ketua TP-PKK', 'jabatan' => 'Wakil Ketua', 'kategori' => 'pkk', 'order_no' => 2],
                    ['nama' => 'Sekretaris PKK', 'jabatan' => 'Sekretaris', 'kategori' => 'pkk', 'order_no' => 3],
                    ['nama' => 'Bendahara PKK', 'jabatan' => 'Bendahara', 'kategori' => 'pkk', 'order_no' => 4],
                    ['nama' => 'Ketua Pokja I - IV', 'jabatan' => 'Koordinator Pokja', 'kategori' => 'pkk', 'order_no' => 5],
                ],
            ],
            [
                'judul'     => 'Karang Taruna Desa Kertamukti',
                'slug'      => 'karang-taruna-desa-kertamukti',
                'deskripsi' => 'Wadah pengembangan generasi muda Desa Kertamukti yang tumbuh atas dasar kesadaran dan tanggung jawab sosial untuk kesejahteraan sosial, kepemudaan, olahraga, kesenian, dan wirausaha pemuda.',
                'members'   => [
                    ['nama' => 'Ketua Karang Taruna Kertamukti', 'jabatan' => 'Ketua', 'kategori' => 'karang_taruna', 'order_no' => 1],
                    ['nama' => 'Wakil Ketua Karang Taruna', 'jabatan' => 'Wakil Ketua', 'kategori' => 'karang_taruna', 'order_no' => 2],
                    ['nama' => 'Sekretaris Karang Taruna', 'jabatan' => 'Sekretaris', 'kategori' => 'karang_taruna', 'order_no' => 3],
                    ['nama' => 'Bidang Olahraga & Kepemudaan', 'jabatan' => 'Koordinator', 'kategori' => 'karang_taruna', 'order_no' => 4],
                ],
            ],
            [
                'judul'     => 'Forum RT / RW (12 RW & 32 RT)',
                'slug'      => 'forum-rt-rw-desa-kertamukti',
                'deskripsi' => 'Lembaga kemasyarakatan tingkat Rukun Warga (12 RW) dan Rukun Tetangga (32 RT) yang tersebar di 6 Kedusunan Desa Kertamukti untuk membantu pelayanan kependudukan dan ketertiban warga.',
                'members'   => [
                    ['nama' => 'Koordinator RW Dusun Kertamukti', 'jabatan' => 'Ketua RW 01 - 02', 'kategori' => 'rw', 'order_no' => 1],
                    ['nama' => 'Koordinator RW Dusun Cibuyut', 'jabatan' => 'Ketua RW 03 - 04', 'kategori' => 'rw', 'order_no' => 2],
                    ['nama' => 'Koordinator RW Dusun Karangmukti', 'jabatan' => 'Ketua RW 05 - 06', 'kategori' => 'rw', 'order_no' => 3],
                    ['nama' => 'Koordinator RW Dusun Sukamaju', 'jabatan' => 'Ketua RW 07 - 08', 'kategori' => 'rw', 'order_no' => 4],
                    ['nama' => 'Koordinator RW Dusun Jamilega', 'jabatan' => 'Ketua RW 09 - 10', 'kategori' => 'rw', 'order_no' => 5],
                    ['nama' => 'Koordinator RW Dusun Mulyarasa', 'jabatan' => 'Ketua RW 11 - 12', 'kategori' => 'rw', 'order_no' => 6],
                ],
            ],
            [
                'judul'     => 'Satlinmas Desa Kertamukti',
                'slug'      => 'satlinmas-desa-kertamukti',
                'deskripsi' => 'Satuan Perlindungan Masyarakat Desa Kertamukti yang berperan dalam menjaga keamanan, ketertiban masyarakat, serta kesiapsiagaan penanggulangan bencana di wilayah lereng Gunung Talaga Bodas.',
                'members'   => [
                    ['nama' => 'Kepala Satgas Linmas', 'jabatan' => 'Kasatgas Linmas', 'kategori' => 'lainnya', 'order_no' => 1],
                    ['nama' => 'Komandan Regu Linmas', 'jabatan' => 'Danru Linmas', 'kategori' => 'lainnya', 'order_no' => 2],
                ],
            ],
        ];

        foreach ($lkdList as $idx => $lkdData) {
            $coverPath = $this->ensurePlaceholderImage(
                "berita/lkd/cover-{$lkdData['slug']}.jpg",
                $lkdData['judul'],
                'Lembaga Kemasyarakatan Desa Kertamukti',
                800,
                450,
                [46, 134, 95]
            );

            $lkd = Lkd::updateOrCreate(
                ['slug' => $lkdData['slug']],
                [
                    'judul'        => $lkdData['judul'],
                    'deskripsi'    => $lkdData['deskripsi'],
                    'excerpt'      => Str::limit($lkdData['deskripsi'], 150),
                    'body'         => '<p>' . $lkdData['deskripsi'] . '</p>',
                    'cover_path'   => $coverPath,
                    'published'    => true,
                    'is_published' => true,
                    'order_no'     => $idx + 1,
                    'created_by'   => $userId,
                    'user_id'      => $userId,
                ]
            );

            foreach ($lkdData['members'] as $m) {
                LkdMember::updateOrCreate(
                    ['lkd_id' => $lkd->id, 'nama' => $m['nama']],
                    [
                        'jabatan'   => $m['jabatan'],
                        'kategori'  => $m['kategori'],
                        'kontak'    => '0812-2345-6789',
                        'order_no'  => $m['order_no'],
                        'is_active' => true,
                    ]
                );
            }
        }

        // 16. Layanan Administrasi Desa Kertamukti
        $layananList = [
            [
                'layanan'     => 'Pembuatan & Pembaruan Kartu Keluarga (KK) / KTP-el',
                'persyaratan' => '<ol><li>Surat Pengantar dari RT dan RW setempat (di 6 Kedusunan Desa Kertamukti).</li><li>Kartu Keluarga (KK) asli yang lama (untuk perubahan data).</li><li>Fotokopi Buku Nikah / Akta Perkawinan bagi yang sudah menikah.</li><li>Fotokopi Akta Kelahiran atau Ijazah terakhir.</li><li>Surat Keterangan Pindah Datang (jika warga pendatang baru).</li></ol>',
            ],
            [
                'layanan'     => 'Surat Keterangan Tidak Mampu (SKTM) Pendidikan & Kesehatan',
                'persyaratan' => '<ol><li>Surat Pengantar RT/RW sesuai domisili dusun.</li><li>Fotokopi KTP-el dan Kartu Keluarga (KK) pemohon.</li><li>Data dukung peruntukan (Kartu Pelajar / Surat Rujukan Puskesmas atau Rumah Sakit).</li><li>Terdaftar dalam basis data keluarga kurang mampu / DTKS Desa Kertamukti.</li></ol>',
            ],
            [
                'layanan'     => 'Surat Keterangan Usaha (SKU) & Pengantar NIB UMKM',
                'persyaratan' => '<ol><li>Surat Pengantar dari Ketua RT/RW setempat.</li><li>Fotokopi KTP-el dan Kartu Keluarga (KK) pemilik usaha.</li><li>Informasi jenis bidang usaha (Pertanian, Perkebunan, Olahan Pangan, atau Perdagangan) dan lokasi tempat usaha di Desa Kertamukti.</li><li>Foto tempat atau produk usaha (jika diperlukan untuk pendampingan NIB).</li></ol>',
            ],
            [
                'layanan'     => 'Surat Pengantar Nikah (Model N1 - N4)',
                'persyaratan' => '<ol><li>Surat Pengantar dari Ketua RT dan RW.</li><li>Fotokopi KTP-el dan Kartu Keluarga (KK) calon pengantin serta kedua orang tua.</li><li>Fotokopi Akta Kelahiran dan Ijazah terakhir calon pengantin.</li><li>Pasfoto latar biru ukuran 2x3 (4 lembar) dan 4x6 (2 lembar).</li><li>Akta Cerai atau Surat Keterangan Kematian bagi yang berstatus Duda/Janda.</li></ol>',
            ],
            [
                'layanan'     => 'Surat Keterangan Domisili & Pindah Penduduk',
                'persyaratan' => '<ol><li>Surat Pengantar dari Ketua RT dan Ketua RW.</li><li>KTP-el dan Kartu Keluarga (KK) asli beserta fotokopi.</li><li>Alamat tujuan pindah secara lengkap (RT/RW, Desa/Kelurahan, Kecamatan, Kabupaten/Kota).</li><li>Pasfoto ukuran 3x4 sebanyak 2 lembar.</li></ol>',
            ],
            [
                'layanan'     => 'Surat Keterangan Kelahiran & Kematian',
                'persyaratan' => '<ol><li>Surat Pengantar dari RT/RW setempat.</li><li>Surat Keterangan Kelahiran dari Bidan Desa / Pustu Kertamukti / Puskesmas Ciawi (untuk kelahiran).</li><li>Surat Keterangan Kematian dari Rumah Sakit / Tenaga Medis atau pernyataan ahli waris (untuk kematian).</li><li>Fotokopi KTP-el dan Kartu Keluarga (KK) orang tua / pelapor serta 2 orang saksi.</li></ol>',
            ],
        ];

        foreach ($layananList as $lay) {
            Layanan::updateOrCreate(
                ['layanan' => $lay['layanan']],
                [
                    'persyaratan' => $lay['persyaratan'],
                    'user_id'     => $userId,
                ]
            );
        }

        // 17. Post Statuses (1 = Draft, 2 = Publish)
        $statuses = [
            1 => ['status' => 'Draft', 'name' => 'Draft', 'slug' => 'draft'],
            2 => ['status' => 'Publish', 'name' => 'Publish', 'slug' => 'publish'],
        ];
        foreach ($statuses as $id => $st) {
            PostStatus::updateOrCreate(
                ['id' => $id],
                $st
            );
        }

        // 18. Kategori Berita
        $kategoriList = [
            ['kategori' => 'Pemerintahan Desa', 'slug' => 'pemerintahan-desa'],
            ['kategori' => 'Pembangunan & Infrastruktur', 'slug' => 'pembangunan-infrastruktur'],
            ['kategori' => 'Pertanian & UMKM', 'slug' => 'pertanian-umkm'],
            ['kategori' => 'Kesehatan & Pendidikan', 'slug' => 'kesehatan-pendidikan'],
            ['kategori' => 'Sosial & Kemasyarakatan', 'slug' => 'sosial-kemasyarakatan'],
        ];

        $kategoriMap = [];
        foreach ($kategoriList as $kat) {
            $k = Kategori::updateOrCreate(
                ['slug' => $kat['slug']],
                [
                    'kategori' => $kat['kategori'],
                    'user_id'  => $userId,
                ]
            );
            $kategoriMap[$kat['slug']] = $k->id;
        }

        // 19. Berita Desa Kertamukti
        $beritaList = [
            [
                'judul'         => 'Peringatan Milangkala Hari Jadi Desa Kertamukti: Momentum Kebersamaan Membangun Desa',
                'slug'          => 'peringatan-milangkala-hari-jadi-desa-kertamukti-momentum-kebersamaan',
                'kategori_slug' => 'pemerintahan-desa',
                'views'         => 185,
                'body'          => '<p><strong>KERTAMUKTI, CIAWI</strong> – Pemerintah Desa Kertamukti bersama seluruh warga masyarakat dari 6 kedusunan (Kertamukti, Cibuyut, Karangmukti, Sukamaju, Jamilega, dan Mulyarasa) menggelar peringatan Milangkala (Hari Jadi) Desa Kertamukti yang berdiri sejak 20 Mei 1980.</p><p>Kepala Desa Kertamukti, Bapak <strong>Suganda</strong>, dalam sambutannya menyampaikan rasa syukur atas perjalanan panjang Desa Kertamukti sejak mekar dari Desa Gombong pada tahun 1980. Beliau mengajak seluruh elemen masyarakat, BPD, LPM, PKK, Karang Taruna, serta tokoh agama untuk terus mempererat gotong royong dalam memajukan desa.</p><p>Rangkaian kegiatan Milangkala diisi dengan doa bersama, santunan sosial, jalan sehat warga, serta pameran produk pertanian dan UMKM unggulan khas lereng Gunung Talaga Bodas.</p>',
            ],
            [
                'judul'         => 'Peningkatan Fasilitas Puskesmas Pembantu (Pustu) Desa Kertamukti demi Layanan Kesehatan Prima',
                'slug'          => 'peningkatan-fasilitas-puskesmas-pembantu-pustu-desa-kertamukti',
                'kategori_slug' => 'kesehatan-pendidikan',
                'views'         => 142,
                'body'          => '<p><strong>KERTAMUKTI, CIAWI</strong> – Dalam rangka mendekatkan akses layanan kesehatan dasar bagi lebih dari 5.190 jiwa penduduk Desa Kertamukti, Pemerintah Desa Kertamukti terus berkomitmen mendukung peningkatan sarana dan prasarana Puskesmas Pembantu (Pustu) serta Posyandu di setiap kedusunan.</p><p>Kepala Desa Kertamukti, Bapak Suganda, menegaskan bahwa fasilitas kesehatan yang layak sangat penting mengingat letak geografis Desa Kertamukti yang berjarak sekitar 12 kilometer dari pusat Kecamatan Ciawi. Dengan optimalisasi Pustu dan kegiatan Posyandu rutin, warga dapat memperoleh layanan pemeriksaan kesehatan ibu hamil, imunisasi balita, pemantauan gizi, serta pengobatan dasar secara cepat dan mudah.</p>',
            ],
            [
                'judul'         => 'Musrenbangdes Desa Kertamukti Fokuskan Pemerataan Infrastruktur di Enam Kedusunan',
                'slug'          => 'musrenbangdes-desa-kertamukti-fokuskan-pemerataan-infrastruktur-enam-kedusunan',
                'kategori_slug' => 'pembangunan-infrastruktur',
                'views'         => 128,
                'body'          => '<p><strong>KERTAMUKTI, CIAWI</strong> – Pemerintah Desa Kertamukti bersama Badan Permusyawaratan Desa (BPD) dan Lembaga Pemberdayaan Masyarakat (LPM) menyelenggarakan Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes) di Aula Kantor Desa Kertamukti.</p><p>Musyawarah ini dihadiri oleh perwakilan perangkat desa, kepala dusun dari Dusun Kertamukti, Cibuyut, Karangmukti, Sukamaju, Jamilega, dan Mulyarasa, serta para ketua RT/RW dan tokoh masyarakat. Prioritas pembangunan difokuskan pada pemeliharaan jalan poros desa, penguatan drainase dan irigasi pertanian lereng Talaga Bodas, serta program pemberdayaan ekonomi masyarakat.</p>',
            ],
            [
                'judul'         => 'Optimalisasi Potensi Pertanian dan Produk UMKM Lereng Talaga Bodas Desa Kertamukti',
                'slug'          => 'optimalisasi-potensi-pertanian-dan-produk-umkm-lereng-talaga-bodas',
                'kategori_slug' => 'pertanian-umkm',
                'views'         => 164,
                'body'          => '<p><strong>KERTAMUKTI, CIAWI</strong> – Berada di kawasan dataran tinggi lereng timur Gunung Talaga Bodas dengan luas wilayah mencapai 273,636 hektare, Desa Kertamukti memiliki keunggulan komparatif pada sektor pertanian, hortikultura, dan perkebunan.</p><p>Melalui pendampingan kelompok tani dan pelaku UMKM desa, berbagai komoditas unggulan seperti kopi dataran tinggi, cabai, sayuran segar, gula aren murni, serta makanan olahan tradisional seperti keripik dan opak ketan kini terus ditingkatkan kualitas kemasan, perizinan usaha (NIB/PIRT), hingga pemasaran digital melalui Portal Resmi Desa Kertamukti.</p>',
            ],
            [
                'judul'         => 'Semarak Gotong Royong Jumsih (Jumat Bersih) Warga Desa Kertamukti Jaga Kelestarian Lingkungan',
                'slug'          => 'semarak-gotong-royong-jumsih-warga-desa-kertamukti',
                'kategori_slug' => 'sosial-kemasyarakatan',
                'views'         => 97,
                'body'          => '<p><strong>KERTAMUKTI, CIAWI</strong> – Budaya gotong royong tetap terjaga kuat di tengah masyarakat Desa Kertamukti. Setiap akhir pekan, perangkat desa bersama para Ketua RT/RW, pemuda Karang Taruna, dan warga di 32 RT melaksanakan gerakan Jumat Bersih (Jumsih).</p><p>Kegiatan meliputi pembersihan saluran air, perapihan bahu jalan desa, serta perawatan fasilitas ibadah dan lingkungan sekitar. Langkah ini juga menjadi bagian dari upaya mitigasi bencana dan menjaga keasrian alam Desa Kertamukti di kaki Gunung Talaga Bodas.</p>',
            ],
        ];

        foreach ($beritaList as $idx => $b) {
            $imgPath = $this->ensurePlaceholderImage(
                "img-berita/berita-kertamukti-" . ($idx + 1) . ".jpg",
                Str::limit($b['judul'], 38),
                'Berita Desa Kertamukti - Kec. Ciawi',
                900,
                550,
                [28, 120, 75]
            );

            Berita::updateOrCreate(
                ['slug' => $b['slug']],
                [
                    'judul'       => $b['judul'],
                    'body'        => $b['body'],
                    'gambar'      => $imgPath,
                    'excerpt'     => Str::limit(strip_tags($b['body']), 100),
                    'views'       => $b['views'],
                    'user_id'     => $userId,
                    'status_id'   => 2,
                    'kategori_id' => $kategoriMap[$b['kategori_slug']] ?? 1,
                ]
            );
        }

        // 20. Pengumuman Desa Kertamukti
        Announcement::where('slug', 'informasi-penyaluran-blt-dana-desa-kertamukti')->delete();
        $pengumumanList = [
            [
                'judul'          => 'Jadwal Pelayanan Administrasi Kantor Desa Kertamukti',
                'slug'           => 'jadwal-pelayanan-administrasi-kantor-desa-kertamukti',
                'views'          => 84,
                'isi_pengumuman' => '<p>Diberitahukan kepada seluruh warga masyarakat Desa Kertamukti bahwa pelayanan administrasi kependudukan dan surat-menyurat di Kantor Kepala Desa Kertamukti dibuka setiap hari kerja:</p><ul><li><strong>Senin – Kamis:</strong> Pukul 08.00 – 15.00 WIB</li><li><strong>Jumat:</strong> Pukul 08.00 – 14.30 WIB</li><li><strong>Sabtu – Minggu & Hari Libur Nasional:</strong> Tutup</li></ul><p>Warga yang hendak mengurus dokumen dimohon membawa surat pengantar RT/RW serta berkas persyaratan lengkap (KTP-el & Kartu Keluarga).</p>',
            ],
            [
                'judul'          => 'Jadwal Posyandu Balita & Pemeriksaan Kesehatan Lansia Bulanan',
                'slug'           => 'jadwal-posyandu-balita-dan-pemeriksaan-kesehatan-lansia',
                'views'          => 65,
                'isi_pengumuman' => '<p>Tim Penggerak PKK Desa Kertamukti bersama Bidan Desa dan Kader Posyandu mengundang seluruh ibu hamil, orang tua balita, serta warga lansia untuk hadir dalam kegiatan rutin Posyandu di masing-masing kedusunan sesuai jadwal bulanan.</p><p>Kegiatan meliputi penimbangan berat badan, pengukuran tinggi badan, pemberian makanan tambahan (PMT) pencegahan stunting, imunisasi, serta pemeriksaan tensi darah lansia.</p>',
            ],
        ];

        foreach ($pengumumanList as $p) {
            Announcement::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'judul'          => $p['judul'],
                    'isi_pengumuman' => $p['isi_pengumuman'],
                    'excerpt'        => Str::limit(strip_tags($p['isi_pengumuman']), 180),
                    'views'          => $p['views'],
                    'user_id'        => $userId,
                ]
            );
        }

        // 21. Produk UMKM Desa Kertamukti
        $umkmList = [
            [
                'produk'    => 'Kopi Lereng Talaga Bodas Kertamukti (250gr)',
                'slug'      => 'kopi-lereng-talaga-bodas-kertamukti',
                'pemilik'   => 'Kelompok Tani Kopi Kertamukti',
                'harga'     => 35000,
                'no_hp'     => '81223456701',
                'deskripsi' => '<p>Kopi bubuk dan biji sangrai pilihan yang ditanam di kawasan dataran tinggi lereng timur Gunung Talaga Bodas, Desa Kertamukti, Kecamatan Ciawi. Dipetik dari buah kopi merah matang dan diolah secara higienis oleh kelompok tani lokal sehingga menghasilkan aroma khas pegunungan yang harum dan cita rasa nikmat.</p>',
            ],
            [
                'produk'    => 'Gula Aren Asli Sadapan Murni Dusun Cibuyut (1 Kg)',
                'slug'      => 'gula-aren-asli-sadapan-murni-dusun-cibuyut',
                'pemilik'   => 'UMKM Aren Lestari Cibuyut',
                'harga'     => 28000,
                'no_hp'     => '81223456702',
                'deskripsi' => '<p>Gula aren cetak dan gula semut murni tanpa bahan pengawet maupun campuran gula pasir, hasil sadapan pohon aren alami di Dusun Cibuyut dan Dusun Mulyarasa, Desa Kertamukti. Sangat cocok untuk bahan minuman kopi, jamu tradisional, maupun bumbu masakan Nusantara.</p>',
            ],
            [
                'produk'    => 'Opak & Rangginang Ketan Renyah Dusun Jamilega',
                'slug'      => 'opak-dan-rangginang-ketan-renyah-dusun-jamilega',
                'pemilik'   => 'Ibu Hj. Siti - UMKM Jamilega',
                'harga'     => 20000,
                'no_hp'     => '81223456703',
                'deskripsi' => '<p>Camilan tradisional khas Sunda berupa opak bakar dan rangginang beras ketan pilihan yang diproduksi secara rumahan oleh warga Dusun Jamilega, Desa Kertamukti. Gurih, renyah, dan cocok dijadikan oleh-oleh khas Ciawi Tasikmalaya.</p>',
            ],
            [
                'produk'    => 'Keripik Pisang & Singkong Pedas Manis Kertamukti',
                'slug'      => 'keripik-pisang-dan-singkong-pedas-manis-kertamukti',
                'pemilik'   => 'UMKM Mekar Sari Karangmukti',
                'harga'     => 15000,
                'no_hp'     => '81223456704',
                'deskripsi' => '<p>Olahan keripik pisang tanduk dan singkong hasil panen kebun warga Dusun Karangmukti. Tersedia dalam varian rasa original gurih, manis gula aren, dan balado pedas daun jeruk.</p>',
            ],
            [
                'produk'    => 'Paket Sayuran & Cabai Segar Hortikultura Sukamaju',
                'slug'      => 'paket-sayuran-dan-cabai-segar-hortikultura-sukamaju',
                'pemilik'   => 'Gapoktan Dusun Sukamaju',
                'harga'     => 30000,
                'no_hp'     => '81223456705',
                'deskripsi' => '<p>Hasil panen pertanian hortikultura segar langsung dari lahan subur lereng Gunung Talaga Bodas di Dusun Sukamaju, Desa Kertamukti. Meliputi cabai merah, cabai rawit, tomat, bawang daun, dan sayuran dataran tinggi berkualitas.</p>',
            ],
            [
                'produk'    => 'Kerajinan Anyaman Bambu Khas Dusun Mulyarasa',
                'slug'      => 'kerajinan-anyaman-bambu-khas-dusun-mulyarasa',
                'pemilik'   => 'Pengrajin Bambu Mulyarasa',
                'harga'     => 45000,
                'no_hp'     => '81223456706',
                'deskripsi' => '<p>Produk kerajinan tangan anyaman bambu berkualitas karya warga Dusun Mulyarasa, Desa Kertamukti, meliputi boboko (bakul nasi), tampah/nyiru, besek kemasan ramah lingkungan, dan tudung saji tradisional yang awet dan rapi.</p>',
            ],
        ];

        foreach ($umkmList as $idx => $u) {
            $fotoPath = $this->ensurePlaceholderImage(
                "img-produk/umkm-kertamukti-" . ($idx + 1) . ".jpg",
                Str::limit($u['produk'], 34),
                'Produk UMKM Desa Kertamukti',
                600,
                600,
                [40, 140, 90]
            );

            Umkm::updateOrCreate(
                ['slug' => $u['slug']],
                [
                    'foto'      => $fotoPath,
                    'produk'    => $u['produk'],
                    'pemilik'   => $u['pemilik'],
                    'harga'     => $u['harga'],
                    'no_hp'     => $u['no_hp'],
                    'deskripsi' => $u['deskripsi'],
                    'excerpt'   => Str::limit(strip_tags($u['deskripsi']), 100),
                    'user_id'   => $userId,
                ]
            );
        }

        // 22. APBDes (Transparansi Anggaran Desa Kertamukti)
        $apbdesList = [
            [
                'judul'      => 'Transparansi APBDes Desa Kertamukti Tahun Anggaran 2025',
                'slug'       => 'transparansi-apbdes-desa-kertamukti-tahun-anggaran-2025',
                'keterangan' => '<p>Ringkasan Anggaran Pendapatan dan Belanja Desa (APBDes) Desa Kertamukti, Kecamatan Ciawi, Kabupaten Tasikmalaya Tahun Anggaran 2025:</p><ul><li><strong>Pendapatan Desa:</strong> Bersumber dari Dana Desa (DD), Alokasi Dana Desa (ADD), Bagi Hasil Pajak dan Retribusi Daerah (BHPRD), Bantuan Keuangan Provinsi/Kabupaten, serta Pendapatan Asli Desa (PADes).</li><li><strong>Belanja Desa:</strong> Dialokasikan untuk Bidang Penyelenggaraan Pemerintahan Desa, Bidang Pelaksanaan Pembangunan Desa (Infrastruktur 6 Kedusunan & Pustu), Bidang Pembinaan Kemasyarakatan, Bidang Pemberdayaan Masyarakat (Pertanian & UMKM), serta Bidang Penanggulangan Bencana, Darurat, dan Mendesak Desa.</li></ul>',
            ],
            [
                'judul'      => 'Laporan Realisasi Pelaksanaan APBDes Desa Kertamukti Tahun 2024',
                'slug'       => 'laporan-realisasi-pelaksanaan-apbdes-desa-kertamukti-tahun-2024',
                'keterangan' => '<p>Laporan pertanggungjawaban realisasi pelaksanaan Anggaran Pendapatan dan Belanja Desa (APBDes) Pemerintah Desa Kertamukti Tahun Anggaran 2024 sebagai wujud transparansi dan akuntabilitas pengelolaan keuangan desa kepada masyarakat di 6 kedusunan.</p>',
            ],
        ];

        foreach ($apbdesList as $idx => $apb) {
            $coverPath = $this->ensurePlaceholderImage(
                "apbdes-cover/apbdes-kertamukti-" . ($idx + 1) . ".jpg",
                Str::limit($apb['judul'], 38),
                'Transparansi Keuangan Desa Kertamukti',
                800,
                500,
                [25, 110, 75]
            );

            Anggaran::updateOrCreate(
                ['slug' => $apb['slug']],
                [
                    'judul'      => $apb['judul'],
                    'keterangan' => $apb['keterangan'],
                    'gambar'     => $coverPath,
                    'user_id'    => $userId,
                ]
            );
        }

        // 23. Perpustakaan Digital Desa (Buku)
        $bukuList = [
            [
                'judul'     => 'Panduan Budidaya Kopi & Tanaman Hortikultura Dataran Tinggi',
                'slug'      => 'panduan-budidaya-kopi-dan-hortikultura-dataran-tinggi',
                'deskripsi' => 'Buku panduan praktis bagi petani Desa Kertamukti dalam mengelola lahan pertanian dan perkebunan di kawasan lereng Gunung Talaga Bodas secara produktif dan ramah lingkungan.',
                'link_url'  => 'https://pustaka.setjen.pertanian.go.id/',
            ],
            [
                'judul'     => 'Pedoman Pemberdayaan UMKM & Pemasaran Produk Desa Digital',
                'slug'      => 'pedoman-pemberdayaan-umkm-dan-pemasaran-produk-desa-digital',
                'deskripsi' => 'Panduan peningkatan kualitas kemasan, pendaftaran Nomor Induk Berusaha (NIB), sertifikasi halal, dan strategi pemasaran online bagi pelaku UMKM Desa Kertamukti.',
                'link_url'  => 'https://kemenkopukm.go.id/',
            ],
            [
                'judul'     => 'Buku Saku Keluarga Sehat & Pencegahan Stunting Desa',
                'slug'      => 'buku-saku-keluarga-sehat-dan-pencegahan-stunting-desa',
                'deskripsi' => 'Referensi kesehatan ibu hamil, pemenuhan gizi seimbang balita, dan pola hidup bersih dan sehat (PHBS) untuk kader Posyandu dan keluarga di Desa Kertamukti.',
                'link_url'  => 'https://ayosehat.kemkes.go.id/',
            ],
            [
                'judul'     => 'Regulasi & Undang-Undang Tentang Pemerintahan Desa',
                'slug'      => 'regulasi-dan-undang-undang-tentang-pemerintahan-desa',
                'deskripsi' => 'Kumpulan regulasi penyelenggaraan pemerintahan desa, pengelolaan keuangan desa, dan pemberdayaan lembaga kemasyarakatan desa.',
                'link_url'  => 'https://jdih.kemendesa.go.id/',
            ],
        ];

        foreach ($bukuList as $bk) {
            Buku::updateOrCreate(
                ['slug' => $bk['slug']],
                [
                    'judul'     => $bk['judul'],
                    'deskripsi' => $bk['deskripsi'],
                    'link_url'  => $bk['link_url'],
                    'user_id'   => $userId,
                ]
            );
        }

        // 24. Slider Beranda (3 Slide Utama Desa Kertamukti)
        $sliderList = [
            [
                'judul'     => 'Selamat Datang di Portal Resmi Desa Kertamukti',
                'deskripsi' => 'Kecamatan Ciawi, Kabupaten Tasikmalaya – Mewujudkan Pelayanan Publik Desa yang Transparan, Cepat, dan Akuntabel.',
                'link_btn'  => '/sejarah',
            ],
            [
                'judul'     => 'Pesona Agribisnis Lereng Gunung Talaga Bodas',
                'deskripsi' => 'Membangun Kemandirian Ekonomi Warga Melalui Sektor Pertanian, Perkebunan, dan Produk UMKM Unggulan di 6 Kedusunan.',
                'link_btn'  => '/umkm',
            ],
            [
                'judul'     => 'Sinergi & Gotong Royong Membangun Desa Kertamukti',
                'deskripsi' => 'Bersama Masyarakat Dusun Kertamukti, Cibuyut, Karangmukti, Sukamaju, Jamilega, dan Mulyarasa Menuju Desa Sejahtera.',
                'link_btn'  => '/wilayah',
            ],
        ];

        if (Slider::count() === 0) {
            foreach ($sliderList as $idx => $sl) {
                $sliderImg = $this->ensurePlaceholderImage(
                    "img-slider/slider-kertamukti-" . ($idx + 1) . ".jpg",
                    $sl['judul'],
                    'Desa Kertamukti - Kec. Ciawi, Kab. Tasikmalaya',
                    1400,
                    700,
                    [22, 95, 62]
                );

                Slider::create([
                    'judul'      => $sl['judul'],
                    'deskripsi'  => $sl['deskripsi'],
                    'link_btn'   => $sl['link_btn'],
                    'img_slider' => $sliderImg,
                    'user_id'    => $userId,
                ]);
            }
        }

        // 26. Galeri Kegiatan Desa Kertamukti
        $galleryList = [
            'Pelayanan Administrasi Warga di Kantor Kepala Desa Kertamukti',
            'Kegiatan Musyawarah Desa (Musdes) Bersama BPD dan Tokoh Masyarakat 6 Kedusunan',
            'Pelayanan Kesehatan Warga di Puskesmas Pembantu (Pustu) & Posyandu Desa Kertamukti',
            'Panen Hasil Pertanian Hortikultura & Kopi Lereng Gunung Talaga Bodas',
            'Kerja Bakti Gotong Royong Pemeliharaan Jalan & Irigasi Desa Kertamukti',
            'Pemberdayaan Ibu-Ibu TP-PKK dan Pelaku UMKM Olahan Pangan Lokal',
        ];

        if (Gallery::count() === 0) {
            foreach ($galleryList as $idx => $ket) {
                $galImg = $this->ensurePlaceholderImage(
                    "img-gallery/galeri-kertamukti-" . ($idx + 1) . ".jpg",
                    'Dokumentasi Desa Kertamukti #' . ($idx + 1),
                    Str::limit($ket, 48),
                    800,
                    600,
                    [35, 125, 85]
                );

                Gallery::create([
                    'gambar'     => $galImg,
                    'keterangan' => $ket,
                    'user_id'    => $userId,
                ]);
            }
        }
    }

    /**
     * Buat gambar placeholder menggunakan PHP GD jika file belum ada di storage/app/public.
     */
    protected function ensurePlaceholderImage(
        string $relativePath,
        string $title,
        string $subtitle,
        int $width = 800,
        int $height = 500,
        array $baseRgb = [34, 139, 94]
    ): string {
        $disk = Storage::disk('public');
        if ($disk->exists($relativePath)) {
            return $relativePath;
        }

        $fullPath = storage_path('app/public/' . $relativePath);
        $dir = dirname($fullPath);
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        if (function_exists('imagecreatetruecolor')) {
            $img = imagecreatetruecolor($width, $height);

            // Gradient background
            [$rBase, $gBase, $bBase] = $baseRgb;
            for ($y = 0; $y < $height; $y++) {
                $ratio = $y / max(1, $height);
                $r = (int) min(255, $rBase + ($ratio * 45));
                $g = (int) min(255, $gBase + ($ratio * 55));
                $b = (int) min(255, $bBase + ($ratio * 40));
                $lineColor = imagecolorallocate($img, $r, $g, $b);
                imageline($img, 0, $y, $width, $y, $lineColor);
            }

            // Decorative border & accent
            $white = imagecolorallocate($img, 255, 255, 255);
            $gold = imagecolorallocate($img, 247, 247, 150);
            imagerectangle($img, 15, 15, $width - 16, $height - 16, $gold);
            imagerectangle($img, 18, 18, $width - 19, $height - 19, $white);

            // Center text using built-in GD font
            $font = 5;
            $fontW = imagefontwidth($font);
            $fontH = imagefontheight($font);

            $cleanTitle = Str::upper(Str::ascii(Str::limit($title, 42, '')));
            $cleanSub = Str::ascii(Str::limit($subtitle, 52, ''));
            $footer = 'DESA KERTAMUKTI - KEC. CIAWI - KAB. TASIKMALAYA';

            $xTitle = (int) max(25, ($width - (strlen($cleanTitle) * $fontW)) / 2);
            $yTitle = (int) (($height / 2) - $fontH - 6);
            imagestring($img, $font, $xTitle, $yTitle, $cleanTitle, $white);

            $xSub = (int) max(25, ($width - (strlen($cleanSub) * $fontW)) / 2);
            $ySub = (int) (($height / 2) + 6);
            imagestring($img, 4, $xSub, $ySub, $cleanSub, $gold);

            $xFoot = (int) max(25, ($width - (strlen($footer) * imagefontwidth(3))) / 2);
            imagestring($img, 3, $xFoot, $height - 42, $footer, $white);

            if (str_ends_with(strtolower($relativePath), '.png')) {
                @imagepng($img, $fullPath);
            } else {
                @imagejpeg($img, $fullPath, 88);
            }
            @imagedestroy($img);
        }

        return $relativePath;
    }

    /**
     * Pastikan seluruh tabel dan kolom yang dibutuhkan oleh Model/Controller/View tersedia.
     */
    public function syncDatabaseSchema(): void
    {
        // 0. users
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'foto')) {
                    $table->string('foto')->nullable();
                }
            });
            $this->makeColumnsNullable('users', ['foto' => 'VARCHAR(255)']);
        }

        // 1. situses
        if (!Schema::hasTable('situses')) {
            Schema::create('situses', function (Blueprint $table) {
                $table->id();
                $table->string('logo')->nullable();
                $table->string('nm_desa')->nullable();
                $table->string('kecamatan')->nullable();
                $table->string('kabupaten')->nullable();
                $table->string('provinsi')->nullable();
                $table->string('kode_pos')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('situses', function (Blueprint $table) {
                foreach (['logo', 'nm_desa', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos'] as $col) {
                    if (!Schema::hasColumn('situses', $col)) {
                        $table->string($col)->nullable();
                    }
                }
                if (!Schema::hasColumn('situses', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
        }

        // 2. kontaks
        if (Schema::hasTable('kontaks')) {
            Schema::table('kontaks', function (Blueprint $table) {
                if (!Schema::hasColumn('kontaks', 'lokasi')) {
                    $table->text('lokasi')->nullable();
                }
                if (!Schema::hasColumn('kontaks', 'email')) {
                    $table->string('email')->nullable();
                }
                if (!Schema::hasColumn('kontaks', 'no_hp')) {
                    $table->string('no_hp')->nullable();
                }
                if (!Schema::hasColumn('kontaks', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('kontaks', ['nama' => 'VARCHAR(255)', 'pesan' => 'TEXT', 'subjek' => 'VARCHAR(255)']);
        }

        // 3. video_profils
        if (Schema::hasTable('video_profils')) {
            Schema::table('video_profils', function (Blueprint $table) {
                if (!Schema::hasColumn('video_profils', 'url_video')) {
                    $table->string('url_video')->nullable();
                }
                if (!Schema::hasColumn('video_profils', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('video_profils', ['url' => 'VARCHAR(255)', 'judul' => 'VARCHAR(255)']);
        }

        // 4. sejarahs
        if (Schema::hasTable('sejarahs')) {
            Schema::table('sejarahs', function (Blueprint $table) {
                if (!Schema::hasColumn('sejarahs', 'judul')) {
                    $table->string('judul')->nullable();
                }
                if (!Schema::hasColumn('sejarahs', 'body')) {
                    $table->longText('body')->nullable();
                }
                if (!Schema::hasColumn('sejarahs', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('sejarahs', ['isi' => 'LONGTEXT', 'foto' => 'VARCHAR(255)']);
        }

        // 5. visi_misis
        if (Schema::hasTable('visi_misis')) {
            Schema::table('visi_misis', function (Blueprint $table) {
                if (!Schema::hasColumn('visi_misis', 'visi')) {
                    $table->longText('visi')->nullable();
                }
                if (!Schema::hasColumn('visi_misis', 'misi')) {
                    $table->longText('misi')->nullable();
                }
                if (!Schema::hasColumn('visi_misis', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
        }

        // 6. wilayahs
        if (Schema::hasTable('wilayahs')) {
            Schema::table('wilayahs', function (Blueprint $table) {
                if (!Schema::hasColumn('wilayahs', 'judul')) {
                    $table->string('judul')->nullable();
                }
                if (!Schema::hasColumn('wilayahs', 'body')) {
                    $table->longText('body')->nullable();
                }
                if (!Schema::hasColumn('wilayahs', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('wilayahs', ['nama' => 'VARCHAR(255)', 'jenis' => 'VARCHAR(50)']);
        }

        // 7. petas
        if (Schema::hasTable('petas')) {
            Schema::table('petas', function (Blueprint $table) {
                if (!Schema::hasColumn('petas', 'judul')) {
                    $table->string('judul')->nullable();
                }
                if (!Schema::hasColumn('petas', 'alamat')) {
                    $table->text('alamat')->nullable();
                }
                if (!Schema::hasColumn('petas', 'body')) {
                    $table->longText('body')->nullable();
                }
                if (!Schema::hasColumn('petas', 'latitude')) {
                    $table->string('latitude', 50)->nullable();
                }
                if (!Schema::hasColumn('petas', 'longitude')) {
                    $table->string('longitude', 50)->nullable();
                }
                if (!Schema::hasColumn('petas', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('petas', ['nama' => 'VARCHAR(255)', 'tipe' => 'VARCHAR(50)']);
        }

        // 8. agamas
        if (Schema::hasTable('agamas')) {
            Schema::table('agamas', function (Blueprint $table) {
                if (!Schema::hasColumn('agamas', 'agama')) {
                    $table->string('agama')->nullable();
                }
                if (!Schema::hasColumn('agamas', 'penganut')) {
                    $table->integer('penganut')->default(0);
                }
                if (!Schema::hasColumn('agamas', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('agamas', ['nama' => 'VARCHAR(255)']);
        }

        // 9. jenis_kelamins
        if (Schema::hasTable('jenis_kelamins')) {
            Schema::table('jenis_kelamins', function (Blueprint $table) {
                if (!Schema::hasColumn('jenis_kelamins', 'jenis_kelamin')) {
                    $table->string('jenis_kelamin')->nullable();
                }
                if (!Schema::hasColumn('jenis_kelamins', 'jumlah')) {
                    $table->integer('jumlah')->default(0);
                }
                if (!Schema::hasColumn('jenis_kelamins', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('jenis_kelamins', ['nama' => 'VARCHAR(255)']);
        }

        // 10. pekerjaans
        if (Schema::hasTable('pekerjaans')) {
            Schema::table('pekerjaans', function (Blueprint $table) {
                if (!Schema::hasColumn('pekerjaans', 'pekerjaan')) {
                    $table->string('pekerjaan')->nullable();
                }
                if (!Schema::hasColumn('pekerjaans', 'jumlah')) {
                    $table->integer('jumlah')->default(0);
                }
                if (!Schema::hasColumn('pekerjaans', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('pekerjaans', ['nama' => 'VARCHAR(255)']);
        }

        // 11. perangkat_desas
        if (Schema::hasTable('perangkat_desas')) {
            Schema::table('perangkat_desas', function (Blueprint $table) {
                if (!Schema::hasColumn('perangkat_desas', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
        }

        // 12. layanans
        if (Schema::hasTable('layanans')) {
            Schema::table('layanans', function (Blueprint $table) {
                if (!Schema::hasColumn('layanans', 'layanan')) {
                    $table->string('layanan')->nullable();
                }
                if (!Schema::hasColumn('layanans', 'persyaratan')) {
                    $table->longText('persyaratan')->nullable();
                }
                if (!Schema::hasColumn('layanans', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('layanans', ['nama' => 'VARCHAR(255)']);
        }

        // 13. post_statuses
        if (Schema::hasTable('post_statuses')) {
            Schema::table('post_statuses', function (Blueprint $table) {
                if (!Schema::hasColumn('post_statuses', 'status')) {
                    $table->string('status')->nullable();
                }
            });
            $this->makeColumnsNullable('post_statuses', ['name' => 'VARCHAR(255)', 'slug' => 'VARCHAR(255)']);
        }

        // 14. kategoris
        if (Schema::hasTable('kategoris')) {
            Schema::table('kategoris', function (Blueprint $table) {
                if (!Schema::hasColumn('kategoris', 'kategori')) {
                    $table->string('kategori')->nullable();
                }
                if (!Schema::hasColumn('kategoris', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('kategoris', ['nama' => 'VARCHAR(255)']);
        }

        // 15. beritas
        if (Schema::hasTable('beritas')) {
            Schema::table('beritas', function (Blueprint $table) {
                if (!Schema::hasColumn('beritas', 'body')) {
                    $table->longText('body')->nullable();
                }
                if (!Schema::hasColumn('beritas', 'gambar')) {
                    $table->string('gambar')->nullable();
                }
                if (!Schema::hasColumn('beritas', 'status_id')) {
                    $table->unsignedBigInteger('status_id')->default(2);
                }
                if (!Schema::hasColumn('beritas', 'kategori_id')) {
                    $table->unsignedBigInteger('kategori_id')->nullable();
                }
                if (!Schema::hasColumn('beritas', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
                if (!Schema::hasColumn('beritas', 'views')) {
                    $table->unsignedBigInteger('views')->default(0);
                }
            });
        }

        // 16. announcements
        if (Schema::hasTable('announcements')) {
            Schema::table('announcements', function (Blueprint $table) {
                if (!Schema::hasColumn('announcements', 'isi_pengumuman')) {
                    $table->longText('isi_pengumuman')->nullable();
                }
                if (!Schema::hasColumn('announcements', 'excerpt')) {
                    $table->text('excerpt')->nullable();
                }
                if (!Schema::hasColumn('announcements', 'views')) {
                    $table->unsignedBigInteger('views')->default(0);
                }
                if (!Schema::hasColumn('announcements', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
        }

        // 17. umkms
        if (Schema::hasTable('umkms')) {
            Schema::table('umkms', function (Blueprint $table) {
                if (!Schema::hasColumn('umkms', 'produk')) {
                    $table->string('produk')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'slug')) {
                    $table->string('slug')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'harga')) {
                    $table->decimal('harga', 15, 2)->default(0);
                }
                if (!Schema::hasColumn('umkms', 'no_hp')) {
                    $table->string('no_hp')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'pemilik')) {
                    $table->string('pemilik')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'deskripsi')) {
                    $table->longText('deskripsi')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'excerpt')) {
                    $table->text('excerpt')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'foto')) {
                    $table->string('foto')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('umkms', ['nama_usaha' => 'VARCHAR(255)']);
        }

        // 18. anggarans
        if (Schema::hasTable('anggarans')) {
            Schema::table('anggarans', function (Blueprint $table) {
                if (!Schema::hasColumn('anggarans', 'judul')) {
                    $table->string('judul')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'slug')) {
                    $table->string('slug')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'keterangan')) {
                    $table->longText('keterangan')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'gambar')) {
                    $table->string('gambar')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'dokumen_path')) {
                    $table->string('dokumen_path')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'dokumen_original')) {
                    $table->string('dokumen_original')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'dokumen_mime')) {
                    $table->string('dokumen_mime')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'dokumen_size')) {
                    $table->unsignedBigInteger('dokumen_size')->nullable();
                }
                if (!Schema::hasColumn('anggarans', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('anggarans', [
                'tahun'         => 'YEAR',
                'jenis'         => 'VARCHAR(50)',
                'nama_kegiatan' => 'VARCHAR(255)',
                'nominal'       => 'DECIMAL(18,2)',
            ]);
        }

        // 19. sliders
        if (Schema::hasTable('sliders')) {
            Schema::table('sliders', function (Blueprint $table) {
                if (!Schema::hasColumn('sliders', 'judul')) {
                    $table->string('judul')->nullable();
                }
                if (!Schema::hasColumn('sliders', 'deskripsi')) {
                    $table->text('deskripsi')->nullable();
                }
                if (!Schema::hasColumn('sliders', 'link_btn')) {
                    $table->string('link_btn')->nullable();
                }
                if (!Schema::hasColumn('sliders', 'img_slider')) {
                    $table->string('img_slider')->nullable();
                }
                if (!Schema::hasColumn('sliders', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('sliders', ['title' => 'VARCHAR(255)', 'image_path' => 'VARCHAR(255)']);
        }

        // 20. galleries
        if (Schema::hasTable('galleries')) {
            Schema::table('galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('galleries', 'gambar')) {
                    $table->string('gambar')->nullable();
                }
                if (!Schema::hasColumn('galleries', 'keterangan')) {
                    $table->text('keterangan')->nullable();
                }
                if (!Schema::hasColumn('galleries', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
            });
            $this->makeColumnsNullable('galleries', ['title' => 'VARCHAR(255)', 'path' => 'VARCHAR(255)']);
        }

        // 21. lkds
        if (Schema::hasTable('lkds')) {
            Schema::table('lkds', function (Blueprint $table) {
                if (!Schema::hasColumn('lkds', 'deskripsi')) {
                    $table->longText('deskripsi')->nullable();
                }
                if (!Schema::hasColumn('lkds', 'published')) {
                    $table->boolean('published')->default(true);
                }
                if (!Schema::hasColumn('lkds', 'created_by')) {
                    $table->unsignedBigInteger('created_by')->nullable();
                }
            });
        }

        Schema::dropIfExists('blts');
    }

    /**
     * Ubah kolom legacy yang NOT NULL menjadi NULLABLE agar tidak mengganggu insert model.
     */
    protected function makeColumnsNullable(string $table, array $columns): void
    {
        foreach ($columns as $col => $type) {
            if (Schema::hasColumn($table, $col)) {
                try {
                    DB::statement("ALTER TABLE `{$table}` MODIFY COLUMN `{$col}` {$type} NULL");
                } catch (\Throwable $e) {
                    // Abaikan jika sudah nullable atau tipe berbeda
                }
            }
        }
    }
}
