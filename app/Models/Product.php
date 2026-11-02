<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'harga_satuan',
        'deskripsi_produk',
        'foto_produk'
    ];
}
