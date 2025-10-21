@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-12">
    <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 
                rounded-2xl shadow-2xl border border-blue-800/40 
                backdrop-blur-lg p-8 text-blue-100">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Detail Inventaris</h1>
        
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-semibold mb-1 text-blue-200">Kode Barang</label>
                <div class="px-4 py-2 rounded-lg bg-gray-800/70 border border-blue-900/40 text-white">
                    {{ $inventory->kode_barang }}
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1 text-blue-200">Nama Barang</label>
                <div class="px-4 py-2 rounded-lg bg-gray-800/70 border border-blue-900/40 text-white">
                    {{ $inventory->nama_barang }}
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1 text-blue-200">Kategori</label>
                <div class="px-4 py-2 rounded-lg bg-gray-800/70 border border-blue-900/40 text-white">
                    {{ $inventory->kategori }}
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1 text-blue-200">Jumlah</label>
                <div class="px-4 py-2 rounded-lg bg-gray-800/70 border border-blue-900/40 text-white">
                    {{ $inventory->jumlah }}
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1 text-blue-200">Keterangan</label>
                <div class="px-4 py-2 rounded-lg bg-gray-800/70 border border-blue-900/40 text-white">
                    {{ $inventory->keterangan ?? '-' }}
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-10">
            <a href="{{ route('inventory.index') }}" class="inline-block text-blue-300 hover:text-yellow-300 transition font-semibold text-sm">
                &larr; Kembali ke Daftar Inventaris
            </a>
            <div class="flex gap-3">
                <a href="{{ route('inventory.edit', $inventory->id) }}" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg font-bold text-sm transition shadow">
                    Edit
                </a>
                <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-700 hover:bg-red-900 text-white px-4 py-2 rounded-lg font-bold text-sm transition shadow">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
