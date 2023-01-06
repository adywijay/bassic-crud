<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\JabatanTrait;
//use App\Http\Traits\KandidatTrait;
use App\Kandidat as Kd;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use JabatanTrait;
    //use KandidatTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        #return view('home');
        $get_jbt = $this->getJabatanAll();
        return view('home_ext', [
            "judul" => "Dashboard | Users"
        ], compact('get_jbt'));
    }


    public function insertKdt(Request $req)
    {
        $this->validate($req, [
            'kandidat_name'  => 'required|max:15|min:5',
            'kandidat_email' => 'required|email|unique',
            'user_id'        => 'required',
            'jabatan_id'     => 'required',
            'year_of_join'   => 'required|max:4'
        ]);

        $get_input_frm = [
            'kandidat_name'  => $req->kandidat_name,
            'kandidat_email' => $req->kandidat_email,
            'user_id'        => $req->user_id,
            'jabatan_id'     => $req->jabatan_id,
            'year_of_join'   => $req->year_of_join
        ];
        $input_kdt = Kd::create($get_input_frm);
        if ($input_kdt == true) {
            echo "<script>alert('sukses')</script>";
            // return response()->json([
            //     'status' => true,
            //     'respon_code' => Response::HTTP_CREATED,
            //     'message' => 'Data has been successfully added'
            // ]);
        } else {
            echo "<script>alert('gagal cokkk')</script>";
            // return response()->json([
            //     'status' => false,
            //     'respon_code' => Response::HTTP_NO_CONTENT,
            //     'message' => 'Data has been unsuccessfull added.!'
            // ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}