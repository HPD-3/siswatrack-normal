<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';

    protected $fillable = [
        "id",
        "peminjaman_id",
        "role",
        "barang_id",
        "tanggal_pinjam",
        "tanggal_kembali",
        "keterangan",
        "added_by",
        "status",
    ];
}
