<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;;

use App\Http\Traits\JabatanTrait;
use App\Http\Traits\KandidatTrait;
use App\Http\Traits\KaryawanTrait;
use App\Http\Traits\RoleTrait;
use App\Http\Traits\UserTrait;
use App\Http\Traits\AccountTrait;
use App\Http\Traits\ReportingTrait;

class AdminController extends Controller
{
    use JabatanTrait;
    use RoleTrait;
    use UserTrait;
    use KandidatTrait;
    use KaryawanTrait;
    use AccountTrait;
    use ReportingTrait;

    public function __construct()
    {
        $this->middleware('validation');
    }

    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function Logic from call views                               |
     * ==============================================================================+
     */

    public function index()
    {
        return view('admin.home_view', [
            "judul" => "Dashboard | Administrator"
        ]);
    }

    public function getJbt()
    {
        $call = $this->getJabatanAll();
        return view('admin.mtdata_jabatan_all', [
            "judul" => "View | Jabatan"
        ], compact('call'));
    }

    public function getRole()
    {
        $call = $this->getRoleAll();
        return view('admin.mtdata_role_all', [
            "judul" => "View | Roles"
        ], compact('call'));
    }

    public function getUsers()
    {
        $call = $this->getUserAll();
        return view('admin.mtdata_user_all', [
            "judul" => "View | Users"
        ], compact('call'));
    }

    public function getKdt()
    {
        $call = $this->getAllKdt();
        return view('admin.mtdata_kandit_all', [
            "judul" => "View | Candidate"
        ], compact('call'));
    }

    public function getDetailUser($id)
    {
        $call = $this->getByIdUser($id);
        return view('admin.mtdata_user_detail', [
            "judul" => "View | Users"
        ], compact('call'));
    }

    public function getEmp()
    {
        $call = $this->getEmplAll();
        return view('admin.mtdata_karywan_all', [
            "judul" => "View | Employee"
        ], compact('call'));
    }

    public function getAccount()
    {
        $call = $this->getAllAccount();
        return view('admin.mtdata_account_all', [
            "judul" => "View | Account"
        ], compact('call'));
    }

    public function reportEmp()
    {
        return $this->exportKaryawan();
    }

    public function PdfEmp()
    {
        return $this->printPDFEmp();
    }

    /**
     * ==============================================================================+
     *                                                                               |
     *             Function Logic from call method create or add data                |
     *                                                                               |
     * ==============================================================================+
     */


    public function addJbt(Request $reqjbt)
    {
        $this->validate($reqjbt, [
            'jabatan_code' => 'required|max:15|min:5',
            'jabatan_name' => 'required|max:100|min:10'
        ]);
        $pram_insert = [
            'jabatan_code' => $reqjbt->jabatan_code,
            'jabatan_name' => $reqjbt->jabatan_name
        ];

        return $this->addJabatan($pram_insert);
    }

    public function addRoles(Request $reqrole)
    {
        $pram_insert = [
            'role_name' => $reqrole->role_name,
            'role_desc' => $reqrole->role_desc
        ];

        return $this->addRole($pram_insert);
    }

    public function manualInputKdt(Request $req)
    {
        $this->validate($req, [
            'kandidat_name'   => 'required',
            'kandidat_email'  => 'required',
            'user_id'         => 'required',
            'jabatan_id'      => 'required',
            'role_id'         => 'required',
            'year_of_join'    => 'required',
            'date_of_join'    => 'required'
        ]);
        $pram_insert = [
            'kandidat_name'   => $req->kandidat_name,
            'kandidat_email'  => $req->kandidat_email,
            'user_id'         => $req->user_id,
            'jabatan_id'      => $req->jabatan_id,
            'role_id'         => $req->role_id,
            'year_of_join'    => $req->year_of_join,
            'date_of_join'    => $req->date_of_join
        ];
        return $this->addKandidatJson($pram_insert);
    }

