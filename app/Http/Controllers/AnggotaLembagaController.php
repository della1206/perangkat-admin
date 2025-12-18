<?php

namespace App\Http\Controllers;

use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\Warga;
use App\Models\JabatanLembaga;
use Illuminate\Http\Request;

class AnggotaLembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AnggotaLembaga::with(['lembaga', 'warga', 'jabatan']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('warga', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%");
            });
        }

        // Sorting
        $sort  = $request->get('sort', 'anggota_id');
        $order = $request->get('order', 'desc');

        $query->orderBy($sort, $order);

        $anggota = $query->paginate(10);

        return view('pages.anggota-lembaga.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.anggota-lembaga.create', [
            'lembagas' => LembagaDesa::all(),
            'wargas'   => Warga::all(),
            'jabatans' => JabatanLembaga::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lembaga_id'  => 'required|exists:lembaga_desa,lembaga_id',
            'warga_id'    => 'required|exists:warga,warga_id',
            'jabatan_id'  => 'required|exists:jabatan_lembaga,jabatan_id',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'nullable|date|after_or_equal:tgl_mulai',
        ]);

        AnggotaLembaga::create([
            'lembaga_id'  => $request->lembaga_id,
            'warga_id'    => $request->warga_id,
            'jabatan_id'  => $request->jabatan_id,
            'tgl_mulai'   => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        return redirect()
            ->route('anggota-lembaga.index')
            ->with('success', 'Anggota lembaga berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pages.anggota-lembaga.edit', [
            'anggotaLembaga' => AnggotaLembaga::findOrFail($id),
            'lembagas'       => LembagaDesa::all(),
            'wargas'         => Warga::all(),
            'jabatans'       => JabatanLembaga::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lembaga_id'  => 'required|exists:lembaga_desa,lembaga_id',
            'warga_id'    => 'required|exists:warga,warga_id',
            'jabatan_id'  => 'required|exists:jabatan_lembaga,jabatan_id',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'nullable|date|after_or_equal:tgl_mulai',
        ]);

        $anggotaLembaga = AnggotaLembaga::findOrFail($id);

        $anggotaLembaga->update([
            'lembaga_id'  => $request->lembaga_id,
            'warga_id'    => $request->warga_id,
            'jabatan_id'  => $request->jabatan_id,
            'tgl_mulai'   => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        return redirect()
            ->route('anggota-lembaga.index')
            ->with('success', 'Data anggota lembaga berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AnggotaLembaga::findOrFail($id)->delete();

        return redirect()
            ->route('anggota-lembaga.index')
            ->with('success', 'Data anggota lembaga berhasil dihapus');
    }
}
