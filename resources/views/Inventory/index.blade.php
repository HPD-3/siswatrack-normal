@extends('layouts.app')

@section('content')
    <style>
        /* Formal white table styling (copied from siswa/index.blade.php) */
        #myTable {
            border-radius: 0.5rem;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 6px 32px 0 rgba(30, 58, 138, 0.10);
            border-collapse: separate;
            border-spacing: 0;
        }

        #myTable thead th {
            background: #f8fafc;
            color: #22304a;
            border-bottom: 2px solid #e5e7eb;
            font-size: 1rem;
            letter-spacing: 0.07em;
            text-shadow: none;
            font-weight: 600;
        }

        #myTable tbody tr {
            transition: background 0.2s;
            background: #fff;
        }

        #myTable tbody tr:hover {
            background: #eef2f8 !important;
            box-shadow: none;
        }

        #myTable td, #myTable th {
            border: 1px solid #e5e7eb !important;
        }

        #myTable td {
            background: transparent !important;
            vertical-align: middle;
            color: #22304a;
        }
    </style>
    <div class="max-w-7xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-yellow-400 tracking-tight">Daftar Inventaris</h1>
            <a href="{{ route('inventory.create') }}" class="inline-block bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-semibold px-6 py-2 rounded-full shadow transition-all duration-200">
                + Tambah Inventaris
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-900 shadow border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-2xl border border-blue-800/10 backdrop-blur-lg p-8">
            @if($inventories->count())
                <div class="overflow-x-auto rounded-xl">
                    <table id="myTable" class="min-w-full text-sm text-left">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Kode Barang</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Nama Barang</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Category Name</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Lokasi Barang</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Aktif</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $index => $item)
                                <tr>
                                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                                    <td class="px-6 py-3 font-mono">{{ $item->kode_barang }}</td>
                                    <td class="px-6 py-3">{{ $item->nama_barang }}</td>
                                    <td>{{ $item->category->category_name ?? '-' }}</td>
                                    <td class="px-6 py-3">{{ $item->deskripsi }}</td>
                                    <td class="px-6 py-3">{{ $item->status }}</td>
                                    <td class="px-6 py-3">{{ $item->lokasi_barang }}</td>
                                    <td class="px-6 py-3">
                                        @if($item->is_active)
                                            <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full border border-green-300">Aktif</span>
                                        @else
                                            <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full border border-red-300">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 flex flex-wrap gap-2 justify-center items-center">
                                        <a href="{{ route('inventory.show', $item->id) }}"
                                            class="inline-block px-4 py-1 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-900 font-medium shadow transition-all border border-blue-200"
                                            title="Lihat">
                                            Lihat
                                        </a>
                                        <a href="{{ route('inventory.edit', $item->id) }}"
                                            class="inline-block px-4 py-1 rounded-lg bg-yellow-100 hover:bg-yellow-200 text-yellow-900 font-medium shadow transition-all border border-yellow-200"
                                            title="Edit">
                                            Edit
                                        </a>
                                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                                class="inline-block px-4 py-1 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 font-medium shadow transition-all border border-red-200"
                                                title="Hapus">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">Belum ada data inventaris.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
