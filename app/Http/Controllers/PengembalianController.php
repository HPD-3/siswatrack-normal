<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    /**
     * Show all peminjaman data in a table.
     */
    public function index()
    {
        $peminjamans = Peminjaman::all();
        return view('pengembalian.index', compact('peminjamans'));
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
}
