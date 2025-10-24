<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index() {
        $warga = Warga::all();
        return view('warga.index', compact('warga'));
    }

    public function create() {
        return view('warga.create');
    }

    public function store(Request $request) {
        $request->validate([
            'no_ktp' => 'required|unique:warga',
            'nama' => 'required',
            'jenis_kelamin' => 'nullable',
            'agama' => 'required',
            'pekerjaan' => 'required'
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
    }

    public function edit($id) {
        $warga = Warga::findOrFail($id);
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, $id) {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required'
        ]);

        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui');
    }

    public function destroy($id) {
        Warga::destroy($id);
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }
}
