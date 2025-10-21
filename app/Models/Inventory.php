<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        "kode_barang",
        "nama_barang",
        "kategori", 
        "deskripsi",
        "status",
        "lokasi_barang",
        "is_active"
    ];
}