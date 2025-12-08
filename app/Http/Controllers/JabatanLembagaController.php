<?php

namespace App\Http\Controllers;

use App\Models\JabatanLembaga;
use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class JabatanLembagaController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan eager loading
        $query = JabatanLembaga::with('lembaga');
        
        // SEARCH: Cari berdasarkan nama jabatan atau nama lembaga
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
        
        // Sorting
        $query->orderBy('level')
              ->orderBy('nama_jabatan');
        
        // PAGINATION: 10 data per halaman
        $jabatan = $query->paginate(10);
        
        // Tambahkan parameter filter ke pagination links
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
            'level' => 'required|integer|min:1|max:10'
        ]);

        JabatanLembaga::create($request->all());

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
            'level' => 'required|integer|min:1|max:10'
        ]);

        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan berhasil dihapus!');
    }
}