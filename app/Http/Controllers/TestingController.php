<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Requests\Jabatan;
use App\Http\Traits\JabatanTrait;
//use App\Http\Controllers\BaseController;
use App\Jabatan as Jb;
use App\User;
use App\Kandidat as Kd;
use App\Karyawan as Ky;
use App\Http\Middleware\RoleValidation;

class TestingController extends Controller
{
    use JabatanTrait;
    use RoleValidation;
    public function Outs()
    {
        return view('dasboard', [
            "judul" => "Dashboard"
        ]);
    }

    public function addJbt($id)
    {
        return $this->handle($id);
        // $cek_duplicate = Ky::select('kandidat_id')->where('kandidat_id', 6);
        // if ($cek_duplicate->count() > 1) {
        //     echo "<script>alert('data duplicat')</script>";
        // } else {
        //     echo "<script>alert('data tidak duplicat')</script>";
        // }
    }
}