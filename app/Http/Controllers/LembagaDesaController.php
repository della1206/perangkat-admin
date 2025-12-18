<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LembagaDesaController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = LembagaDesa::query();
        
        // PENCARIAN: Cari berdasarkan nama lembaga, ketua, atau kontak
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lembaga', 'like', "%{$search}%")
                  ->orWhere('ketua', 'like', "%{$search}%")
                  ->orWhere('kontak', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        
        // FILTER: Pengurutan
        $sort = $request->get('sort', 'nama_lembaga');
        $order = $request->get('order', 'asc');
        
        if (in_array($sort, ['nama_lembaga', 'ketua', 'kontak'])) {
            $query->orderBy($sort, $order);
        } else {
            $query->orderBy('nama_lembaga');
        }
        
        // PAGINASI: dengan per_page dari request
        $perPage = $request->get('per_page', 10);
        $lembaga = $query->paginate($perPage);
        
        // Tambahkan semua parameter filter ke tautan paginasi
        $lembaga->appends($request->except('page'));
        
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
            'ketua' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Unggah logo jika ada
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('lembaga/logo', 'public');
            $data['logo'] = $logoPath;
        }

        // Unggah banyak foto
        $fotos = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $path = $foto->store('lembaga/foto', 'public');
                $fotos[] = $path;
            }
            $data['foto'] = $fotos;
        }

        LembagaDesa::create($data);

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        return view('pages.lembaga_desa.show', compact('lembaga'));
    }

    public function edit($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        return view('pages.lembaga_desa.edit', compact('lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'ketua' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $lembaga = LembagaDesa::findOrFail($id);
        $data = $request->all();

        // Perbarui logo jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($lembaga->logo && Storage::disk('public')->exists($lembaga->logo)) {
                Storage::disk('public')->delete($lembaga->logo);
            }
            
            $logoPath = $request->file('logo')->store('lembaga/logo', 'public');
            $data['logo'] = $logoPath;
        } else {
            // Pertahankan logo lama jika tidak diperbarui
            $data['logo'] = $lembaga->logo;
        }

        // Perbarui foto jika ada
        $fotoSaatIni = $lembaga->foto ?: [];
        
        if ($request->hasFile('foto')) {
            // Unggah foto baru
            foreach ($request->file('foto') as $foto) {
                $path = $foto->store('lembaga/foto', 'public');
                $fotoSaatIni[] = $path;
            }
            $data['foto'] = $fotoSaatIni;
        } else {
            // Pertahankan foto lama
            $data['foto'] = $fotoSaatIni;
        }

        $lembaga->update($data);

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        
        // Hapus logo jika ada
        if ($lembaga->logo && Storage::disk('public')->exists($lembaga->logo)) {
            Storage::disk('public')->delete($lembaga->logo);
        }
        
        // Hapus semua foto jika ada
        $fotos = $lembaga->foto ?: [];
        foreach ($fotos as $foto) {
            if (Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
        }
        
        $lembaga->delete();

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil dihapus.');
    }

    // Hapus foto individu
    public function deleteFoto($id, $index)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        $fotos = $lembaga->foto ?: [];
        
        if (isset($fotos[$index])) {
            if (Storage::disk('public')->exists($fotos[$index])) {
                Storage::disk('public')->delete($fotos[$index]);
            }
            
            unset($fotos[$index]);
            $fotos = array_values($fotos); // Reset indeks
            
            $lembaga->update(['foto' => $fotos]);
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}