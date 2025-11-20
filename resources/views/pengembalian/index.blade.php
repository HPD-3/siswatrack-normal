@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-indigo-700 dark:text-indigo-200 tracking-tight drop-shadow-md">
            <svg class="inline w-8 h-8 mr-2 text-indigo-500 dark:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"></path>
            </svg>
            Daftar Pengembalian
        </h1>
    </div>
    @if(session('success'))
        <div class="mb-5 rounded-lg bg-gradient-to-r from-green-200 to-green-100 px-6 py-4 text-green-900 border-l-4 border-green-500 dark:bg-green-900 dark:text-green-100 dark:border-green-300 shadow-lg">
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-gradient-to-br from-indigo-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-2xl shadow-2xl">
        <!-- Filter & Sort function controls: Sort by specific date -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 px-6 py-4 space-y-2 sm:space-y-0">
            <div class="flex items-center space-x-3">
                <label for="dateFilter" class="font-semibold text-indigo-800 dark:text-indigo-200">Tampilkan tanggal:</label>
                <input type="date" id="dateFilter" class="px-3 py-2 border rounded-lg text-sm shadow focus:ring-2 focus:ring-indigo-400 focus:outline-none dark:bg-gray-700 dark:text-white" />
                <label for="dateType" class="font-semibold text-indigo-800 dark:text-indigo-200 ml-2">Berdasarkan:</label>
                <select id="dateType" class="px-3 py-2 border rounded-lg text-sm shadow focus:ring-2 focus:ring-indigo-400 focus:outline-none dark:bg-gray-700 dark:text-white">
                    <option value="tanggal_pinjam">Tanggal Pinjam</option>
                    <option value="tanggal_kembali">Tanggal Kembali</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto py-2">
            <table class="min-w-full text-sm divide-y divide-indigo-200 dark:divide-indigo-800" id="myTable">
                <thead class="bg-gradient-to-b from-indigo-200 to-indigo-100 dark:from-indigo-800 dark:to-indigo-700 border-t rounded-t-2xl">
                    <tr>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">No</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Peminjaman ID</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Role</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Barang ID</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Tanggal Pinjam</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Tanggal Kembali</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Keterangan</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Status</th>
                        <th class="px-5 py-3 font-bold text-left text-indigo-900 dark:text-indigo-100 uppercase tracking-wider border-b-2 border-indigo-300 dark:border-indigo-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-100 dark:divide-indigo-900" id="pengembalian-tbody">
                    @foreach($peminjamans as $index => $peminjaman)
                        <tr class="hover:bg-indigo-50 dark:hover:bg-indigo-900 transition-colors duration-150">
                            <td class="px-5 py-4 text-indigo-900 dark:text-indigo-100 font-medium">{{ $index + 1 }}</td>
                            <td class="px-5 py-4 text-indigo-700 dark:text-white" data-field="peminjaman_id">
                                <span class="inline-block rounded-md bg-indigo-100 dark:bg-indigo-800 px-2 py-1 text-xs font-semibold">{{ $peminjaman->peminjaman_id }}</span>
                            </td>
                            <td class="px-5 py-4" data-field="role">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg font-medium text-xs {{ $peminjaman->role === 'guru' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-100' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100' }}">
                                    {{ ucfirst($peminjaman->role) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-indigo-700 dark:text-indigo-200" data-field="barang_id">{{ $peminjaman->barang_id }}</td>
                            <td class="px-5 py-4 text-indigo-700 dark:text-indigo-200" data-field="tanggal_pinjam">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-indigo-50 dark:bg-indigo-950 text-xs font-medium">{{ $peminjaman->tanggal_pinjam }}</span>
                            </td>
                            <td class="px-5 py-4 text-indigo-700 dark:text-indigo-200" data-field="tanggal_kembali">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-indigo-50 dark:bg-indigo-950 text-xs font-medium">{{ $peminjaman->tanggal_kembali }}</span>
                            </td>
                            <td class="px-5 py-4 text-indigo-700 dark:text-indigo-100">
                                {{ $peminjaman->keterangan }}
                            </td>
                            <td class="px-5 py-4" data-field="status">
                                @if(isset($peminjaman->status) && $peminjaman->status)
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-gradient-to-r from-green-400 to-green-200 text-green-900 dark:bg-gradient-to-r dark:from-green-800 dark:to-green-600 dark:text-green-200 border-2 border-green-300 dark:border-green-900 shadow">
                                        <svg class="w-4 h-4 mr-1 text-green-600 dark:text-green-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-200 text-yellow-900 dark:bg-gradient-to-r dark:from-yellow-900 dark:to-yellow-600 dark:text-yellow-100 border-2 border-yellow-300 dark:border-yellow-800 shadow">
                                        <svg class="w-4 h-4 mr-1 text-yellow-600 dark:text-yellow-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h4l2 4" /></svg>
                                        Belum Disetujui
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                @if(!isset($peminjaman->status) || !$peminjaman->status)
                                    <form action="{{ route('pengembalian.approve', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Setujui pengembalian ini?');"
                                        class="inline-block">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-1.5 rounded-lg bg-gradient-to-r from-indigo-700 to-indigo-500 hover:from-indigo-600 hover:to-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none text-white text-xs font-bold shadow-md gap-1">
                                            <svg class="w-4 h-4 mr-1 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Setujui
                                        </button>
                                    </form>
                                @else
                                    <button class="inline-flex items-center px-4 py-1.5 rounded-lg bg-gray-300 dark:bg-gray-600 text-white text-xs font-bold cursor-not-allowed shadow" disabled>
                                        <svg class="w-4 h-4 mr-1 text-white opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Disetujui
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if($peminjamans->isEmpty())
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-xl font-semibold text-indigo-400 dark:text-indigo-600 bg-gradient-to-r from-indigo-50 via-indigo-100 to-white dark:from-gray-900 dark:via-indigo-950 dark:to-gray-900 rounded-b-2xl">
                                <svg class="mx-auto w-14 h-14 text-indigo-200 dark:text-indigo-700 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-dasharray="4 2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 10h6M9 14h6" />
                                </svg>
                                Tidak ada data pengembalian.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function pad(num) {
            return num < 10 ? '0'+num : num;
        }

        function getCellValue(row, field) {
            let el = row.querySelector('[data-field="' + field + '"]');
            if (!el) return '';
            let text = el.textContent.trim();
            // Only handle sorting/filtering for date fields
            if(field === 'tanggal_pinjam' || field === 'tanggal_kembali') {
                // parsing with Date object for comparison
                const dt = new Date(text);
                if (!isNaN(dt)) {
                    // return as YYYY-MM-DD string for filtering, timestamp for sorting
                    return {
                        dateString: `${dt.getFullYear()}-${pad(dt.getMonth() + 1)}-${pad(dt.getDate())}`,
                        time: dt.getTime()
                    };
                }
                return { dateString: '', time: 0 };
            }
            return { value: text.toLowerCase() };
        }

        function filterTableByDate(field, dateString) {
            let tbody = document.getElementById('pengembalian-tbody');
            let rows = Array.from(tbody.querySelectorAll('tr'));
            // Only filter rows that are not the "Tidak ada data pengembalian."
            let visibleCount = 0;
            rows.forEach((row, idx) => {
                if (row.querySelector('td[colspan]')) return;
                let cv = getCellValue(row, field);
                if (dateString === '') {
                    row.style.display = '';
                    visibleCount++;
                    row.querySelector('td:first-child').textContent = visibleCount;
                } else if (cv.dateString === dateString) {
                    row.style.display = '';
                    visibleCount++;
                    row.querySelector('td:first-child').textContent = visibleCount;
                } else {
                    row.style.display = 'none';
                }
            });

            // Hide/show "Tidak ada data pengembalian." row
            let emptyRow = tbody.querySelector('tr td[colspan]');
            if (emptyRow) {
                if (visibleCount === 0) {
                    emptyRow.parentElement.style.display = '';
                } else {
                    emptyRow.parentElement.style.display = 'none';
                }
            }
        }

        const dateFilter = document.getElementById('dateFilter');
        const dateType = document.getElementById('dateType');

        // Filter by spesific date on change
        dateFilter.addEventListener('change', function () {
            filterTableByDate(dateType.value, this.value);
        });

        dateType.addEventListener('change', function () {
            filterTableByDate(this.value, dateFilter.value);
        });

        // Initialize: show all by default
        filterTableByDate(dateType.value, '');

    });
</script>
@endpush
@endsection
