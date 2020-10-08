<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kategori;

class Produk extends Model
{
    protected $table = 'produks';
    protected $primaryKey = 'kd_produk';
    protected $fillable = [
    'kd_kategori',
    'nama_produk',
    'harga',
    'gambar_produk',
    'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori','kd_kategori');
    }
}


