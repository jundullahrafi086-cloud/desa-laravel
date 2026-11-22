<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BltController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\kategoriController; // (biarkan sesuai nama class yang kamu pakai)
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\LkdPublicController;
use App\Http\Controllers\AdminLkdController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\PetaDesaController;
use App\Http\Controllers\PerpusController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\GalleryController;       // publik
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AnggaranController;      // publik APBDes
use App\Http\Controllers\CommentController;
// use App\Http\Controllers\ProkerKknUserController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\Admin\LkdController;
use App\Http\Controllers\Admin\LkdMemberController;
use App\Http\Controllers\AdminBltController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminWilayahController;
use App\Http\Controllers\AdminSejarahController;
use App\Http\Controllers\AdminVisiMisiController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminPerangkatDesaController;
use App\Http\Controllers\AdminPetaController;
use App\Http\Controllers\AdminUmkmController;
use App\Http\Controllers\AdminKontakController;
use App\Http\Controllers\AdminLayananController;
// ⬇️ Untuk menghindari error missing import, bagian Gallery Admin akan pakai FQCN langsung di route.
use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\AdminAnggaranController;
use App\Http\Controllers\AdminPekerjaanController;
use App\Http\Controllers\AdminPerpusController;
use App\Http\Controllers\AdminJenisKelaminController;
use App\Http\Controllers\AdminAgamaController;
use App\Http\Controllers\AdminVideoProfileController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminIdentitasSitusController;
use App\Http\Controllers\AdminKepalaDesaController;
use App\Http\Controllers\AdminGalleryGroupController;
use App\Http\Controllers\AdminGalleryController;
// use App\Http\Controllers\AdminProkerKknController;
/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

/* =====================
 * HALAMAN PUBLIK
 * ===================== */
Route::get('/', [BerandaController::class, 'index'])->name('home');

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{beritas:slug}', [BeritaController::class, 'berita']);
Route::post('/berita/{slug}', [CommentController::class, 'comment']);
Route::post('/berita/{slug}/reply', [CommentController::class, 'commentReply']);
Route::get('/perpus', [PerpusController::class, 'index'])->name('perpus.index');
// (opsional) detail buku:
Route::get('/perpus/{slug}', [PerpusController::class, 'show'])->name('perpus.show');

// LKD (Publik)
Route::get('/lkd', [LkdPublicController::class, 'index'])->name('lkd.index');
Route::get('/lkd/{lkd:slug}', [LkdPublicController::class, 'show'])->name('lkd.show');
// Route::get('/proker-kkn', [ProkerKknUserController::class, 'index'])->name('proker-kkn.index');
// Route::get('/proker-kkn/{slug}', [ProkerKknUserController::class, 'show'])->name('proker-kkn.show');
// Route::get('/proker-kkn/kategori/{kategori}', [ProkerKknUserController::class, 'byCategory'])->name('proker-kkn.category');


Route::get('/kategori/{kategori:slug}', [kategoriController::class, 'index']);
Route::get('/wilayah', [WilayahController::class, 'index']);
Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah.index');
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index']);
Route::get('/data-desa', [DataDesaController::class, 'index']);
Route::get('/peta-desa', [PetaDesaController::class, 'index']);
Route::get('/umkm', [UmkmController::class, 'index']);
Route::get('/umkm/{umkm:slug}', [UmkmController::class, 'detail']);
Route::get('/kontak', [KontakController::class, 'index']);
Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/blt', [BltController::class, 'index'])->name('blt.public');
Route::post('/blt/pilih-metode', [BltController::class, 'updateMetode'])->name('blt.pilih-metode');


/* GALERI (Publik) */
Route::get('/gallery', [GalleryController::class, 'index']);
/* Pengumuman (Publik) */
Route::get('/pengumuman', [AnnouncementController::class, 'index']);
Route::get('/pengumuman/{pengumuman:slug}', [AnnouncementController::class, 'detail'])->name('pengumuman.show');

/* APBDes (Publik) */
Route::get('/apbdesa', [\App\Http\Controllers\AnggaranController::class, 'index'])->name('apbdesa.index');
Route::get('/apbdesa/{anggaran:slug}', [\App\Http\Controllers\AnggaranController::class, 'detail'])->name('apbdesa.detail');

