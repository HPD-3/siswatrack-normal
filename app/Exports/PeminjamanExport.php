<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected ?int $month;
    protected ?int $year;

    public function __construct(?int $month = null, ?int $year = null)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection(): Collection
    {
        $query = Peminjaman::query()->orderBy('created_at');

        if ($this->month) {
            $query->whereMonth('created_at', $this->month);
        }

        if ($this->year) {
            $query->whereYear('created_at', $this->year);
        }

        return $query->get();
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->peminjaman_id,
            $peminjaman->role,
            $peminjaman->barang_id,
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali,
            $peminjaman->keterangan,
            $peminjaman->added_by,
            $peminjaman->status ? 'Sudah dikembalikan' : 'Masih dipinjam',
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Peminjaman',
            'Role',
            'Barang',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Keterangan',
            'Ditambahkan Oleh',
            'Status Pengembalian',
        ];
    }
}

