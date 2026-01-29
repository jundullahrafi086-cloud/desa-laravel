<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // <— tambah
use Symfony\Component\HttpFoundation\StreamedResponse; // <— opsional, untuk tipe hint

class AnggaranController extends Controller
{
    /**
     * Halaman daftar APBDes (publik)
     * URL: /apbdesa
     */
    public function index()
    {
        $items = Anggaran::select('id','judul','slug','keterangan','gambar','dokumen_path','dokumen_original','created_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        $items->getCollection()->transform(function ($row) {
            $row->excerpt = Str::limit(trim(strip_tags($row->keterangan ?? '')), 140);
            return $row;
        });

        return view('apbdes.index', compact('items'));
    }

    /**
     * Halaman detail APBDes (publik)
     * URL: /apbdesa/{anggaran:slug}
     */
    public function detail(Anggaran $anggaran)
    {
        $related = Anggaran::select('id','judul','slug','gambar','created_at')
            ->where('id', '!=', $anggaran->id)
            ->latest()
            ->limit(6)
            ->get();

        return view('apbdes.detail', compact('anggaran', 'related'));
    }

    /**
     * Buka/preview dokumen di browser (Content-Disposition: inline)
     * Route name: apbdes.open
     * URL: /apbdesa/{anggaran:slug}/open
     */
    public function open(Anggaran $anggaran)
    {
        $disk = 'public'; // ganti jika file Anda disimpan di disk lain (mis. s3)
        $path = $anggaran->dokumen_path;

        if (!$path || !Storage::disk($disk)->exists($path)) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        $mime = Storage::disk($disk)->mimeType($path) ?? 'application/octet-stream';
        $filename = $anggaran->dokumen_original ?: basename($path);
        $stream = Storage::disk($disk)->readStream($path);

        return response()->stream(function () use ($stream) {
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, [
            'Content-Type'        => $mime,
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
            'Cache-Control'       => 'public, max-age=604800, immutable',
        ]);
    }

    /**
     * Unduh dokumen (Content-Disposition: attachment)
     * Route name: apbdes.download
     * URL: /apbdesa/{anggaran:slug}/download
     */
    public function download(Anggaran $anggaran)
    {
        $disk = 'public'; // ganti jika perlu
        $path = $anggaran->dokumen_path;

        if (!$path || !Storage::disk($disk)->exists($path)) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        $filename = $anggaran->dokumen_original ?: basename($path);

        // Cara paling aman lintas disk (local/s3/etc.)
        return Storage::disk($disk)->download($path, $filename);
    }
}
