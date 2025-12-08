<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index(Request $request) {
        // Query dasar
        $query = Warga::query();
        
        // SEARCH: Cari berdasarkan nama, no_ktp, email, telp
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telp', 'like', "%{$search}%");
            });
        }
        
        // FILTER: Jenis Kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        
        // FILTER: Agama
        if ($request->has('agama') && $request->agama != '') {
            $query->where('agama', $request->agama);
        }
        
        // PAGINATION: 10 data per halaman
        $warga = $query->paginate(10);
        
        // Tambahkan parameter filter ke pagination links
        if ($request->has('search')) {
            $warga->appends(['search' => $request->search]);
        }
        if ($request->has('jenis_kelamin')) {
            $warga->appends(['jenis_kelamin' => $request->jenis_kelamin]);
        }
        if ($request->has('agama')) {
            $warga->appends(['agama' => $request->agama]);
        }
        
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
                'max:16',
                Rule::unique('warga')->ignore($warga->id)
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
        $warga = Warga::findOrFail($id);
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }
}