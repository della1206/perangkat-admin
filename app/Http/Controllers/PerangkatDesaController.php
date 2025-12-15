<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jabatan = $request->input('jabatan');

        $perangkat = PerangkatDesa::with('warga')
            ->search($search)
            ->filterJabatan($jabatan)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // PERBAIKAN: Ganti $daftarJabatan menjadi $jabatanList
        $jabatanList = PerangkatDesa::distinct()->pluck('jabatan');

        return view('pages.perangkat_desa.index', compact('perangkat', 'jabatanList'));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('pages.perangkat_desa.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        $data = $request->all();

        // Unggah foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
            $data['foto'] = $fotoPath;
        }

        PerangkatDesa::create($data);

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat desa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $perangkat = PerangkatDesa::with('warga')->findOrFail($id);
        return view('pages.perangkat_desa.show', compact('perangkat'));
    }

    public function edit($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();
        return view('pages.perangkat_desa.edit', compact('perangkat', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);

        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'jabatan' => 'required|string|max:100',
            'nip' => 'nullable|string|max:50',
            'kontak' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
        ]);

        $data = $request->all();

        // Unggah foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            
            $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
            $data['foto'] = $fotoPath;
        }

        $perangkat->update($data);

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        
        // Hapus foto jika ada
        if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
            Storage::disk('public')->delete($perangkat->foto);
        }
        
        $perangkat->delete();

        return redirect()->route('perangkat-desa.index')->with('success', 'Perangkat desa berhasil dihapus.');
    }
}