<?php

namespace App\Exports;

use App\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KaryawansReporting implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Karyawan::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'nik',
            'nama_karyawan',
            'email',
            'kandidat_id',
            'user_id',
            'jabatan_id',
            'role_id',
            'year_of_join',
            'year_of_out',
            'date_of_join',
            'date_of_out',
            'status',
            'created_at',
            'updated_at'

        ];
    }
}