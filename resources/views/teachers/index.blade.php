@extends('layouts.app')

@section('content')
    <style>
        /* Formal white table styling */
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

        /* DataTables custom template styling (neutralized for white/formal look) */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: #f3f4f6;
            color: #22304a !important;
            border-radius: 0.5rem;
            margin: 0 0.15rem;
            border: 1px solid #e5e7eb !important;
            padding: 0.35rem 0.9rem;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #bdd7f6 !important;
            color: #1e293b !important;
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            background: #fff;
            color: #22304a;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            padding: 0.3rem 0.7rem;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        .dataTables_wrapper .dataTables_info {
            color: #22304a;
            font-size: 0.95rem;
            margin-top: 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label {
            color: #22304a;
            font-weight: 500;
            font-size: 0.98rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1.2rem;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            outline: 2px solid #2463eb;
            border-color: #2563eb;
            background: #f9fafb;
        }
    </style>
    <div class="max-w-7xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-yellow-400 tracking-tight">Daftar Teacher</h1>
            <a href="{{ route('teachers.create') }}" class="inline-block bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-semibold px-6 py-2 rounded-full shadow transition-all duration-200">
                + Tambah Teacher
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl border border-blue-800/10 backdrop-blur-lg p-8">
            @if($teachers->count())
                <div class="overflow-x-auto rounded-xl">
                    <table id="myTable" class="min-w-full text-sm text-left">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">NIP</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Nama Lengkap</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Jabatan</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">No HP</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Alamat</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Aktif</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $Teacher)
                                <tr>
                                    <td class="px-6 py-3" data-label="NIP">{{ $Teacher->Nip }}</td>
                                    <td class="px-6 py-3" data-label="Nama Lengkap">{{ $Teacher->nama_lengkap }}</td>
                                    <td class="px-6 py-3" data-label="Jabatan">{{ $Teacher->Jabatan ?? '-' }}</td>
                                    <td class="px-6 py-3" data-label="No HP">{{ $Teacher->no_hp ?? '-' }}</td>
                                    <td class="px-6 py-3" data-label="Email">{{ $Teacher->Email ?? '-' }}</td>
                                    <td class="px-6 py-3" data-label="Alamat">{{ $Teacher->Alamat ?? '-' }}</td>
                                    <td class="px-6 py-3" data-label="Aktif">
                                        @if(isset($Teacher->is_active) && $Teacher->is_active)
                                            <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold border border-green-300">Aktif</span>
                                        @else
                                            <span class="inline-block px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-semibold border border-red-300">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 flex flex-wrap gap-2 justify-center items-center" data-label="Aksi">
                                        <a href="{{ route('teachers.show', $Teacher->id) }}"
                                            class="inline-block px-4 py-1 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-900 font-medium shadow transition-all border border-blue-200"
                                            title="Lihat">
                                            Lihat
                                        </a>
                                        <a href="{{ route('teachers.edit', $Teacher->id) }}"
                                            class="inline-block px-4 py-1 rounded-lg bg-yellow-100 hover:bg-yellow-200 text-yellow-900 font-medium shadow transition-all border border-yellow-200"
                                            title="Edit">
                                            Edit
                                        </a>
                                        <form action="{{ route('teachers.destroy', $Teacher->id) }}" method="POST" class="inline">
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
                    <p class="text-gray-400 text-lg">Belum ada data Teacher.</p>
                </div>
            @endif
        </div>
@endsection