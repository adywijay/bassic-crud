<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    protected $table = "kandidats";
    protected $fillable = [
        'kandidat_name',
        'kandidat_email',
        'user_id',
        'jabatan_id',
        'role_id',
        'year_of_join',
        'date_of_join',
        'status'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Karyawan()
    {
        return $this->hasOne('App\Karyawan');
    }

    public function Jabatan()
    {
        return $this->belongsTo('App\Jabatan');
    }

    public function Role()
    {
        return $this->belongsTo('App\Role');
    }
}