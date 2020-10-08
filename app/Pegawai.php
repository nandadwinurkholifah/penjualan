<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'username';
    protected $fillable = [
        'username',
        'password',
        'nama_pegawai',
        'jk',
        'alamat',
        'is_aktif',
    ];
    
}
