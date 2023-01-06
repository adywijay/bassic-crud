<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = "karyawans";
    protected $fillable = [
        'nik',
        'nama_karyawan',
        'email',
        'kandidat_id',
        'user_id',
        'jabatan_id',
        'role_id',
        'year_of_join',
        'year_of_out',
        'date_of_join',
        'date_of_out',
        'status'
    ];

    public function Kandidat()
    {
        return $this->belongsTo('App\Kandidat');
    }

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

    public function Account()
    {
        return $this->hasOne('App\Account');
    }
}