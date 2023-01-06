<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = "jabatans";
    protected $fillable = [
        'jabatan_code',
        'jabatan_name'
    ];

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