@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 
                rounded-2xl shadow-2xl border border-blue-800/40 
                backdrop-blur-lg p-8 text-blue-100">
        <h1 class="text-2xl font-bold text-white mb-6 text-center">Tambah Inventaris Baru</h1>

        @if ($errors->any())
            <div class="mb-5 bg-red-800/70 text-red-100 rounded-lg p-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inventory.store') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Kode Barang -->
            <div>
                <label for="kode_barang" class="block text-sm font-semibold mb-2">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang') }}"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                           focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                           hover:bg-gray-700/80 transition-all"
                    required>
            </div>

            <!-- Nama Barang -->
            <div>
                <label for="nama_barang" class="block text-sm font-semibold mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                           focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                           hover:bg-gray-700/80 transition-all"
                    required>
            </div>

            <!-- Kategori -->
            <div>
                <label for="category_id" class="block text-sm font-semibold mb-2">Kategori</label>
                <select name="category_id" id="category_id"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                           text-white focus:ring-2 focus:ring-blue-500 focus:outline-none
                           hover:bg-gray-700/80 transition-all"
                    required>
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                               focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                               hover:bg-gray-700/80 transition-all"
                >{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                           text-white focus:ring-2 focus:ring-blue-500 focus:outline-none
                           hover:bg-gray-700/80 transition-all"
                    required>
                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status</option>
                    <option value="Baik" {{ old('status') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ old('status') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Hilang" {{ old('status') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                </select>
            </div>

            <!-- Lokasi Barang -->
            <div>
                <label for="lokasi_barang" class="block text-sm font-semibold mb-2">Lokasi Barang</label>
                <input type="text" name="lokasi_barang" id="lokasi_barang" value="{{ old('lokasi_barang') }}"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                           focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                           hover:bg-gray-700/80 transition-all"
                    required>
            </div>

            <!-- Status Aktif -->
            <div>
                <label for="is_active" class="block text-sm font-semibold mb-2">Status Aktif</label>
                <select name="is_active" id="is_active"
                    class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                           text-white focus:ring-2 focus:ring-blue-500 focus:outline-none
                           hover:bg-gray-700/80 transition-all"
                    required>
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('inventory.index') }}" class="text-blue-300 hover:underline text-sm">Kembali ke Daftar Inventory</a>
                <button type="submit"
                        class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded-lg shadow-lg">
                    Simpan Inventaris
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

