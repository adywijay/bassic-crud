<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
//use App\Http\Requests\Jabatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Jabatan as Jb;

trait JabatanTrait
{
    public function getJabatanAll()
    {
        $get_data = Jb::all();
        return $get_data;
    }

    public function addJabatan($pram_insert)
    {
        $input_jabatan = Jb::create($pram_insert);
        if ($input_jabatan == true) {
            return response()->json([
                'status' => true,
                'respon_code' => Response::HTTP_CREATED,
                'message' => 'Data has been successfully added'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon_code' => Response::HTTP_NO_CONTENT,
                'message' => 'Data has been unsuccessfull added.!'
            ]);
        }
    }

    public function getByIdJabatan($id)
    {
        $get_id = Jb::find($id);
        return response()->json($get_id);
    }

    public function updateJabatan($req_id, $req_all): JsonResponse
    {
        $fromid = Jb::find($req_id);
        $inputan = $req_all;
        $jalankan = $fromid->update($inputan);
        if ($jalankan == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'Data has been successfully modify'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Data failled modify'
            ]);
        }
    }

    public function delJabatan($id): JsonResponse
    {
        $cek_data = Jb::select('*')->where('id', $id)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Jb::destroy($id);

            if ($running_hapus == true) {
                return response()->json([
                    'status' => 'success',
                    'respon code' => Response::HTTP_OK,
                    'message' => 'Data has been removed successfully.!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'respon code' => Response::HTTP_NOT_MODIFIED,
                    'message' => 'Data has unsuccessfull removed.!'
                ]);
            }
        }
    }
}