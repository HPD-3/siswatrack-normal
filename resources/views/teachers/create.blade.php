@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <!-- Card Form -->
    <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 
                rounded-2xl shadow-2xl border border-blue-800/40 
                backdrop-blur-lg p-8 text-blue-100">

        <h2 class="text-2xl font-bold mb-6 text-center text-white">Tambah Data Guru</h2>

        <form action="{{ route('Teachers.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- NIP -->
            <div>
                <label for="Nip" class="block text-sm font-semibold mb-2">NIP</label>
                <input type="text" name="Nip" id="Nip"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                        hover:bg-gray-700/80 transition-all"
                    required>
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-sm font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                        hover:bg-gray-700/80 transition-all"
                    required>
            </div>
            
            <!-- Jabatan -->
            <div>
                <label for="Jabatan" class="block text-sm font-semibold mb-2">Jabatan</label>
                <input type="text" name="Jabatan" id="Jabatan"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                        hover:bg-gray-700/80 transition-all">
            </div>
            
            <!-- No HP -->
            <div>
                <label for="no_hp" class="block text-sm font-semibold mb-2">No HP</label>
                <input type="text" name="no_hp" id="no_hp"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                        hover:bg-gray-700/80 transition-all">
            </div>

            <!-- Email -->
            <div>
                <label for="Email" class="block text-sm font-semibold mb-2">Email</label>
                <input type="email" name="Email" id="Email"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                        hover:bg-gray-700/80 transition-all"
                    required>
            </div>
            
            <!-- Alamat -->
            <div>
                <label for="Alamat" class="block text-sm font-semibold mb-2">Alamat</label>
                <textarea name="Alamat" id="Alamat" rows="3"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                        hover:bg-gray-700/80 transition-all"></textarea>
            </div>

            <!-- Status Aktif -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                    class="mr-2 rounded text-blue-600 focus:ring-blue-500">
                <label for="is_active" class="text-sm font-medium select-none">Aktif</label>
            </div>
            
            <!-- Tombol -->
            <div class="flex justify-end">
                <button type="submit" 
                    class="px-6 py-2 bg-blue-700 hover:bg-blue-600 text-white font-semibold 
                        rounded-lg shadow-lg transition transform hover:scale-105">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
