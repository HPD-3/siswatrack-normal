<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Categories;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('category')->get();
        return view('inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('inventory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang'   => 'required|string|max:255|unique:inventories,kode_barang',
            'nama_barang'   => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'deskripsi'     => 'nullable|string',
            'status'        => 'required|string|max:255',
            'lokasi_barang' => 'required|string|max:255',
            'is_active'     => 'required|boolean',
        ]);

        Inventory::create($validated);

        return redirect()->route('inventory.index')->with('success', 'Data Inventaris berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $categories = Categories::all();
        return view('inventory.edit', compact('inventory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'kode_barang'   => 'required|string|max:255|unique:inventories,kode_barang,' . $inventory->id,
            'nama_barang'   => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'deskripsi'     => 'nullable|string',
            'status'        => 'required|string|max:255',
            'lokasi_barang' => 'required|string|max:255',
            'is_active'     => 'required|boolean',
        ]);

        $inventory->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Data Inventaris berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventory.index')->with('success', 'Data Inventaris berhasil dihapus.');
    }
}
