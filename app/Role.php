<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $fillable = [
        'role_name',
        'role_desc'
    ];
    // untuk memproteksi field id
    protected $guarded = ['id'];

    // untuk relasi one To Many
    public function User()
    {
        return $this->hasOne('App\User');
    }

    public function Account()
    {
        return $this->hasOne('App\Account');
    }

    public function Kandidat()
    {
        return $this->hasOne('App\Kandidat');
    }

    public function Karyawan()
    {
        return $this->hasOne('App\Karyawan');
    }
}