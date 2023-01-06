<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'accounts';
    protected $fillable = [
        'nik',
        'user_id',
        'jabatan_id',
        'role_id',
        'karyawan_id',
        'name',
        'password',
        'is_standart',
        'email'
    ];

    protected $hidden = [
        'password', 'is_standart',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Jabatan()
    {
        return $this->belongsTo('App\Jabatan');
    }

    public function Role()
    {
        return $this->belongsTo('App\Role');
    }

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan');
    }
}