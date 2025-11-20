@extends('layouts.app')

@section('content')
    <style>
        /* Formal white table styling (copied from inventory/index.blade.php) */
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
            <h1 class="text-3xl font-bold text-yellow-400 tracking-tight">Daftar Pengembalian</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-900 shadow border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-2xl border border-blue-800/10 backdrop-blur-lg p-8">

            {{-- Filter Form: Bulan & Tahun --}}
            <form action="{{ route('pengembalian.index') }}" method="GET" class="flex flex-wrap items-end gap-4 mb-6">
                <div>
                    <label for="bulan" class="block text-sm font-semibold mb-1">Bulan</label>
                    <select name="bulan" id="bulan" class="rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Semua Bulan --</option>
                        @foreach(range(1,12) as $m)
                            <option value="{{ $m }}" {{ (string)($selectedMonth ?? request('bulan')) === (string)$m ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tahun" class="block text-sm font-semibold mb-1">Tahun</label>
                    <select name="tahun" id="tahun" class="rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Semua Tahun --</option>
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for($year = $currentYear; $year >= ($currentYear-10); $year--)
                            <option value="{{ $year }}" {{ (string)($selectedYear ?? request('tahun')) === (string)$year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <button type="submit" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition-all duration-200">
                        Filter
                    </button>
                    <a href="{{ route('pengembalian.index') }}"
                       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg shadow ml-2 transition-all duration-150">
                        Reset
                    </a>
                </div>
                {{-- Export buttons --}}
                @if($peminjamans->count())
                <div class="ml-auto flex gap-2">
                    <a href="{{ route('pengembalian.export', array_merge(request()->only('bulan','tahun'), ['format' => 'excel'])) }}"
                       class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition-all duration-150"
                       target="_blank"
                    >
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a2 2 0 012-2h3a1 1 0 01.7.3l1 1A1 1 0 0011 4h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V4zm9 10l3.5-5H15a1 1 0 01-1-1V8h2V7a1 1 0 00-1-1H9a1 1 0 00-1 1v8l2-3 2 3zm5-8h-4.586l-1-1H5v12h12V6z"/></svg>
                        Excel
                    </a>
                    <a href="{{ route('pengembalian.export', array_merge(request()->only('bulan','tahun'), ['format' => 'pdf'])) }}"
                       class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition-all duration-150"
                       target="_blank"
                    >
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4V3a2 2 0 011.85-2H11.2a2 2 0 011.8 2v1H14a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h1zm4 0V3h-2v1h2z"/></svg>
                        PDF
                    </a>
                </div>
                @endif
            </form>

            @if($peminjamans->count())
                <div class="overflow-x-auto rounded-xl">
                    <table id="myTable" class="min-w-full text-sm text-left">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Peminjaman ID</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Barang ID</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Tanggal Pinjam</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Tanggal Kembali</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 font-semibold uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $index => $peminjaman)
                                <tr>
                                    <td class="px-6 py-3">{{ $index + 1 }}</td>
                                    <td class="px-6 py-3 font-mono">
                                        {{ $peminjaman->peminjaman_id }}
                                    </td>
                                    <td class="px-6 py-3">
                                        @if($peminjaman->role === 'guru')
                                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full border border-yellow-300">Guru</span>
                                        @else
                                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full border border-blue-200">Siswa</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3">{{ $peminjaman->barang_id }}</td>
                                    <td class="px-6 py-3">{{ $peminjaman->tanggal_pinjam }}</td>
                                    <td class="px-6 py-3">{{ $peminjaman->tanggal_kembali }}</td>
                                    <td class="px-6 py-3">{{ $peminjaman->keterangan }}</td>
                                    <td class="px-6 py-3">
                                        @if(isset($peminjaman->status) && $peminjaman->status)
                                            <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full border border-green-300">Di Kembalikan</span>
                                        @else
                                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full border border-yellow-300">Di Pinjam</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 flex flex-wrap gap-2 justify-center items-center">
                                        @if(!isset($peminjaman->status) || !$peminjaman->status)
                                            <form action="{{ route('pengembalian.approve', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Setujui pengembalian ini?');" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-block px-4 py-1 rounded-lg bg-green-100 hover:bg-green-200 text-green-900 font-medium shadow transition-all border border-green-200"
                                                    title="Setujui">
                                                    Setujui
                                                </button>
                                            </form>
                                        @else
                                            <button class="inline-block px-4 py-1 rounded-lg bg-gray-300 text-gray-700 font-medium shadow border border-gray-300 cursor-not-allowed" disabled>
                                                Disetujui
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">Belum ada data pengembalian.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
