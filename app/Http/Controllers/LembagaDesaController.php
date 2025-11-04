<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class LembagaDesaController extends Controller
{
    public function index()
    {
        $lembagas = LembagaDesa::all();
        return view('pages.lembaga.index', compact('lembagas'));
    }

    public function create()
    {
        return view('pages.lembaga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string',
            'ketua' => 'required|string',
            'bidang' => 'nullable|string',
            'kontak' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        LembagaDesa::create($validated);

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        return view('pages.lembaga.edit', compact('lembaga'));
    }

    public function update(Request $request, $id)
    {
        $lembaga = LembagaDesa::findOrFail($id);

        $validated = $request->validate([
            'nama_lembaga' => 'required|string',
            'ketua' => 'required|string',
            'bidang' => 'nullable|string',
            'kontak' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $lembaga->update($validated);

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        LembagaDesa::destroy($id);
        return redirect()->route('lembaga.index')->with('success', 'Data lembaga desa berhasil dihapus.');
    }
}
