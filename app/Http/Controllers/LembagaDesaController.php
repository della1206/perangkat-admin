<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LembagaDesa;

class LembagaDesaController extends Controller
{
    public function index() {
        $lembaga = LembagaDesa::all();
    return view('lembaga.index', compact('lembaga'));
    }

    public function create() {
        return view('lembaga.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_lembaga' => 'required',
            'ketua' => 'required|string',
            'kontak' => 'nullable|string',
            'deskripsi' => 'nullable|string'
        ]);
    LembagaDesa::create([
        'nama_lembaga' => $request->nama_lembaga,
        'ketua' => $request->ketua,
        'bidang' => $request->bidang ?? '-', // tambahkan default agar tidak null
        'kontak' => $request->kontak ?? null,
    ]);

    return redirect()->route('lembaga.index')
        ->with('success', 'Data lembaga berhasil ditambahkan');
}

    public function edit($id) {
        $lembaga = LembagaDesa::findOrFail($id);
        return view('lembaga.edit', compact('lembaga'));
    }

    public function update(Request $request, $id) {
        $lembaga = LembagaDesa::findOrFail($id);

        $request->validate([
              'nama_lembaga' => 'required',
                'kontak' => 'nullable|string',
                'deskripsi' => 'nullable|string',
                'ketua' => 'required|string'
        ]);

        $lembaga->update($request->all());
        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil diperbarui');
    }

    public function destroy($id) {
        $lembaga = LembagaDesa::findOrFail($id);
    $lembaga->delete();

    return redirect()->route('lembaga.index')
        ->with('success', 'Data lembaga berhasil dihapus!');
    }
}


