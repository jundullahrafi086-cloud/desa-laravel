<?php

namespace App\Http\Controllers;

use App\Models\Lkd;

class LkdPublicController extends Controller
{
    public function index()
    {
        $items = Lkd::published()->latest()->paginate(9);
        return view('lkd.index', compact('items'));
    }

    public function show($slug)
    {
        $lkd = Lkd::where('slug', $slug)->firstOrFail();
        
        // Mengambil anggota dengan pagination (9 per halaman)
        $members = $lkd->members()
                  ->orderBy('order_no')
                  ->orderBy('nama')
                  ->paginate(9);
        
        // Kirim kedua variabel ke view
        return view('lkd.show', compact('lkd', 'members'));
    }

}
