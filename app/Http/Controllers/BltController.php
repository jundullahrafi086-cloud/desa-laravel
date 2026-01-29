<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Blt;
use Illuminate\Http\Request;

class BltController extends Controller
{
    public function index(Request $request)
    {
        $hasil = null;
        $searchPerformed = false;

        if ($request->has('nik') && $request->nik != '') {
            // Validasi sederhana agar input yang masuk benar-benar NIK
            $request->validate([
                'nik' => 'required|numeric|digits:16',
            ], [
                'nik.digits' => 'NIK harus berjumlah 16 digit.',
                'nik.numeric' => 'NIK harus berupa angka.',
            ]);

            $hasil = Blt::where('nik', $request->nik)->first();
            $searchPerformed = true;
        }

        return view('blt.index', [
            'title' => 'Cek Penerima BLT - Desa Digital',
            'hasil' => $hasil,
            'searchPerformed' => $searchPerformed
        ]);
    }
    public function updateMetode(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'metode' => 'required|in:cash,transfer'
        ]);

        $blt = Blt::where('nik', $request->nik)->first();

        if ($blt && $blt->status == 'cair') {
            $blt->update(['metode_pencairan' => $request->metode]);
            return back()->with('success_metode', 'Metode pencairan berhasil dipilih!');
        }

        return back()->with('error_metode', 'Gagal memproses permintaan.');
    }
}
