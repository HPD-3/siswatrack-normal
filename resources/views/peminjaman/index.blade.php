@extends('layouts.app')

@section('content')
    {{-- kept this code in mind aight? --}}
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800">
        <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 
                                                        rounded-2xl shadow-2xl border border-blue-800/40 
                                                        backdrop-blur-lg p-8 text-blue-100 w-full max-w-xl">
            <h1 class="text-2xl font-bold text-white mb-6 text-center">Form Peminjaman Barang</h1>

            {{-- Display success message --}}
            @if (session('success'))
                <div class="mb-5 bg-green-800/70 text-green-100 rounded-lg p-4 text-center font-medium">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Display error messages for each required field --}}
            @if ($errors->any())
                <div class="mb-5 bg-red-800/70 text-red-100 rounded-lg p-4">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->get('role') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        @foreach ($errors->get('peminjaman_id') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        @foreach ($errors->get('barang_id') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        {{-- Other errors --}}
                        @foreach ($errors->all() as $error)
                            @if (!in_array($error, array_merge($errors->get('role'), $errors->get('peminjaman_id'), $errors->get('barang_id'))))
                                <li>{{ $error }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-5" id="form-peminjaman" novalidate>
                @csrf

                {{-- Jenis Peminjam --}}
                <div>
                    <label for="role" class="block text-sm font-semibold mb-2">Jenis Peminjam <span
                            class="text-red-400">*</span></label>
                    <select name="role" id="role"
                        class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                                                                   text-white focus:ring-2 focus:ring-blue-500 focus:outline-none
                                                                   hover:bg-gray-700/80 transition-all {{ $errors->has('role') ? 'border-red-500 ring-1 ring-red-500' : '' }}"
                        required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Jenis Peminjam</option>
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                    @error('role')
                        <span class="text-red-300 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Peminjaman ID --}}
                <div>
                    <label for="peminjaman_id" class="block text-sm font-semibold mb-2">Peminjaman ID <span
                            class="text-red-400">*</span></label>
                    <div class="flex gap-2">
                        <input type="text" name="peminjaman_id" id="peminjaman_id"
                            class="flex-1 px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                                                                       focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                                                                       hover:bg-gray-700/80 transition-all {{ $errors->has('peminjaman_id') ? 'border-red-500 ring-1 ring-red-500' : '' }}"
                            placeholder="Masukkan Peminjaman ID (misal: NIS/NIP/Nama Staff)"
                            value="{{ old('peminjaman_id') }}" required>
                        <button type="button" id="cekIdBtn" class="px-4 py-2 rounded-lg bg-blue-700 text-white font-semibold
                                                                       hover:bg-blue-800 transition-all shadow">Cek
                            ID</button>
                    </div>
                    <div id="StatusId" class="mt-2 text-sm text-yellow-200"></div>
                    @error('peminjaman_id')
                        <span class="text-red-300 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Barang yang dipinjam --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-semibold mb-2">Barang yang Dipinjam <span
                            class="text-red-400">*</span></label>
                    <div class="flex gap-2">
                        <input type="text" name="nama_barang" id="nama_barang" class="flex-1 px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                                                                       focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                                                                       hover:bg-gray-700/80 transition-all " required
                            placeholder="Masukan nama Barang!">
                        <button type="button" id="cekBrBtn" class="px-4 py-2 rounded-lg bg-blue-700 text-white font-semibold
                                                                       hover:bg-blue-800 transition-all shadow">Cek
                            Barang</button>
                        {{-- Hidden barang_id input for backend --}}
                        <input type="hidden" name="barang_id" id="barang_id" value="{{ old('barang_id') }}">
                    </div>
                    <div id="StatusBarang" class="mt-2 text-sm text-yellow-200"></div>
                    <div id="BarangInfo" class="mt-2 text-xs text-blue-200"></div>
                    @error('nama_barang')
                        <span class="text-red-300 text-xs">{{ $message }}</span>
                    @enderror
                    @error('barang_id')
                        <span class="text-red-300 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tanggal Pinjam --}}
                <div>
                    <label for="tanggal_pinjam" class="block text-sm font-semibold mb-2">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600
                                                                   focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                                                                   hover:bg-gray-700/80 transition-all"
                        value="{{ old('tanggal_pinjam') }}" required>
                </div>

                {{-- Tanggal Kembali --}}
                <div>
                    <label for="tanggal_kembali" class="block text-sm font-semibold mb-2">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600
                                                                   focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                                                                   hover:bg-gray-700/80 transition-all"
                        value="{{ old('tanggal_kembali') }}" required>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="block text-sm font-semibold mb-2">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600 
                                                                   focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                                                                   hover:bg-gray-700/80 transition-all"
                        placeholder="Tulis keterangan tambahan (jika ada)">{{ old('keterangan') }}</textarea>
                </div>

                {{-- Added by user --}}
                <div>
                    <label for="added_by" class="block text-sm font-semibold mb-2">Nama User (Petugas/Admin)</label>
                    <input type="text" name="added_by" id="added_by" class="w-full px-4 py-2 rounded-lg bg-gray-800/70 border border-gray-600
                                                                   focus:ring-2 focus:ring-blue-500 focus:outline-none text-white
                                                                   hover:bg-gray-700/80 transition-all"
                        placeholder="Nama Anda (Petugas/Admin)" value="{{ old('added_by', Auth::user()->name ?? '') }}"
                        required>
                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit" class="px-8 py-2 rounded-lg bg-green-600 text-white font-semibold shadow-lg
                                                                   hover:bg-green-700 transition-all">Simpan
                        Peminjaman</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Javascript for Cek ID or Cek Barang and client-side ("front-end") validation --}}
    <script>
        document.getElementById('cekIdBtn').addEventListener('click', function () {
            let id = document.getElementById('peminjaman_id').value;
            let role = document.getElementById('role').value;
            let status = document.getElementById('StatusId');

            if (!role) {
                status.innerHTML = `<span class="text-red-400">Pilih Jenis Peminjam dulu!</span>`;
                return;
            }
            if (!id) {
                status.innerHTML = `<span class="text-red-400">Isi ID Peminjam terlebih dahulu.</span>`;
                return;
            }

            // AJAX fetch untuk cek ID peminjam
            fetch(`/cek-id/${role}/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        status.innerHTML = `<span class="text-green-400">ID valid dan terdaftar.</span>`;
                    } else {
                        status.innerHTML = `<span class="text-red-400">ID tidak ditemukan.</span>`;
                    }
                })
                .catch(() => {
                    status.innerHTML = `<span class="text-red-400">Error saat memeriksa ID.</span>`;
                });
        });

        document.getElementById('cekBrBtn').addEventListener('click', function () {
            let nama_barang = document.getElementById('nama_barang').value;
            let status = document.getElementById('StatusBarang');
            let barangIdInput = document.getElementById('barang_id');
            let barangInfo = document.getElementById('BarangInfo');
            barangInfo.innerHTML = ''; // reset info

            if (!nama_barang) {
                status.innerHTML = `<span class="text-red-400">Masukkan nama barang!</span>`;
                barangIdInput.value = '';
                return;
            }

            fetch(`/cek-barang/${encodeURIComponent(nama_barang)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.valid && data.data) {
                        // Tampilkan data barang, walau .id tidak ada di respons (berdasar contoh)
                        status.innerHTML = `<span class="text-green-400">Barang ditemukan: <b>${data.data.nama_barang}</b></span>`;
                        let infoHTML = '';
                        infoHTML += `<div><span class="font-semibold">Kategori:</span> ${data.data.kategori ? data.data.kategori : '-'}</div>`;
                        infoHTML += `<div><span class="font-semibold">Kondisi:</span> ${data.data.kondisi ? data.data.kondisi : '-'}</div>`;
                        infoHTML += `<div><span class="font-semibold">Lokasi:</span> ${data.data.lokasi ? data.data.lokasi : '-'}</div>`;
                        barangInfo.innerHTML = infoHTML;

                        // Tidak bisa isi barang_id karena id tidak diberikan oleh backend
                        barangIdInput.value = '';
                        return;
                    } else {
                        status.innerHTML = `<span class="text-red-400">Barang tidak tersedia.</span>`;
                        barangInfo.innerHTML = '';
                        barangIdInput.value = '';
                        return;
                    }
                })
                .catch(() => {
                    status.innerHTML = `<span class="text-red-400">Error saat memeriksa ketersediaan barang.</span>`;
                    barangInfo.innerHTML = '';
                    barangIdInput.value = '';
                    return;
                });
        });

        // Prevent submit if barang_id is empty
        document.getElementById('form-peminjaman').addEventListener('submit', function(e) {
            let barangId = document.getElementById('barang_id').value;
            // Jika id benar-benar diperlukan, tambahkan validasi berikut;
            // Namun jika id tidak diberikan oleh backend /cek-barang, hapus baris-baris validation barang_id di sisi controller agar tidak error
            // if (!barangId) {
            //     e.preventDefault();
            //     let status = document.getElementById('StatusBarang');
            //     status.innerHTML = `<span class="text-red-400">Wajib klik "Cek Barang" dan pilih barang yang valid.</span>`;
            //     document.getElementById('nama_barang').focus();
            // }
        });
    </script>
@endsection

