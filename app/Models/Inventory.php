<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';
    protected $fillable = [
        "kode_barang",
        "nama_barang",
        "category_id", 
        "deskripsi",
        "status",
        "lokasi_barang",
        "is_active"
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}