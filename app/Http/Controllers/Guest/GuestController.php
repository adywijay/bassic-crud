<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\JabatanTrait;
use App\Http\Traits\KandidatTrait;


class GuestController extends Controller
{
    use JabatanTrait;
    use KandidatTrait;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $get_jbt = $this->getJabatanAll();
        return view('home_ext', [
            "judul" => "Dashboard | Users"
        ], compact('get_jbt'));
    }

    public function addKandt(Request $req)
    {
        $this->validate($req, [
            'kandidat_name'  => 'required',
            'kandidat_email' => 'required',
            'user_id'        => 'required',
            'jabatan_id'     => 'required',
            'year_of_join'   => 'required|max:4'
        ]);
        $pram_insert = [
            'kandidat_name'  => $req->get('kandidat_name'),
            'kandidat_email' => $req->get('kandidat_email'),
            'user_id'        => $req->get('user_id'),
            'jabatan_id'     => $req->get('jabatan_id'),
            'year_of_join'   => $req->get('year_of_join')
        ];
        //dd($pram_insert);
        return $this->addKandidat($pram_insert);
    }
}