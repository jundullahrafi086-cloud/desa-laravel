<?php

namespace App\Imports;

use App\Models\Blt;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BltImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Blt([
            'nik'    => $row['nik'],
            'kk'     => $row['nomor_kk'], // sesuaikan dengan heading di excel
            'nama'   => $row['nama_lengkap'],
            'alamat' => $row['alamat'],
            'tahun'  => $row['tahun'],
            'status' => $row['status'] ?? 'pending',
        ]);
    }
}
