<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class LembagaDesaController extends Controller
{
    public function index()
    {
        $lembagas = LembagaDesa::all();
<<<<<<< HEAD
        return view('pages.lembaga.index', compact('lembagas'));
=======
        return view('lembaga.index', compact('lembagas'));
>>>>>>> 0b0f6c7eab133f3a92c051b30a4b878e479e7405
    }

    public function create()
    {
<<<<<<< HEAD
        return view('pages.lembaga.create');
=======
        return view('lembaga.create');
>>>>>>> 0b0f6c7eab133f3a92c051b30a4b878e479e7405
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string',
            'ketua' => 'required|string',
            'bidang' => 'nullable|string',
            'kontak' => 'nullable|string',
            'deskripsi' => 'nullable|string',
<<<<<<< HEAD
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
        return redirect()->route('pages.lembaga.index')->with('success', 'Data lembaga desa berhasil dihapus.');
=======
        ]);

        LembagaDesa::create($validated);

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        return view('lembaga.edit', compact('lembaga'));
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
>>>>>>> 0b0f6c7eab133f3a92c051b30a4b878e479e7405
    }
}
