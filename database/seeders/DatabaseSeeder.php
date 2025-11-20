<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categories;
use App\Models\Inventory;
use App\Models\Teacher;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Only seed "Test User" if it does not already exist to avoid duplicate entry errors
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Only seed "Siswa Dummy" if it does not already exist
        if (!User::where('email', 'siswa@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Siswa Dummy',
                'email' => 'siswa@example.com',
            ]);
        }
        // Seed siswa (students) using Eloquent Model
        // Seed siswa using Siswa Eloquent Model (see app/Models/Siswa.php)
        Siswa::insert([
            [
                "nisn"          => "1234567890",
                "nama_lengkap"  => "Siswa Satu",
                "tanggal_lahir" => "2005-01-01",
                "alamat"        => "Jl. Satu No. 1",
                "jurusan"       => "PPLG",
                "angkatan"      => "2023",
                "no_hp"         => "081234567890",
                "added_by"      => 1, // or use related user id
                "is_active"     => true,
                "created_at"    => now(),
                "updated_at"    => now(),
            ],
            [
                "nisn"          => "0987654321",
                "nama_lengkap"  => "Siswa Dua",
                "tanggal_lahir" => "2004-12-12",
                "alamat"        => "Jl. Dua No. 2",
                "jurusan"       => "BC",
                "angkatan"      => "2022",
                "no_hp"         => "081298765432",
                "added_by"      => 1, // or use related user id
                "is_active"     => true,
                "created_at"    => now(),
                "updated_at"    => now(),
            ],
        ]);
        // Seed teachers using Eloquent Model
        Teacher::insert([
            [
                'Nip' => '19811231202201', 
                'nama_lengkap' => 'Budi Santoso',
                'Jabatan' => 'Guru Matematika',
                'no_hp' => '081234567890',
                'Email' => 'budi.guru@example.com',
                'Alamat' => 'Jl. Mawar No. 1, Jakarta',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nip' => '19821231202202', 
                'nama_lengkap' => 'Ani Lestari',
                'Jabatan' => 'Guru Bahasa Indonesia',
                'no_hp' => '081298765432',
                'Email' => 'ani.guru@example.com',
                'Alamat' => 'Jl. Melati No. 2, Bandung',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed categories using the correct column name defined in Categories model: 'category_name'
        $categories = [
            ['category_name' => 'Elektronik'],
            ['category_name' => 'Alat Tulis'],
            ['category_name' => 'Buku'],
            ['category_name' => 'Lainnya'],
        ];

        foreach ($categories as $category) {
            Categories::create($category);
        }

        // Seed inventories
        Inventory::create([
            'kode_barang' => 'BRG001',
            'nama_barang' => 'Laptop Lenovo',
            'category_id' => 1,
            'deskripsi' => 'Laptop untuk keperluan siswa',
            'status' => 'tersedia',
            'lokasi_barang' => 'Ruang IT',
            'is_active' => true,
        ]);
        Inventory::create([
            'kode_barang' => 'BRG002',
            'nama_barang' => 'Buku Matematika',
            'category_id' => 3,
            'deskripsi' => 'Buku Matematika kelas 10',
            'status' => 'tersedia',
            'lokasi_barang' => 'Perpustakaan',
            'is_active' => true,
        ]);
        Inventory::create([
            'kode_barang' => 'BRG003',
            'nama_barang' => 'Proyektor Epson',
            'category_id' => 1,
            'deskripsi' => 'Proyektor ruang kelas guru',
            'status' => 'tersedia',
            'lokasi_barang' => 'Ruang Guru',
            'is_active' => true,
        ]);
    }
}
