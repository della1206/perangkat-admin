<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index() {
        $warga = Warga::all();
        return view('pages.warga.index', compact('warga'));
    }

    public function create() {
        return view('pages.warga.create');
    }

    public function store(Request $request) {
        $request->validate([
            'no_ktp' => 'required|unique:warga|max:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255'
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
    }

    public function edit($id) {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id) {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp' => [
                'required',
                Rule::unique('warga')->ignore($warga->warga_id, 'warga_id')
            ],
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255'
        ]);

        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui');
    }

    public function destroy($id) {
        Warga::destroy($id);
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }
}
