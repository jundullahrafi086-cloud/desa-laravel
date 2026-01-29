<?php

namespace App\Http\Controllers;

use App\Models\Blt;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BltExport;
use App\Imports\BltImport;

class AdminBltController extends Controller
{
    public function index()
    {
        return view('admin.blt.index', [
            'blts' => Blt::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.blt.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|size:16|unique:blts',
            'kk' => 'required|size:16',
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'metode_pencairan'=>'',
            'tahun' => 'required|digits:4',
            'status' => 'required'
        ]);

        Blt::create($validatedData);
        return redirect('/admin/blt')->with('success', 'Data BLT berhasil ditambahkan!');
    }

    public function edit(Blt $blt)
    {
        return view('admin.blt.edit', compact('blt'));
    }

    public function update(Request $request, Blt $blt)
    {
        $rules = [
            'kk' => 'required|size:16',
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'metode_pencairan'=>'',
            'tahun' => 'required|digits:4',
            'status' => 'required'
        ];

        if ($request->nik != $blt->nik) {
            $rules['nik'] = 'required|size:16|unique:blts';
        }

        $validatedData = $request->validate($rules);
        $blt->update($validatedData);

        return redirect('/admin/blt')->with('success', 'Data BLT berhasil diperbarui!');
    }

    public function destroy(Blt $blt)
    {
        $blt->delete();
        return redirect('/admin/blt')->with('success', 'Data BLT berhasil dihapus!');
    }

    // Fungsi Placeholder untuk Export/Import
    public function export() {
        // Logika Excel Export (Maatwebsite) di sini
        return Excel::download(new BltExport, 'data-penerima-blt.xlsx');
    }

    public function import(Request $request) {
        // Logika Excel Import di sini
       $request->validate([
        'file' => 'required|mimes:xlsx,xls'
        ]);

        // Untuk import, Anda bisa membuat file Import (php artisan make:import BltImport)
        // Atau jika ingin cepat menggunakan ToModel:
        Excel::import(new \App\Imports\BltImport, $request->file('file'));

        return back()->with('success', 'Data BLT Berhasil Di-import!');
        }
}
