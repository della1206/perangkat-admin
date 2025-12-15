<?php

namespace App\Http\Controllers;

use App\Models\JabatanLembaga;
use App\Models\LembagaDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // DITAMBAHKAN

class JabatanLembagaController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan eager loading
        $query = JabatanLembaga::with('lembaga');
        
        // PENCARIAN: Cari berdasarkan nama jabatan atau nama lembaga
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_jabatan', 'like', "%{$search}%")
                  ->orWhereHas('lembaga', function($q2) use ($search) {
                      $q2->where('nama_lembaga', 'like', "%{$search}%");
                  });
            });
        }
        
        // FILTER: Berdasarkan lembaga
        if ($request->has('lembaga_id') && $request->lembaga_id != '') {
            $query->where('lembaga_id', $request->lembaga_id);
        }
        
        // FILTER: Berdasarkan level
        if ($request->has('level') && $request->level != '') {
            $query->where('level', $request->level);
        }
        
        // Pengurutan
        $query->orderBy('level')
              ->orderBy('nama_jabatan');
        
        // PAGINASI: 10 data per halaman
        $jabatan = $query->paginate(10);
        
        // Tambahkan parameter filter ke tautan paginasi
        if ($request->has('search')) {
            $jabatan->appends(['search' => $request->search]);
        }
        if ($request->has('lembaga_id')) {
            $jabatan->appends(['lembaga_id' => $request->lembaga_id]);
        }
        if ($request->has('level')) {
            $jabatan->appends(['level' => $request->level]);
        }
        
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        
        return view('pages.jabatan_lembaga.index', compact('jabatan', 'lembaga'));
    }

    public function create()
    {
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        return view('pages.jabatan_lembaga.create', compact('lembaga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:10',
            // Jika nanti ada upload logo jabatan, tambahkan:
            // 'logo_jabatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Contoh jika nanti ada upload logo jabatan:
        // if ($request->hasFile('logo_jabatan')) {
        //     $logoPath = $request->file('logo_jabatan')->store('jabatan/logo', 'public');
        //     $data['logo_jabatan'] = $logoPath;
        // }

        JabatanLembaga::create($data);

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan lembaga berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jabatan = JabatanLembaga::with('lembaga')->findOrFail($id);
        return view('pages.jabatan_lembaga.show', compact('jabatan'));
    }

    public function edit($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        return view('pages.jabatan_lembaga.edit', compact('jabatan', 'lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:10',
            // Jika nanti ada upload logo jabatan, tambahkan:
            // 'logo_jabatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $jabatan = JabatanLembaga::findOrFail($id);
        $data = $request->all();

        // Contoh jika nanti ada update logo jabatan:
        // if ($request->hasFile('logo_jabatan')) {
        //     // Hapus logo lama jika ada
        //     if ($jabatan->logo_jabatan && Storage::disk('public')->exists($jabatan->logo_jabatan)) {
        //         Storage::disk('public')->delete($jabatan->logo_jabatan);
        //     }
        //     
        //     $logoPath = $request->file('logo_jabatan')->store('jabatan/logo', 'public');
        //     $data['logo_jabatan'] = $logoPath;
        // } else {
        //     // Pertahankan logo lama jika tidak diupdate
        //     $data['logo_jabatan'] = $jabatan->logo_jabatan;
        // }

        $jabatan->update($data);

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        
        // Contoh jika nanti ada logo jabatan yang perlu dihapus:
        // if ($jabatan->logo_jabatan && Storage::disk('public')->exists($jabatan->logo_jabatan)) {
        //     Storage::disk('public')->delete($jabatan->logo_jabatan);
        // }
        
        $jabatan->delete();

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan berhasil dihapus!');
    }
}