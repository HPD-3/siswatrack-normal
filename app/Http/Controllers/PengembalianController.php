<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PengembalianController extends Controller
{
    /**
     * Show peminjaman data in a table filtered by month and year.
     */
    public function index(Request $request)
    {
        [$month, $year, $selectedMonth, $selectedYear] = $this->resolveFilters($request);

        $peminjamans = $this->filteredPeminjamans($month, $year);

        return view('pengembalian.index', compact('peminjamans', 'month', 'year', 'selectedMonth', 'selectedYear'));
    }

    /**
     * Export filtered data to Excel or PDF based on `format` query param.
     */
    public function export(Request $request)
    {
        [$month, $year] = $this->resolveFilters($request);

        $filenameSuffix = ($month ? $month : 'all').'_'.($year ? $year : 'all');
        $format = strtolower($request->input('format', 'excel'));

        if ($format === 'pdf') {
            $peminjamans = $this->filteredPeminjamans($month, $year);
            $pdf = Pdf::loadView('pengembalian.pdf', compact('peminjamans', 'month', 'year'));

            return $pdf->download('pengembalian_'.$filenameSuffix.'.pdf');
        }

        return Excel::download(new PeminjamanExport($month, $year), 'pengembalian_'.$filenameSuffix.'.xlsx');
    }

    /**
     * Approve the return by updating the 'status' on peminjaman to true.
     */
    public function approveReturn($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = true;
        $peminjaman->save();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil disetujui.');
    }

    /**
     * Resolve month/year filters from request supporting both bahasa and english keys.
     */
    protected function resolveFilters(Request $request): array
    {
        $monthProvided = $request->has('bulan') || $request->has('month');
        $yearProvided = $request->has('tahun') || $request->has('year');

        $rawMonth = $request->input('bulan', $request->input('month'));
        $rawYear = $request->input('tahun', $request->input('year'));

        if (!$monthProvided) {
            $month = Carbon::now()->month;
            $selectedMonth = $month;
        } else {
            $month = ($rawMonth === null || $rawMonth === '') ? null : (int) $rawMonth;
            $selectedMonth = $rawMonth;
        }

        if (!$yearProvided) {
            $year = Carbon::now()->year;
            $selectedYear = $year;
        } else {
            $year = ($rawYear === null || $rawYear === '') ? null : (int) $rawYear;
            $selectedYear = $rawYear;
        }

        return [$month, $year, $selectedMonth, $selectedYear];
    }

    /**
     * Shared query builder for filtered peminjaman data.
     */
    protected function filteredPeminjamans(?int $month, ?int $year)
    {
        $query = Peminjaman::query()->orderBy('created_at', 'desc');

        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        return $query->get();
    }
}