    public function addKaryawan(Request $req)
    {
        $this->validate(
            $req,
            [
                'id'              => 'required',
                'kandidat_name'   => 'required',
                'kandidat_email'  => 'required',
                'user_id'         => 'required',
                'jabatan_id'      => 'required',
                'role_id'         => 'required',
                'year_of_join'    => 'required',
                'date_of_join'    => 'required',
                'status'          => 'required'
            ]
        );
        $pram_insert = [
            'id'   => $req->id,
            'kandidat_name'   => $req->kandidat_name,
            'kandidat_email'  => $req->kandidat_email,
            'user_id'         => $req->user_id,
            'jabatan_id'      => $req->jabatan_id,
            'role_id'         => $req->role_id,
            'year_of_join'    => $req->year_of_join,
            'date_of_join'    => $req->date_of_join,
            'status'          => $req->status
        ];
        return $this->klaimKaryawan($pram_insert);
    }

    public function addAcount(Request $req)
    {
        $this->validate($req, [
            'nik'           => 'required',
            'user_id'       => 'required',
            'jabatan_id'    => 'required',
            'role_id'       => 'required',
            'karyawan_id'   => 'required',
            'nama_karyawan' => 'required',
            'email'         => 'required',
            'status'        => 'required'
        ]);

        $pram_insert = [
            'nik'           => $req->nik,
            'user_id'       => $req->user_id,
            'jabatan_id'    => $req->jabatan_id,
            'role_id'       => $req->role_id,
            'karyawan_id'   => $req->karyawan_id,
            'nama_karyawan' => $req->nama_karyawan,
            'email'         => $req->email,
            'status'        => $req->status
        ];
        return $this->klaimAccount($pram_insert);
    }

    #-----------------------------------------------------------------------------------


    /**
     * ==============================================================================+
     *                                                                               |
     *           Function Logic from call method get all / by id data                |
     *                                                                               |
     * ==============================================================================+
     */
    public function getIdJbt($id)
    {
        return $this->getByIdJabatan($id);
    }

    public function getIdrole($id)
    {
        return $this->getByIdRole($id);
    }

    public function getIdKdt($id)
    {
        return $this->getByIdKdt($id);
    }

    public function getIdEmp($id)
    {
        return $this->getByIdEmp($id);
    }

    #-----------------------------------------------------------------------------------


    /**
     * ==============================================================================+
     *                                                                               |
     *           Function Logic from call method update / modify data                |
     *                                                                               |
     * ==============================================================================+
     */
    public function updateJbt(Request $reqjbt)
    {
        $get_id = $reqjbt->id;
        $get_all = $reqjbt->all();
        return $this->updateJabatan($get_id, $get_all);
    }

    public function updateRoles(Request $reqrole)
    {
        $get_id = $reqrole->id;
        $get_all = $reqrole->all();
        return $this->updateRole($get_id, $get_all);
    }

    public function setUserOff($id)
    {
        return $this->setStatusOf($id);
    }

    public function setUserOn($id)
    {
        return $this->setStatusOn($id);
    }

    public function setAcc($id)
    {
        return $this->setConfirmAcc($id);
    }

    public function setRecjt($id)
    {
        return $this->setConfirmRejct($id);
    }

    public function setAct($id)
    {
        return $this->setActivated($id);
    }

    public function setInact($id)
    {
        return $this->setInactived($id);
    }

    public function setOnAcc($id)
    {
        return $this->setStatusAccOn($id);
    }

    public function setAccOff($id)
    {
        return $this->setStatusAccOff($id);
    }


    public function resetPassword(Request $req)
    {
        $pram_insert = [
            'nik'       => $req->nik,
            'password'  => $req->password
        ];
        return $this->resetPassw($pram_insert);
    }

    #-----------------------------------------------------------------------------------


    /**
     * ==============================================================================+
     *                                                                               |
     *           Function Logic from call method delete / data                       |
     *                                                                               |
     * ==============================================================================+
     */


    public function delJbt($id)
    {
        return $this->delJabatan($id);
    }

    public function delRoles($id)
    {
        return $this->delRole($id);
    }

    public function delUsers($id)
    {
        return $this->delUser($id);
    }

    public function reqDelKdtId(Request $req)
    {
        $this->validate($req, [
            'id_hapus' => 'required'
        ]);

        $pram_input = $req->id_hapus;
        return $this->delKdtByReq($pram_input);
    }

    public function reqDelEmpById(Request $req)
    {
        $this->validate($req, [
            'id' => 'required'
        ]);

        $pram_input = $req->id;
        return $this->delEmpByReq($pram_input);
    }
}