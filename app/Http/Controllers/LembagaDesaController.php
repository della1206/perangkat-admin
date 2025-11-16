<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class LembagaDesaController extends Controller
{
    public function index()
    {
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        return view('pages.lembaga_desa.index', compact('lembaga'));
    }

    public function create()
    {
        return view('pages.lembaga_desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50'
        ]);

        LembagaDesa::create($request->all());

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $lembaga = LembagaDesa::where('lembaga_id', $id)->firstOrFail();
        return view('pages.lembaga_desa.show', compact('lembaga'));
    }

    public function edit($id)
    {
        $lembaga = LembagaDesa::where('lembaga_id', $id)->firstOrFail();
        return view('pages.lembaga_desa.edit', compact('lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50'
        ]);

        $lembaga = LembagaDesa::where('lembaga_id', $id)->firstOrFail();
        $lembaga->update($request->all());

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lembaga = LembagaDesa::where('lembaga_id', $id)->firstOrFail();
        $lembaga->delete();

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil dihapus.');
    }
}
