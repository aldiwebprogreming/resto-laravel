<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [

        'kode','nama','gambar','kategori','harga', 'qty', 'total_harga', 'tgl'
    ];
}
