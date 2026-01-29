<?php

namespace App\Exports;

use App\Models\Blt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BltExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil data tertentu saja agar tidak mengekspor ID atau Timestamps yang tidak perlu
        return Blt::select('nik', 'kk', 'nama', 'alamat', 'tahun', 'status')->get();
    }

    public function headings(): array
    {
        return ["NIK", "Nomor KK", "Nama Lengkap", "Alamat", "Tahun", "Status"];
    }
}
