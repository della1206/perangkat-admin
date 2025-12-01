<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = PerangkatDesa::with('media');

        if ($request->search) {
            $query->where('jabatan', 'like', '%' . $request->search . '%')
                  ->orWhere('warga_id', 'like', '%' . $request->search . '%');
        }

        $data = $query->paginate(10);

        return view('pages.perangkat_desa.index', compact('data'));
    }

    public function create()
    {
        return view('pages.perangkat_desa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id'   => 'required',
            'jabatan'    => 'required',
            'kontak'     => 'nullable',
            'foto.*'     => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // SIMPAN DATA PERANGKAT DESA
        $perangkat = PerangkatDesa::create($validated);

        // JIKA ADA FOTO, SIMPAN KE MEDIA
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $i => $file) {
                $fileName = time() . "_" . rand(100, 999) . "." . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads/perangkat_desa', $fileName);

                Media::create([
                    'ref_table' => 'perangkat_desa',
                    'ref_id'    => $perangkat->perangkat_id,
                    'file_name' => $fileName,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('perangkat_desa.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = PerangkatDesa::with('media')->findOrFail($id);
        return view('pages.perangkat_desa.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'warga_id'   => 'required',
            'jabatan'    => 'required',
            'kontak'     => 'nullable',
            'foto.*'     => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $perangkat = PerangkatDesa::findOrFail($id);
        $perangkat->update($validated);

        // TAMBAH FOTO BARU SAAT EDIT
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $i => $file) {
                $fileName = time() . "_" . rand(100, 999) . "." . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads/perangkat_desa', $fileName);

                Media::create([
                    'ref_table' => 'perangkat_desa',
                    'ref_id'    => $perangkat->perangkat_id,
                    'file_name' => $fileName,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('perangkat_desa.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perangkat = PerangkatDesa::with('media')->findOrFail($id);

        // HAPUS FILE DARI STORAGE
        foreach ($perangkat->media as $m) {
            Storage::delete('public/uploads/perangkat_desa/' . $m->file_name);
            $m->delete();
        }

        // HAPUS DATA PERANGKAT
        $perangkat->delete();

        return redirect()->route('perangkat_desa.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
