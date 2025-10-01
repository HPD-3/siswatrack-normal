@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="flex items-center mb-8 gap-3">
        <div class="bg-blue-800/80 rounded-full p-3 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.5" fill="currentColor" class="text-blue-900" opacity="0.2"/>
                <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
                <path d="M4 20c0-3.3137 3.134-6 7-6s7 2.6863 7 6" stroke="currentColor" stroke-width="1.5" fill="none"/>
            </svg>
        </div>
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Detail Siswa</h1>
    </div>

    <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 rounded-2xl shadow-2xl border border-blue-800/40 backdrop-blur-lg p-8">
        <dl class="divide-y divide-blue-700/60">
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">NISN</dt>
                <dd class="text-yellow-300 font-mono text-lg">{{ $siswa->nisn }}</dd>
            </div>
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">Nama Lengkap</dt>
                <dd class="text-white font-medium">{{ $siswa->nama_lengkap }}</dd>
            </div>
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">Tanggal Lahir</dt>
                <dd class="text-blue-100">{{ $siswa->tanggal_lahir }}</dd>
            </div>
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">Alamat</dt>
                <dd class="text-blue-100 max-w-xs text-right">{{ $siswa->alamat }}</dd>
            </div>
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">Jurusan</dt>
                <dd>
                    <span class="inline-block px-3 py-1 rounded-lg bg-blue-700/60 text-yellow-200 font-semibold uppercase tracking-wide">
                        {{ $siswa->jurusan ?? '-' }}
                    </span>
                </dd>
            </div>
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">Angkatan</dt>
                <dd>
                    <span class="inline-block px-3 py-1 rounded-lg bg-yellow-700/70 text-white font-semibold">
                        {{ $siswa->angkatan ?? '-' }}
                    </span>
                </dd>
            </div>
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">No HP</dt>
                <dd class="text-blue-100">{{ $siswa->no_hp ?? '-' }}</dd>
            </div>
            <div class="py-4 flex justify-between items-center">
                <dt class="text-blue-200 font-semibold">Status Aktif</dt>
                <dd>
                    @if($siswa->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-600/80 text-white font-semibold">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-600/80 text-white font-semibold">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Tidak Aktif
                        </span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>

    <div class="mt-8 flex flex-wrap gap-3 justify-end">
        <a href="{{ route('siswa.index') }}"
           class="inline-flex items-center px-5 py-2 rounded-xl bg-blue-800/80 hover:bg-blue-700 text-blue-100 hover:text-white font-semibold shadow transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <a href="{{ route('siswa.edit', $siswa->id) }}"
           class="inline-flex items-center px-5 py-2 rounded-xl bg-yellow-700/80 hover:bg-yellow-600 text-yellow-100 hover:text-white font-semibold shadow transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6l11-11a2.828 2.828 0 00-4-4L5 17v4z" />
            </svg>
            Edit
        </a>
    </div>
</div>
@endsection
