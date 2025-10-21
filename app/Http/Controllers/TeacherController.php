<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the teachers.
     */
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Search logic (optional, adopt from SiswaController)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('Nip', 'like', "%{$search}%")
                ->orWhere('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('Jabatan', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%")
                ->orWhere('Email', 'like', "%{$search}%");
        }

        // Paginate results for better UX
        $teachers = $query->orderBy('nama_lengkap', 'asc')->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nip' => 'required|string|max:255|unique:teachers,Nip',
            'nama_lengkap' => 'required|string|max:255',
            'Jabatan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'Email' => 'required|string|email|max:255|unique:teachers,Email',
            'Alamat' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        Teacher::create([
            'Nip' => $request->Nip,
            'nama_lengkap' => $request->nama_lengkap,
            'Jabatan' => $request->Jabatan,
            'no_hp' => $request->no_hp,
            'Email' => $request->Email,
            'Alamat' => $request->Alamat,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * Display the specified teacher.
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified teacher.
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'Nip' => "required|string|max:255|unique:teachers,Nip,$id",
            'nama_lengkap' => 'required|string|max:255',
            'Jabatan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'Email' => "required|string|email|max:255|unique:teachers,Email,$id",
            'Alamat' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        $teacher->update([
            'Nip' => $request->Nip,
            'nama_lengkap' => $request->nama_lengkap,
            'Jabatan' => $request->Jabatan,
            'no_hp' => $request->no_hp,
            'Email' => $request->Email,
            'Alamat' => $request->Alamat,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil dihapus!');
    }
}
