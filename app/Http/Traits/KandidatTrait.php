<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Kandidat as Kd;

trait KandidatTrait
{
    public function getAllKdt()
    {
        $run = Kd::all();
        return $run;
    }

    public function getByIdKdt($id)
    {
        $get_id = Kd::find($id);
        return response()->json($get_id);
    }

    #----------------------------- Add Kandidat Output View --------------------------------------
    public function addKandidat($pram_insert)
    {
        $input_kdt = Kd::create($pram_insert);
        if ($input_kdt == true) {

            return redirect()->route('home')->with('success', 'Registration has been successfull.!');
        } else {

            return redirect()->route('home')->with('error', 'Registration has been successfull.!');
        }
    }

    #----------------------------- Add Kandidat Output Json --------------------------------------
    public function addKandidatJson($pram_insert)
    {
        $query = Kd::create($pram_insert);
        if ($query == true) {
            return response()->json([
                'status' => true,
                'respon_code' => Response::HTTP_CREATED,
                'message' => 'User registration successfull'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon_code' => Response::HTTP_BAD_REQUEST,
                'message' => 'User registration failled'
            ]);
        }
    }


    public function setConfirmAcc($id)
    {
        $query = Kd::where('id', $id)->update(['status' => 'Accept']);
        if ($query == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'User registration has been set accepted'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Data failled modify'
            ]);
        }
    }

    public function setConfirmRejct($id)
    {
        $query = Kd::where('id', $id)->update(['status' => 'Reject']);
        if ($query == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'User registration has been rejected'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Data failled modify'
            ]);
        }
    }

    public function delKdtByReq($pram_input)
    {
        $cek_data = Kd::select('*')->where('id', $pram_input)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Kd::destroy($pram_input);

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