<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci (maks 50 karakter biar ringan)
        $q = trim((string) $request->get('q', ''));
        if (mb_strlen($q) > 50) {
            $q = mb_substr($q, 0, 50);
        }

        $umkms = Umkm::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('produk', 'like', "%{$q}%")
                       
                      
                       ->orWhere('deskripsi', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(9)
            ->appends($request->query()); // bawa ?q ke pagination

        return view('umkm.index', compact('umkms'));
    }

    public function detail($slug)
    {
        $umkm = Umkm::where('slug', $slug)->firstOrFail();
        return view('umkm.detail', compact('umkm'));
    }
}
