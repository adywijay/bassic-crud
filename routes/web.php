<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
#use App\Http\Controllers\BaseController;
use App\Http\Controllers\TestingController;
#use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AccessInternalSystemController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes(['verify' => true]);

// Route::get('/home', [HomeController::class, 'index'])->name('homeuser');
// Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
// Route::post('/kandidat/add', [HomeController::class, 'insertKdt'])->name('addkdt');
Route::get('/tes/{id}', [TestingController::class, 'addJbt']);

Route::prefix('user')->group(

    function () {

        /* Route function login For User */
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');

        /* Route function logout For User */
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        /* Route function Registration For User */
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');

        /* Route function Password Reset For User */
        Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.update');

        /* Route function Password Confirmation For User */
        Route::get('confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
        Route::post('confirm', 'Auth\ConfirmPasswordController@confirm');

        /* Route function Email Verifiy For User */
        Route::get('verify', 'Auth\VerificationController@show')->name('verification.notice');
        Route::get('verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
        Route::post('resend', 'Auth\VerificationController@resend')->name('verification.resend');

        /* Route function System User when logon */
        Route::get('/', [GuestController::class, 'index'])->name('home');
        Route::post('/kandidat/save', [GuestController::class, 'addKandt'])->name('addkandidat');
    }
);
//login_all_internals.blade.php

Route::prefix('internals-sys')->group(

    function () {
        Route::get('/login', [AccessInternalSystemController::class, 'index'])->name('logininternal');
        Route::post('/login/check', [AccessInternalSystemController::class, 'postLogin'])->name('loginvalidation');
        Route::get('/logout', [AccessInternalSystemController::class, 'logout'])->name('logoutinternal');
    }
);
Route::prefix('admin')->group(

    function () {

        Route::get('/', [AdminController::class, 'index'])->name('beranda');
        Route::get('/jabatan', [AdminController::class, 'getJbt'])->name('jabatan');
        Route::get('/jabatan/get/{id}', [AdminController::class, 'getIdJbt']);
        Route::post('/jabatan/add', [AdminController::class, 'addJbt'])->name('addjabatan');
        Route::put('/jabatan/edit', [AdminController::class, 'updateJbt'])->name('editjabatan');
        Route::delete('/jabatan/dell/{id}', [AdminController::class, 'delJbt']);

        /*Route Role*/
        Route::get('/role', [AdminController::class, 'getRole'])->name('role');
        Route::get('/role/get/{id}', [AdminController::class, 'getIdrole']);
        Route::post('/role/add', [AdminController::class, 'addRoles'])->name('addrole');
        Route::put('/role/edit', [AdminController::class, 'updateRoles'])->name('editrole');
        Route::delete('/role/dell/{id}', [AdminController::class, 'delRoles']);

        /*Route Manage User*/
        Route::get('/muser', [AdminController::class, 'getUsers'])->name('muser');
        Route::get('/muser/detail/{id}', [AdminController::class, 'getDetailUser']);
        Route::put('/muser/setoff/{id}', [AdminController::class, 'setUserOff']);
        Route::put('/muser/seton/{id}', [AdminController::class, 'setUserOn']);
        Route::delete('/muser/dell/{id}', [AdminController::class, 'delUsers']);

        /* Route Manage Candidate */
        Route::get('/candid', [AdminController::class, 'getKdt'])->name('candid');
        Route::post('/candid/add', [AdminController::class, 'manualInputKdt'])->name('manualadd_kdt');
        Route::put('/candid/acc/{id}', [AdminController::class, 'setAcc']);
        Route::put('/candid/rejct/{id}', [AdminController::class, 'setRecjt']);
        Route::get('/candid/get/{id}', [AdminController::class, 'getIdKdt']);
        Route::post('/candid/reqdel', [AdminController::class, 'reqDelKdtId'])->name('reqdellidkdt');
        Route::post('/candid/claim/employee', [AdminController::class, 'addKaryawan'])->name('klaimemp');

        /* Route Manage Karyawan */
        Route::get('/emp', [AdminController::class, 'getEmp'])->name('employment');
        Route::put('/emp/active/{id}', [AdminController::class, 'setAct']);
        Route::put('/emp/inact/{id}', [AdminController::class, 'setInact']);
        Route::get('/emp/get/{id}', [AdminController::class, 'getIdEmp']);
        Route::post('/emp/reqdel', [AdminController::class, 'reqDelEmpById'])->name('reqdelby_id');
        Route::post('/emp/claim/accounts', [AdminController::class, 'addAcount'])->name('klaimempacc');
        Route::get('/emp/report', [AdminController::class, 'reportEmp'])->name('export_emp');
        Route::get('/emp/report/pdf', [AdminController::class, 'PdfEmp'])->name('export_emp_pdf');


        /* Route Manage Accounts */
        Route::get('/acc', [AdminController::class, 'getAccount'])->name('accounts');
        Route::put('/acc/active/{id}', [AdminController::class, 'setOnAcc']);
        Route::put('/acc/inact/{id}', [AdminController::class, 'setAccOff']);
        Route::post('/acc/restpassw', [AdminController::class, 'resetPassword'])->name('resetpassword');
    }
);
// Auth::routes(

// );

Route::get('/home', 'HomeController@index')->name('home');