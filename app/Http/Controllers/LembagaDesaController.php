<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class LembagaDesaController extends Controller
{
    public function index(Request $request)
    {
<<<<<<< HEAD
        $searchableColumns = ['nama_lembaga', 'deskripsi', 'kontak'];
        
        $lembaga = LembagaDesa::search($request, $searchableColumns)
                    ->orderBy('nama_lembaga')
                    ->paginate(10)
                    ->withQueryString();

=======
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->paginate(10);
>>>>>>> 69431c22075e6e06bc46eb911ace1883b6ca516a
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
        'ketua' => 'required|string|max:100', // TAMBAH INI
        'deskripsi' => 'nullable|string',
        'kontak' => 'nullable|string|max:50'
    ]);

    LembagaDesa::create($request->all());

    return redirect()->route('lembaga.index')
        ->with('success', 'Lembaga desa berhasil ditambahkan.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_lembaga' => 'required|string|max:100',
        'ketua' => 'required|string|max:100', // TAMBAH INI
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