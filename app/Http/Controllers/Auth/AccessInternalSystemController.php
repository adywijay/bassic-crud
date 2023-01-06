<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Account as Ac;
use App\Http\Traits\CustomAuthTrait;

class AccessInternalSystemController extends Controller
{

    use CustomAuthTrait;

    public function index()
    {
        return view('login_all_internals', [
            "judul" => "Login | System Internals"
        ]);
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);


        $credentials = $request->only(['email', 'password']);
        $internAuth = auth()->guard('admin');
        if ($internAuth->attempt($credentials)) {
            $this->sessCreate($credentials);
            return redirect()->route('beranda');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Username or Password Inccorect');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('logininternal');
    }
}