<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use App\Models\Media;
use Illuminate\Http\Request;

class LembagaDesaController extends Controller
{
    public function index(Request $request)
    {
        $lembaga = LembagaDesa::with('media')
            ->orderBy('nama_lembaga')
            ->paginate(10)        // PAGINATE 10 DATA PER HALAMAN
            ->withQueryString();  // BIAR PAGING TETAP BAWA QUERY (KALO ADA PENCARIAN)

        return view('pages.lembaga_desa.index', compact('lembaga'));
    }

    public function create()
    {
        return view('pages.lembaga_desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lembaga' => 'required',
            'deskripsi'    => 'nullable',
            'kontak'       => 'nullable',
            'media.*'      => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // 1. Simpan lembaga
        $lembaga = LembagaDesa::create([
            'nama_lembaga' => $request->nama_lembaga,
            'deskripsi'    => $request->deskripsi,
            'kontak'       => $request->kontak,
        ]);

        // 2. Upload hanya 1 file (file pertama)
        if ($request->hasFile('media')) {

            $file = $request->file('media')[0];

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            Media::create([
                'ref_table' => 'lembaga',
                'ref_id'    => $lembaga->lembaga_id,
                'file_name' => $fileName,
                'caption'   => 'logo',
                'mime_type' => $file->getClientMimeType(),
                'sort_order'=> 1
            ]);
        }

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga berhasil ditambahkan');
    }

    public function show($id)
    {
        $lembaga = LembagaDesa::with('media')->findOrFail($id);

        return view('pages.lembaga_desa.show', compact('lembaga'));
    }

    public function edit($id)
    {
        $lembaga = LembagaDesa::with('media')->findOrFail($id);

        return view('pages.lembaga_desa.edit', compact('lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lembaga' => 'required',
            'deskripsi'    => 'nullable',
            'kontak'       => 'nullable',
            'media.*'      => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $lembaga = LembagaDesa::findOrFail($id);

        // Update basic data
        $lembaga->update([
            'nama_lembaga' => $request->nama_lembaga,
            'deskripsi'    => $request->deskripsi,
            'kontak'       => $request->kontak,
        ]);

        // Upload file baru
        if ($request->hasFile('media')) {

            // Hapus media lama
            $oldMedia = Media::where('ref_table', 'lembaga')
                ->where('ref_id', $id)
                ->first();

            if ($oldMedia) {
                $filePath = public_path('uploads/' . $oldMedia->file_name);
                if (file_exists($filePath)) unlink($filePath);
                $oldMedia->delete();
            }

            // Upload file baru
            $file = $request->file('media')[0];

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            Media::create([
                'ref_table' => 'lembaga',
                'ref_id'    => $id,
                'file_name' => $fileName,
                'caption'   => 'logo',
                'mime_type' => $file->getClientMimeType(),
                'sort_order'=> 1
            ]);
        }

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);

        // Hapus semua media
        foreach ($lembaga->media as $m) {
            $filePath = public_path('uploads/' . $m->file_name);
            if (file_exists($filePath)) unlink($filePath);
            $m->delete();
        }

        // Hapus lembaga
        $lembaga->delete();

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga berhasil dihapus');
    }
}
