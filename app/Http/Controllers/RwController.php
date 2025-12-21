<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;

class RwController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan eager loading
        $query = Rw::with(['ketuaRw']);
        
        // SEARCH
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_rw', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('ketuaRw', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }
        
        // Sorting
        $sort = $request->get('sort', 'nomor_rw');
        $order = $request->get('order', 'asc');
        
        if (in_array($sort, ['nomor_rw', 'keterangan'])) {
            $query->orderBy($sort, $order);
        } else {
            $query->orderBy('nomor_rw', 'asc');
        }
        
        // Hitung jumlah RT per RW
        $query->withCount('rts');
        
        $rw = $query->paginate(10);
        
        return view('pages.rw.index', compact('rw'));
    }

    public function create()
    {
        // Ambil warga yang belum menjadi ketua RW
        $warga = Warga::whereNotIn('warga_id', function($query) {
            $query->select('ketua_rw_warga_id')
                  ->from('rw')
                  ->whereNotNull('ketua_rw_warga_id');
        })->orderBy('nama')->get();
        
        return view('pages.rw.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_rw' => 'required|string|max:10|unique:rw,nomor_rw',
            'ketua_rw_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string|max:255',
        ]);
        
        Rw::create($request->all());

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil ditambahkan.');
    }

    public function show($id)
    {
        $rw = Rw::with(['ketuaRw', 'rts', 'rts.ketuaRt'])->findOrFail($id);
        return view('pages.rw.show', compact('rw'));
    }

    public function edit($id)
    {
        $rw = Rw::with(['ketuaRw'])->findOrFail($id);
        
        // Ambil semua warga
        $allWarga = Warga::orderBy('nama')->get();
        
        // Ambil warga yang sudah menjadi ketua RW (kecuali ketua RW saat ini)
        $ketuaIds = Rw::whereNotNull('ketua_rw_warga_id')
                     ->where('ketua_rw_warga_id', '!=', $rw->ketua_rw_warga_id)
                     ->pluck('ketua_rw_warga_id')
                     ->toArray();
        
        // Filter warga: yang belum jadi ketua ATAU ketua saat ini
        $warga = $allWarga->filter(function($w) use ($ketuaIds, $rw) {
            return !in_array($w->warga_id, $ketuaIds) || 
                   $w->warga_id == $rw->ketua_rw_warga_id;
        });
        
        return view('pages.rw.edit', compact('rw', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $rw = Rw::findOrFail($id);
        
        $validated = $request->validate([
            'nomor_rw' => 'required|string|max:10|unique:rw,nomor_rw,' . $rw->rw_id . ',rw_id',
            'ketua_rw_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $rw->update($request->all());

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rw = Rw::findOrFail($id);
        $rw->delete();

        return redirect()->route('rw.index')
            ->with('success', 'Data RW berhasil dihapus.');
    }
}

//test