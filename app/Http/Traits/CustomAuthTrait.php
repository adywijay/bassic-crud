<?php

namespace App\Http\Traits;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use App\Account as Ac;

trait CustomAuthTrait
{

    public function sessCreate($credentials)
    {

        $get = Ac::select('*')->where('email', $credentials['email'])->first();
        $create_sess = [
            Session::put('nik', $get->nik),
            Session::put('user_id', $get->user_id),
            Session::put('jabatan_id', $get->jabatan_id),
            Session::put('role_id', $get->role_id),
            Session::put('karyawan_id', $get->karyawan_id),
            Session::put('name', $get->name),
            Session::put('email', $get->email),
            Session::put('status', $get->status)
        ];

        return $create_sess;
    }
}