// BARU: open & download dokumen
Route::get('/apbdesa/{anggaran:slug}/open', [AnggaranController::class, 'open'])->name('apbdes.open');
Route::get('/apbdesa/{anggaran:slug}/download', [AnggaranController::class, 'download'])->name('apbdesa.download');
// Fallback route untuk melayani file storage jika symlink tidak aktif di hosting
Route::get('/storage/{path}', function ($path) {
    // Bersihkan dan normalisasi path (tangani double slashes jika ada)
    $normalized = preg_replace('#/+#', '/', ltrim($path, '/'));

    $candidates = [
        storage_path('app/public/' . $normalized),
        storage_path('app/public/' . $path),
    ];

    $filePath = null;
    foreach ($candidates as $candidate) {
        if (file_exists($candidate) && is_file($candidate)) {
            $filePath = $candidate;
            break;
        }
    }

    if (!$filePath) {
        abort(404);
    }

    // Keamanan: pastikan path berada di dalam direktori storage/app/public
    $basePath = realpath(storage_path('app/public'));
    $realTarget = realpath($filePath);
    if ($basePath && $realTarget && !str_starts_with($realTarget, $basePath)) {
        abort(403);
    }

    $mimeType = @mime_content_type($filePath) ?: 'application/octet-stream';

    return response()->file($filePath, [
        'Content-Type'  => $mimeType,
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('path', '.*');

// Route bantuan untuk membuat storage link di hosting via browser
Route::get('/linkstorage', function () {
    $link = public_path('storage');
    if (is_link($link) || file_exists($link)) {
        if (is_link($link)) {
            @unlink($link);
        }
    }

    if (!function_exists('symlink')) {
        return '<div style="font-family:sans-serif;padding:30px;max-width:650px;margin:40px auto;border:1px solid #fed7aa;background:#fffbeb;border-radius:8px;">'
            . '<h2 style="color:#d97706;margin-top:0;">ℹ️ Informasi Konfigurasi Storage</h2>'
            . '<p>Fungsi PHP <code>symlink()</code> dinonaktifkan oleh server Hostinger. <b>Namun jangan khawatir!</b> Rute internal Laravel <code>/storage/...</code> telah aktif untuk menampilkan seluruh gambar secara otomatis.</p>'
            . '<p style="color:#16a34a;font-weight:bold;">Gambar Anda sudah dapat tampil normal sekarang.</p>'
            . '<hr style="border:none;border-top:1px solid #fde68a;margin:20px 0;">'
            . '<p><b>(Opsional) Jika ingin mengaktifkan symlink asli di Hostinger:</b></p>'
            . '<ol style="line-height:1.6;">'
            . '<li>Buka <b>hPanel Hostinger</b> &gt; <b>Websites</b> &gt; Kelola domain Anda.</li>'
            . '<li>Pilih menu <b>PHP Configuration</b> &gt; tab <b>PHP Functions</b> / <b>Disable Functions</b>.</li>'
            . '<li>Hapus <code>symlink</code> dari daftar fungsi yang dinonaktifkan, lalu klik <b>Save</b>.</li>'
            . '<li>Refresh halaman ini (<code>/linkstorage</code>).</li>'
            . '</ol>'
            . '<br><a href="/" style="display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;text-decoration:none;border-radius:5px;font-weight:bold;">Kembali ke Beranda</a>'
            . '</div>';
    }

    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return '<div style="font-family:sans-serif;padding:30px;max-width:650px;margin:40px auto;border:1px solid #bbf7d0;background:#f0fdf4;border-radius:8px;">'
            . '<h2 style="color:#16a34a;margin-top:0;">✅ Sukses!</h2>'
            . '<p>Storage link (symlink) telah berhasil dibuat:</p>'
            . '<pre style="background:#e2e8f0;padding:10px;border-radius:4px;">' . \Illuminate\Support\Facades\Artisan::output() . '</pre>'
            . '<br><a href="/" style="display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;text-decoration:none;border-radius:5px;font-weight:bold;">Kembali ke Beranda</a>'
            . '</div>';
    } catch (\Throwable $e) {
        return '<div style="font-family:sans-serif;padding:30px;max-width:650px;margin:40px auto;border:1px solid #fecaca;background:#fef2f2;border-radius:8px;">'
            . '<h2 style="color:#dc2626;margin-top:0;">Gagal</h2>'
            . '<p>' . htmlspecialchars($e->getMessage()) . '</p>'
            . '<p><i>Namun jangan khawatir, gambar tetap akan ditampilkan melalui rute internal Laravel.</i></p>'
            . '<br><a href="/" style="display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;text-decoration:none;border-radius:5px;font-weight:bold;">Kembali ke Beranda</a>'
            . '</div>';
    }
});

/* =====================
 * AUTH & DASHBOARD
 * ===================== */
Auth::routes();
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

/* =====================
 * ADMIN AREA (auth)
 * ===================== */
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));

    /* Slider */
    Route::resource('slider', AdminSliderController::class);

    /* Berita */
    Route::get('berita/slug', [AdminBeritaController::class, 'slug']);
    Route::resource('berita', AdminBeritaController::class);

    Route::get('perpus/slug', [AdminPerpusController::class, 'slug'])->name('admin.perpus.slug');

    // Resource (pakai parameter khusus agar tidak bentrok nama)
    Route::resource('perpus', AdminPerpusController::class)
        ->parameters(['perpus' => 'perpu'])
        ->names('admin.perpus');

    /* Kategori */
    Route::get('kategori/slug', [AdminKategoriController::class, 'slug']);
    Route::resource('kategori', AdminKategoriController::class);

    /* Wilayah */
    Route::get('wilayah', [AdminWilayahController::class, 'index']);
    Route::get('wilayah/{id}/edit', [AdminWilayahController::class, 'edit']);
    Route::put('wilayah/{id}', [AdminWilayahController::class, 'update']);

    /* Sejarah */
    Route::get('sejarah', [AdminSejarahController::class, 'index']);
    Route::get('sejarah/{id}/edit', [AdminSejarahController::class, 'edit']);
    Route::put('sejarah/{id}', [AdminSejarahController::class, 'update']);

    /* Kepala Desa (Periode) */
    Route::resource('kepala-desa', AdminKepalaDesaController::class)->names([
        'index'   => 'kepala-desa.index',
        'create'  => 'kepala-desa.create',
        'store'   => 'kepala-desa.store',
        'edit'    => 'kepala-desa.edit',
        'update'  => 'kepala-desa.update',
        'destroy' => 'kepala-desa.destroy',
    ]);

    // ENDPOINT BANTUAN (AJAX ONLY)

Route::resource('lkd', LkdController::class)->names('admin.lkd');

// Nested members (lebih eksplisit & aman)
Route::post('lkd/{lkd}/members',            [LkdMemberController::class, 'store'])->name('admin.lkd.members.store');
Route::put('lkd/{lkd}/members/{member}',    [LkdMemberController::class, 'update'])->name('admin.lkd.members.update');
Route::delete('lkd/{lkd}/members/{member}', [LkdMemberController::class, 'destroy'])->name('admin.lkd.members.destroy');


    /* Komentar */
    Route::get('komentar', [AdminCommentController::class, 'index'])->name('komentar.index');
    Route::delete('komentar/{id}', [AdminCommentController::class, 'destroy'])->name('komentar.destroy');

    /* Visi Misi */
    Route::get('visi-misi', [AdminVisiMisiController::class, 'index']);
    Route::get('visi-misi/{id}/edit', [AdminVisiMisiController::class, 'edit']);
    Route::put('visi-misi/{id}', [AdminVisiMisiController::class, 'update']);

    /* Perangkat Desa */
    Route::resource('perangkat-desa', AdminPerangkatDesaController::class);

    /* Peta Desa */
    Route::get('peta-desa', [AdminPetaController::class, 'index']);
    Route::put('peta-desa/{id}', [AdminPetaController::class, 'update']);

    /* Agama */
    Route::resource('agama', AdminAgamaController::class);


    /* Jenis Kelamin */
    Route::resource('jenis-kelamin', AdminJenisKelaminController::class);

    /* Pekerjaan */
    Route::resource('pekerjaan', AdminPekerjaanController::class);

    /* Blt */
    Route::get('blt/export', [AdminBltController::class, 'export'])->name('blt.export');
    Route::post('blt/import', [AdminBltController::class, 'import'])->name('blt.import');
    Route::resource('blt', AdminBltController::class);


    /* UMKM */
    Route::get('umkm/slug', [AdminUmkmController::class, 'slug']);
    Route::resource('umkm', AdminUmkmController::class);

    /* Kontak */
    Route::get('kontak', [AdminKontakController::class, 'index']);
    Route::put('kontak/{id}', [AdminKontakController::class, 'update']);

    /* Video Profile */
    Route::get('video-profile', [AdminVideoProfileController::class, 'index']);
    Route::put('video-profile/{id}', [AdminVideoProfileController::class, 'update']);

    /* Identitas Situs */
    Route::get('identitas-situs', [AdminIdentitasSitusController::class, 'index']);
    Route::put('identitas-situs/{id}', [AdminIdentitasSitusController::class, 'update']);

    /* Profil Admin */
    Route::get('profil', [AdminProfilController::class, 'index']);
    Route::put('profil/{id}', [AdminProfilController::class, 'update']);
    Route::put('profil', [AdminProfilController::class, 'changePassword']); // atau POST ke 'profil/password'

    /* Layanan */
    Route::resource('layanan', AdminLayananController::class);

    /* =====================
     * GALLERY (ADMIN) — gunakan FQCN agar tidak error missing import
     * ===================== */

   Route::resource('gallery', AdminGalleryController::class);

    /* =====================
     * APBDes (ADMIN)
     * ===================== */
    Route::get('apbdes/slug', [AdminAnggaranController::class, 'slug'])->name('apbdes.slug');
    Route::resource('apbdes', AdminAnggaranController::class);

    Route::get('pengumuman/slug', [AdminAnnouncementController::class, 'slug'])
    ->name('admin.pengumuman.slug');

    // Route::resource('proker-kkn', AdminProkerKknController::class)->names('admin.proker-kkn');
// Route::get('proker-kkn/slug', [AdminProkerKknController::class, 'slug'])->name('admin.proker-kkn.slug');

// resource CRUD
     Route::resource('pengumuman', AdminAnnouncementController::class)
    ->names('admin.pengumuman');

});
