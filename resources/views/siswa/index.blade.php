@extends('layouts.app')

@section('content')
    <style>
        /* Custom table styling */
        #myTable {
            border-radius: 1rem;
            overflow: hidden;
            background: linear-gradient(120deg, #1e293b 0%, #1e40af 100%);
            box-shadow: 0 6px 32px 0 rgba(30, 58, 138, 0.25);
        }

        #myTable thead th {
            background: linear-gradient(90deg, #1e40af 60%, #0ea5e9 100%);
            color: #fff;
            border-bottom: 2px solid #2563eb;
            font-size: 0.95rem;
            letter-spacing: 0.08em;
            text-shadow: 0 1px 2px #1e293b44;
        }

        #myTable tbody tr {
            transition: background 0.2s;
        }

        #myTable tbody tr:hover {
            background: rgba(59, 130, 246, 0.13) !important;
            box-shadow: 0 2px 12px 0 rgba(30, 64, 175, 0.10);
        }

        #myTable td,
        #myTable th {
            border: none !important;
        }

        #myTable td {
            background: transparent !important;
            vertical-align: middle;
        }

        /* DataTables custom template styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: linear-gradient(90deg, #1e40af 60%, #0ea5e9 100%);
            color: #fff !important;
            border-radius: 0.5rem;
            margin: 0 0.15rem;
            border: none !important;
            padding: 0.35rem 0.9rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: linear-gradient(90deg, #facc15 40%, #f59e42 100%) !important;
            color: #1e293b !important;
            box-shadow: 0 2px 8px 0 #facc1533;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            background: #1e293b;
            color: #f1f5f9;
            border-radius: 0.5rem;
            border: 1px solid #2563eb;
            padding: 0.3rem 0.7rem;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        .dataTables_wrapper .dataTables_info {
            color: #cbd5e1;
            font-size: 0.95rem;
            margin-top: 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label {
            color: #f1f5f9;
            font-weight: 500;
            font-size: 0.98rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1.2rem;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            outline: 2px solid #facc15;
            border-color: #facc15;
            background: #334155;
        }
    </style>
    <div class="max-w-7xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight">Daftar Siswa</h1>
        </div>

        <div
            class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 rounded-2xl shadow-2xl border border-blue-800/40 backdrop-blur-lg p-8">
            @if($datasiswa->count())
                <div class="overflow-x-auto rounded-xl">
                    <table id="myTable" class="min-w-full text-sm text-left text-blue-100">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">NISN</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Nama Lengkap</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Jurusan</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Angkatan</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-700/60">
                            @foreach($datasiswa as $siswa)
                                <tr>
                                    <td class="px-6 py-3" data-label="NISN">{{ $siswa->nisn }}</td>
                                    <td class="px-6 py-3" data-label="Nama Lengkap">{{ $siswa->nama_lengkap }}</td>
                                    <td class="px-6 py-3" data-label="Jurusan">{{ $siswa->jurusan ?? '-' }}</td>
                                    <td class="px-6 py-3" data-label="Angkatan">{{ $siswa->angkatan ?? '-' }}</td>
                                    <td class="px-6 py-3 flex flex-wrap gap-2 justify-center items-center" data-label="Aksi">
                                        <a href="{{ route('siswa.show', $siswa->id) }}"
                                            class="inline-block px-4 py-1 rounded-lg bg-blue-800/70 hover:bg-blue-700 text-blue-100 hover:text-white font-medium shadow transition-all"
                                            title="Lihat">
                                            Lihat
                                        </a>
                                        <a href="{{ route('siswa.edit', $siswa->id) }}"
                                            class="inline-block px-4 py-1 rounded-lg bg-yellow-700/70 hover:bg-yellow-600 text-yellow-100 hover:text-white font-medium shadow transition-all"
                                            title="Edit">
                                            Edit
                                        </a>
                                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                                class="inline-block px-4 py-1 rounded-lg bg-red-700/70 hover:bg-red-600 text-red-100 hover:text-white font-medium shadow transition-all"
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
                    <p class="text-gray-400 text-lg">Belum ada data siswa.</p>
                </div>
            @endif
        </div>

        {{-- TRACK JURUSAN --}}
        <div class="mt-10 mb-8">
            <div class="flex items-center gap-3 mb-5">
                <div class="bg-gradient-to-br from-yellow-400/30 via-blue-900/60 to-blue-800/80 rounded-full p-3 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.5" fill="currentColor" class="text-blue-900" opacity="0.2"/>
                        <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="currentColor" stroke-width="1.5" fill="none"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-yellow-300 tracking-tight drop-shadow">Track Jumlah Siswa per Jurusan</h2>
            </div>
            @php
                // Hitung jumlah siswa per jurusan
                $jurusanCounts = $datasiswa->groupBy('jurusan')->map->count();
                // Daftar jurusan yang ingin ditampilkan (bisa disesuaikan)
                $daftarJurusan = [
                    'PPLG' => 'PPLG',
                    'BC' => 'BC',
                    'ANIMASI' => 'ANIMASI',
                    'TFL' => 'TFL',
                    'TO' => 'TO',
                    null => 'Lainnya'
                ];
                $jurusanIcons = [
                    'PPLG' => '💻',
                    'BC' => '📷',
                    'ANIMASI' => '🎬',
                    'TFL' => '⚙️',
                    'TO' => '🔧',
                    null => '🌈'
                ];
                $jurusanColors = [
                    'PPLG' => 'from-blue-700 via-blue-900 to-blue-800',
                    'BC' => 'from-purple-700 via-blue-900 to-blue-800',
                    'ANIMASI' => 'from-pink-700 via-blue-900 to-blue-800',
                    'TFL' => 'from-green-700 via-blue-900 to-blue-800',
                    'TO' => 'from-yellow-700 via-blue-900 to-blue-800',
                    null => 'from-gray-700 via-blue-900 to-blue-800'
                ];
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6">
                @foreach($daftarJurusan as $kode => $nama)
                    <div class="relative group">
                        <div class="bg-gradient-to-br {{ $jurusanColors[$kode] }} rounded-2xl shadow-xl flex flex-col items-center py-6 px-3 border border-blue-700/40 transition-all duration-300 group-hover:scale-105 group-hover:shadow-2xl">
                            <span class="text-3xl mb-2 drop-shadow">{{ $jurusanIcons[$kode] }}</span>
                            <span class="text-2xl font-extrabold text-yellow-300 drop-shadow-lg">{{ $jurusanCounts[$kode] ?? 0 }}</span>
                            <span class="text-xs text-blue-100 mt-2 uppercase tracking-widest font-semibold">{{ $nama }}</span>
                        </div>
                        <div class="absolute -top-2 -right-2 bg-yellow-400/90 text-blue-900 text-xs font-bold px-2 py-0.5 rounded-full shadow group-hover:scale-110 transition-all duration-200">
                            {{ round((($jurusanCounts[$kode] ?? 0) / max(1, $datasiswa->count())) * 100, 1) }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- END TRACK JURUSAN --}}

        {{-- TRACK ANGKATAN --}}
        <div class="mt-12">
            <div class="flex items-center justify-center gap-3 mb-5">
                <div class="bg-gradient-to-br from-yellow-400/30 via-yellow-700/40 to-blue-800/80 rounded-full p-3 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M15.5 8.5a3 3 0 1 0-4.24 4.24l4.24-4.24z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-yellow-300 tracking-tight drop-shadow text-center">Track Jumlah Siswa per Angkatan</h2>
            </div>
            @php
                // Hitung jumlah siswa per angkatan
                $angkatanCounts = $datasiswa->groupBy('angkatan')->map->count();
                // Ambil daftar angkatan yang ada, urutkan dari terkecil ke terbesar
                $daftarAngkatan = $angkatanCounts->keys()->sort()->values();
                $angkatanColors = [
                    0 => 'from-yellow-700 via-yellow-800 to-blue-800',
                    1 => 'from-yellow-600 via-yellow-700 to-blue-800',
                    2 => 'from-yellow-500 via-yellow-600 to-blue-800',
                    3 => 'from-yellow-400 via-yellow-500 to-blue-800',
                    4 => 'from-yellow-300 via-yellow-400 to-blue-800',
                    5 => 'from-yellow-200 via-yellow-300 to-blue-800',
                ];
            @endphp
            <div class="mb-8 flex flex-col items-center">
                @if($daftarAngkatan->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 justify-center">
                        @foreach($daftarAngkatan as $i => $angkatan)
                            <div class="relative group">
                                <div class="bg-gradient-to-br {{ $angkatanColors[$i % count($angkatanColors)] }} rounded-2xl shadow-xl flex flex-col items-center py-6 px-3 border border-yellow-700/40 transition-all duration-300 group-hover:scale-105 group-hover:shadow-2xl">
                                    <span class="text-2xl font-extrabold text-white drop-shadow-lg">{{ $angkatanCounts[$angkatan] ?? 0 }}</span>
                                    <span class="text-xs text-yellow-200 mt-2 uppercase tracking-widest font-semibold">
                                        Angkatan {{ $angkatan ?? '-' }}
                                    </span>
                                </div>
                                <div class="absolute -top-2 -right-2 bg-blue-200/90 text-yellow-900 text-xs font-bold px-2 py-0.5 rounded-full shadow group-hover:scale-110 transition-all duration-200">
                                    {{ round((($angkatanCounts[$angkatan] ?? 0) / max(1, $datasiswa->count())) * 100, 1) }}%
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-400 text-base">Belum ada data angkatan.</p>
                    </div>
                @endif
            </div>
        </div>
        {{-- END TRACK ANGKATAN --}}

@endsection