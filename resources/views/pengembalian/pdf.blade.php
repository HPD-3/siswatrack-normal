<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #1f2937;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f3f4f6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Laporan Pengembalian</h2>
    <p>
        Bulan: {{ $month ? DateTime::createFromFormat('!m', $month)->format('F') : 'Semua' }} |
        Tahun: {{ $year ?? 'Semua' }}
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Peminjaman</th>
                <th>Role</th>
                <th>ID Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($peminjamans as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peminjaman->peminjaman_id }}</td>
                <td>{{ ucfirst($peminjaman->role) }}</td>
                <td>{{ $peminjaman->barang_id }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_kembali }}</td>
                <td>{{ $peminjaman->keterangan }}</td>
                <td>{{ $peminjaman->status ? 'Sudah dikembalikan' : 'Masih dipinjam' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align:center;">Tidak ada data</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>

