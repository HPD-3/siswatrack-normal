<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        "Nip",
        "nama_lengkap",
        "Jabatan", 
        "no_hp",
        "Email",
        "Alamat",
        "is_active"
    ];
}