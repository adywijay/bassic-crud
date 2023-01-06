<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Karyawan as Ky;
use App\Account as Ac;

trait AccountTrait
{

    public function getAllAccount()
    {
        $query = Ac::all();
        return $query;
    }
    public function klaimAccount($pram_insert)
    {
        $cek_duplicate = Ac::select('karyawan_id')->where('karyawan_id', $pram_insert['karyawan_id'])->get();
        if ($cek_duplicate->count() >= 0 and $cek_duplicate->count() >= 1) {

            return response()->json([
                'status' => true,
                'respon_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $pram_insert['nama_karyawan'] . ', ' . 'Data aleready exist.!'
            ]);
        } else {

            $cek_status = $pram_insert['status'];
            if ($pram_insert['status'] != 'Active') {
                return response()->json([
                    'status' => false,
                    'respon_code' => Response::HTTP_NOT_ACCEPTABLE,
                    'message' => 'Status is not \'Active\' ..!'
                ]);
            } else {
                $get_name = $pram_insert['nama_karyawan'];
                $generate_pass = "/?<>@#$%&*!=()-_~`^{}[]|;'+{$get_name}ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $out_generate = substr(str_shuffle($generate_pass), 0, 10);

                $query = Ac::create([
                    'nik'           => $pram_insert['nik'],
                    'user_id'       => $pram_insert['user_id'],
                    'jabatan_id'    => $pram_insert['jabatan_id'],
                    'role_id'       => $pram_insert['role_id'],
                    'karyawan_id'   => $pram_insert['karyawan_id'],
                    'name'          => $pram_insert['nama_karyawan'],
                    'password'      => bcrypt($out_generate),
                    'is_standart'   => $out_generate,
                    'email'         => $pram_insert['email']
                ]);

                if ($query == true) {
                    return response()->json([
                        'status' => true,
                        'respon_code' => Response::HTTP_CREATED,
                        'message' => 'Account claim has been successfull'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'respon_code' => Response::HTTP_BAD_REQUEST,
                        'message' => 'Account claim unsuccessfull'
                    ]);
                }
            }
        }
    }

    public function resetPassw($pram_insert)
    {
        $cek_ready = Ac::select('nik')->where('nik', $pram_insert['nik'])->get();
        if ($cek_ready->count() > 0) {
            $query = Ac::where('nik', $pram_insert['nik'])->update([
                'is_standart' => 'No',
                'password'    => bcrypt($pram_insert['password'])
            ]);
            if ($query == true) {
                return response()->json([
                    'status' => true,
                    'respon_code' => Response::HTTP_CREATED,
                    'message' => 'Password has been successfully reset.!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'respon_code' => Response::HTTP_NOT_MODIFIED,
                    'message' => 'Password unsuccessfull reset.!'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'respon_code' => Response::HTTP_NOT_FOUND,
                'message' => $pram_insert['nik'] . ' ' . 'Not found..!'
            ]);
        }
    }

    public function setStatusAccOn($id)
    {
        $query = Ac::where('id', $id)->update(['status' => 'Active']);
        if ($query == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'Accounts has been successfully set active'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Data failled modify'
            ]);
        }
    }

    public function setStatusAccOff($id)
    {
        $query = Ac::where('id', $id)->update(['status' => 'Inactive']);
        if ($query == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'Accounts has been successfully set inactive'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Data failled modify'
            ]);
        }
    }
}