<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TestingController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Jabatan as Jb;

class BaseController extends Controller
{
    public function index()
    {
        // $result = (new TestingController)->Outs();
        $result = new TestingController;
        return $result->Outs();
        //dd($result->Outs());
        // return view('dasboard', [
        //     "judul" => "Dashboard"
        // ]);
    }

    public function indexJbt()
    {
        $data_jabatan = Jb::all();
        return view('master_jabatan_all', [
            "judul" => "View | Jabatan"
        ], compact('data_jabatan'));
    }

    public function addJabatan(Request $req): JsonResponse
    {
        $req->validate([
            'jabatan_code' => 'required',
            'jabatan_name' => 'required'
        ]);

        $insert = [
            'jabatan_code' => $req->jabatan_code,
            'jabatan_name' => $req->jabatan_name
        ];

        $input_jabatan = Jb::create($insert);

        if ($input_jabatan == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_CREATED,
                'message' => 'Data has been successfully created'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NO_CONTENT
            ]);
        }




        // $add = Jb::create($insert);
        // if ($add) {
        //     $response = [
        //         'status' => 'ok',
        //         'success' => true,
        //         'message' => 'Record created succesfully!'
        //     ];
        //     return $response;
        // } else {
        //     $response = [
        //         'status' => 'ok',
        //         'success' => false,
        //         'message' => 'Record created failed!'
        //     ];
        //     return $response;
        // }
    }

    public function getForEdit(Request $req)
    {
        $run_query = Jb::find($req->id);
        return view('master_jabatan_edit', [
            "judul" => "View | Jabatan"
        ], compact('run_query'));
    }

    public function getJbtById($id)
    {
        $get_id = Jb::find($id);
        return response()->json($get_id);
    }


    public function updateJbt(Request $request): JsonResponse
    {
        $update_jbt = Jb::find($request->id);
        $update_jbt->jabatan_code = $request->jabatan_code;
        $update_jbt->jabatan_name = $request->jabatan_name;
        if ($update_jbt->save() == true) {
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

    public function delJbt($id): JsonResponse
    {
        $del_jbt = Jb::find($id);
        $runn_del = $del_jbt->delete();
        if ($runn_del == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'Data has been successfully deleted'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'No data are deleted'
            ]);
        }
    }
}