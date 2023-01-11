<?php

namespace App\Http\Traits;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KaryawansReporting;
use App\Http\Traits\KaryawanTrait;
use PDF;
use App\Karyawan as Ky;

trait ReportingTrait
{
    use KaryawanTrait;


    public function exportKaryawan()
    {
        return Excel::download(new KaryawansReporting, 'employee.xlsx');
    }

    public function printPDFEmp()
    {
        $call = $this->getEmplAll();
        $pdf = PDF::loadview('admin.mtdata_karywan_all', [
            "judul" => "View | Employee"
        ], compact('call'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('laporan-pegawai.pdf');
    }
}