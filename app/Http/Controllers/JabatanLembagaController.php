<?php

namespace App\Http\Controllers;

use App\Models\JabatanLembaga;
use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class JabatanLembagaController extends Controller
{
    public function index()
    {
        $jabatan = JabatanLembaga::with('lembaga')
            ->orderBy('level')
            ->orderBy('nama_jabatan')
            ->get();
        return view('pages.jabatan_lembaga.index', compact('jabatan'));
    }

    public function create()
    {
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        return view('pages.jabatan_lembaga.create', compact('lembaga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:10'
        ]);

        JabatanLembaga::create($request->all());

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan lembaga berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jabatan = JabatanLembaga::with('lembaga')->findOrFail($id);
        return view('pages.jabatan_lembaga.show', compact('jabatan'));
    }

    public function edit($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        return view('pages.jabatan_lembaga.edit', compact('jabatan', 'lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:10'
        ]);

        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->delete();

  return redirect()->route('jabatan-lembaga.index')
    ->with('success', 'Jabatan berhasil dihapus!');
    }
}
