<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        $nm_desa = 'Nama Desa'; // Ganti dengan nama desa Anda atau ambil dari setting
        $perangkatDesa = PerangkatDesa::orderBy('id')->paginate(8);
        
        return view('perangkat-desa.index', compact('perangkatDesa', 'nm_desa'));
    }
}