<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan form peminjaman.
     */
    public function index()
    {
        $inventories = Inventory::all();

        return view('peminjaman.index', compact('inventories'));
    }

    /**
     * Menyimpan data peminjaman ke database.
     */
    public function store(Request $request)
    {
        // Ambil role dari input dengan berbagai variasi case (lowercase untuk konsistensi)
        $roleInput = strtolower($request->input('role', ''));

        // Custom messages for validation
        $messages = [
            'nama_barang.required' => 'Kolom nama barang wajib diisi.',
            'nama_barang.exists' => 'Barang yang dipilih tidak ditemukan dalam inventory.',
        ];

        // Validasi sesuai skema kolom tabel peminjaman
        $validated = $request->validate([
            'role' => 'required|in:siswa,guru,staff',
            'peminjaman_id' => 'required|string|max:50',
            'nama_barang' => 'required|string|exists:inventories,nama_barang',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string|max:255',
            'added_by' => 'required|string|max:255',
        ], $messages);

        $role = strtolower($validated['role']);
        $peminjamanId = $validated['peminjaman_id'];
        $namaBarang = $validated['nama_barang'];

        // Validasi ID peminjam sesuai role
        $peminjamData = null;
        if ($role === 'siswa') {
            // Di frontend user diminta masukkan NISN (berdasar cekId)
            $peminjamData = Siswa::where('nisn', $peminjamanId)->first();
        } elseif ($role === 'guru') {
            // Di frontend user diminta masukkan NIP (berdasar cekId)
            $peminjamData = Teacher::where('Nip', $peminjamanId)->first();
        } else {
            // Staff tidak divalidasi database (anggap always valid inputnya)
            $peminjamData = true;
        }

        if (($role !== 'staff') && !$peminjamData) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['peminjaman_id' => 'ID Peminjam tidak ditemukan pada data ' . ucfirst($role)]);
        }

        // Validasi nama barang benar2 ada
        if (empty($namaBarang)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_barang' => 'Kolom nama barang wajib diisi.']);
        }
        $barang = Inventory::where('nama_barang', $namaBarang)->first();
        if (!$barang) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_barang' => 'Barang tidak ditemukan di inventory.']);
        }

        // Simpan data ke tabel peminjaman
        Peminjaman::create([
            'role' => $role,
            'peminjaman_id' => $peminjamanId,
            'barang_id' => $barang->id,
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'keterangan' => $validated['keterangan'] ?? null,
            'added_by' => $validated['added_by'] ?? (Auth::user()->name ?? (string) Auth::id()),
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan!');
    }

    /**
     * AJAX endpoint untuk cek id peminjam.
     */
    public function cekId($role, $id)
    {
        $role = strtolower($role);
        if ($role === 'student' || $role === 'siswa') {
            $data = Siswa::where('nisn', $id)->first();
        } elseif ($role === 'teacher' || $role === 'guru') {
            $data = Teacher::where('Nip', $id)->first();
        } else {
            return response()->json(['valid' => false]);
        }

        if ($data) {
            return response()->json(['valid' => true, 'data' => $data]);
        }

        return response()->json(['valid' => false]);
    }

    public function cekBarang($nama_barang)
    {
        $data = Inventory::with('category')
            ->where('nama_barang', $nama_barang)
            ->orWhere('nama_barang', 'like', "%{$nama_barang}%")
            ->first();

        if ($data) {
            return response()->json([
                'valid' => true,
                'data' => [
                    'nama_barang' => $data->nama_barang,
                    'kategori' => $data->category ? ($data->category->nama_kategori ?? '-') : '-',
                    'kondisi' => $data->kondisi ?? '-',
                    'lokasi' => $data->lokasi_barang ?? '-',
                    'id' => $data->id ?? null // jika ingin frontend pakai id
                ]
            ]);
        }

        return response()->json(['valid' => false, 'message' => 'Barang tidak ditemukan.']);
    }
}
