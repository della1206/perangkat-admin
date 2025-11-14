<?php

namespace App\Http\Controllers;

use App\Models\JabatanLembaga;
use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class JabatanLembagaController extends Controller
{
    public function index()
    {
        $jabatan = JabatanLembaga::with('lembaga')->get();
        return view('pages.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        // FIX — ganti Lembaga menjadi LembagaDesa
        $lembaga = LembagaDesa::all();
        return view('pages.jabatan.create', compact('lembaga'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_jabatan' => 'required|string|max:255'
    ]);

    Jabatan::create([
        'nama_jabatan' => $request->nama_jabatan
    ]);

    return redirect()->route('jabatan.index')
                     ->with('success', 'Data jabatan berhasil ditambahkan!');
}

    public function edit($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $lembaga = LembagaDesa::all();

        return view('pages.jabatan.edit', compact('jabatan', 'lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lembaga_id' => 'required',
            'nama_jabatan' => 'required',
            'level' => 'required|integer',
        ]);

        $jabatan = JabatanLembaga::findOrFail($id);

        $jabatan->update([
            'lembaga_id'   => $request->lembaga_id,
            'nama_jabatan' => $request->nama_jabatan,
            'level'        => $request->level,
        ]);

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil diupdate');
    }

    public function destroy($id)
    {
        JabatanLembaga::findOrFail($id)->delete();

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus');
    }
}
