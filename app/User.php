<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $table = "users";
    //protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'jabatan_id',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Kandidat()
    {
        return $this->hasOne('App\User');
    }

    public function Karyawan()
    {
        return $this->hasOne('App\Karyawan');
    }


    public function Account()
    {
        return $this->hasOne('App\Account');
    }
    public function Role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }
}