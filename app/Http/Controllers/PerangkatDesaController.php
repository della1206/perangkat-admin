<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $data = PerangkatDesa::with('media')
            ->orderBy('perangkat_id', 'DESC')
            ->paginate(10);

        return view('pages.perangkat_desa.index', compact('data'));
    }

    public function create()
    {
        return view('pages.perangkat_desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            'kontak' => 'nullable',
            'media.*' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Buat data perangkat baru
        $pd = PerangkatDesa::create([
            'jabatan' => $request->jabatan,
            'kontak'  => $request->kontak
        ]);

        // Upload foto jika ada
        if ($request->hasFile('media')) {

            // Ambil hanya file pertama
            $file = $request->file('media')[0];
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->move(public_path('uploads/perangkat_desa'), $fileName);

            // Simpan ke tabel media
            Media::create([
                'ref_table' => 'perangkat_desa',
                'ref_id'    => $pd->perangkat_id,
                'file_name' => $fileName,
                'caption'   => 'foto perangkat desa',
                'mime_type' => $file->getClientMimeType()
            ]);
        }

        return redirect()->route('perangkat_desa.index')->with('success', 'Perangkat desa berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = PerangkatDesa::with('media')->findOrFail($id);
        return view('pages.perangkat_desa.show', compact('data'));
    }

    public function edit($id)
    {
        $data = PerangkatDesa::with('media')->findOrFail($id);
        return view('pages.perangkat_desa.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan' => 'required',
            'kontak'  => 'nullable',
            'media.*' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $pd = PerangkatDesa::findOrFail($id);

        // update data
        $pd->update([
            'jabatan' => $request->jabatan,
            'kontak'  => $request->kontak
        ]);

        // Jika ada file baru
        if ($request->hasFile('media')) {

            // Hapus media lama (di folder + database)
            $oldMedia = Media::where('ref_table', 'perangkat_desa')
                ->where('ref_id', $id)
                ->first();

            if ($oldMedia) {

                $oldPath = public_path('uploads/perangkat_desa/' . $oldMedia->file_name);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                // Hapus database
                $oldMedia->delete();
            }

            // Upload file baru
            $file = $request->file('media')[0];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/perangkat_desa'), $fileName);

            // Simpan media baru
            Media::create([
                'ref_table' => 'perangkat_desa',
                'ref_id'    => $id,
                'file_name' => $fileName,
                'caption'   => 'foto perangkat desa',
                'mime_type' => $file->getClientMimeType()
            ]);
        }

        return redirect()->route('perangkat_desa.index')->with('success', 'Data perangkat desa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pd = PerangkatDesa::with('media')->findOrFail($id);

        // Hapus semua media terkait
        foreach ($pd->media as $m) {

            $path = public_path('uploads/perangkat_desa/' . $m->file_name);

            if (File::exists($path)) {
                File::delete($path);
            }

            $m->delete();
        }

        // Hapus perangkat desa
        $pd->delete();

        return redirect()->route('perangkat_desa.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
