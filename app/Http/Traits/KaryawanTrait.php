<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Karyawan as Ky;
use App\Kandidat as Kd;

trait KaryawanTrait
{
    public function getEmplAll()
    {
        $get = Ky::all();
        return $get;
    }

    public function getByIdEmp($id)
    {
        $get_id = Ky::find($id);
        return response()->json($get_id);
    }


    public function klaimKaryawan($pram_insert)
    {
        $cek_duplicate = Ky::select('kandidat_id')->where('kandidat_id', $pram_insert['id'])->get();
        if ($cek_duplicate->count() >= 0 and $cek_duplicate->count() >= 1) {

            return response()->json([
                'status' => true,
                'respon_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $pram_insert['kandidat_name'] . ', ' . 'Data aleready exist.!'
            ]);
        } else {

            $call_kdt = Kd::find($pram_insert['id']);
            if (is_null($call_kdt) == true) {
                return response()->json([
                    'status' => false,
                    'respon_code' => Response::HTTP_NOT_FOUND,
                    'message' => 'Data not found.!'
                ]);
            } elseif ($pram_insert['status'] != 'Accept') {
                return response()->json([
                    'status' => false,
                    'respon_code' => Response::HTTP_NOT_ACCEPTABLE,
                    'message' => 'Status is not \'Accept\' ..!'
                ]);
            } else {
                $splite = str_replace('-', '', substr($pram_insert['year_of_join'], 2, 5));
                $gen_nik = [
                    $pram_insert['id'],
                    $pram_insert['jabatan_id'],
                    $pram_insert['role_id'],
                    $pram_insert['user_id'],
                    $splite
                ];

                $query = Ky::create([
                    'nik'           => implode("", $gen_nik),
                    'nama_karyawan' => $pram_insert['kandidat_name'],
                    'email'         => $pram_insert['kandidat_email'],
                    'kandidat_id'   => $pram_insert['id'],
                    'user_id'       => $pram_insert['user_id'],
                    'jabatan_id'    => $pram_insert['jabatan_id'],
                    'role_id'       => $pram_insert['role_id'],
                    'year_of_join'  => $pram_insert['year_of_join'],
                    'date_of_join'  => $pram_insert['date_of_join']
                ]);

                if ($query == true) {
                    return response()->json([
                        'status' => true,
                        'respon_code' => Response::HTTP_CREATED,
                        'message' => 'Employee claim has been successfull'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'respon_code' => Response::HTTP_BAD_REQUEST,
                        'message' => 'Employee claim unsuccessfull'
                    ]);
                }
            }
        }
    }

    public function setActivated($id)
    {
        $query = Ky::where('id', $id)->update(['status' => 'Active']);
        if ($query == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'Employee status has been set active'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Employee failled set status'
            ]);
        }
    }

    public function setInactived($id)
    {
        $query = Ky::where('id', $id)->update(['status' => 'Inactive']);
        if ($query == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'Employee status has been set inactive'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Employee failled set status'
            ]);
        }
    }

    public function delEmpByReq($pram_input)
    {
        $cek_data = Ky::select('*')->where('id', $pram_input)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Ky::destroy($pram_input);

            if ($running_hapus == true) {
                return response()->json([
                    'status' => 'success',
                    'respon_code' => Response::HTTP_OK,
                    'message' => 'Data has been removed successfully.!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'respon_code' => Response::HTTP_NOT_MODIFIED,
                    'message' => 'Data has unsuccessfull removed.!'
                ]);
            }
        }
    }
}