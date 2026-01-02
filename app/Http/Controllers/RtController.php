<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RtController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah tabel rt ada
        if (!Schema::hasTable('rt')) {
            return redirect()->route('dashboard')
                ->with('error', 'Tabel RT belum tersedia. Silakan jalankan migration terlebih dahulu.');
        }

        // Query dasar dengan eager loading
        $query = Rt::with(['rw', 'ketuaRt']);
        
        // SEARCH: Cari berdasarkan nomor RT, keterangan, nama ketua, atau nomor RW
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_rt', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('ketuaRt', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  })
                  ->orWhereHas('rw', function($q2) use ($search) {
                      $q2->where('nomor_rw', 'like', "%{$search}%");
                  });
            });
        }
        
        // FILTER: Berdasarkan RW
        if ($request->has('rw_id') && $request->rw_id != '') {
            $query->where('rw_id', $request->rw_id);
        }
        
        // Sorting
        $sort = $request->get('sort', 'nomor_rt');
        $order = $request->get('order', 'asc');
        
        if (in_array($sort, ['nomor_rt', 'keterangan'])) {
            $query->orderBy($sort, $order);
        } else {
            $query->orderBy('nomor_rt', 'asc');
        }
        
        // PAGINATION: 10 data per halaman
        $rt = $query->paginate(10);
        
        // Ambil data RW untuk dropdown filter
        try {
            $rwList = Rw::orderBy('nomor_rw')->get();
        } catch (\Exception $e) {
            $rwList = collect();
        }
        
        // Tambahkan parameter filter ke pagination links
        if ($request->has('search')) {
            $rt->appends(['search' => $request->search]);
        }
        if ($request->has('rw_id')) {
            $rt->appends(['rw_id' => $request->rw_id]);
        }
        
        return view('pages.rt.index', compact('rt', 'rwList'));
    }

    public function create()
    {
        // Ambil data RW
        try {
            $rwList = Rw::orderBy('nomor_rw')->get();
        } catch (\Exception $e) {
            $rwList = collect();
        }
        
        // PERBAIKAN: Ambil SEMUA warga (tanpa filter status_warga)
        $warga = Warga::orderBy('nama')->get();
        
        // Debug: cek apakah ada data warga
        if ($warga->isEmpty()) {
            \Log::warning('Tidak ada data warga di database');
        }
        
        return view('pages.rt.create', compact('rwList', 'warga'));
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'rw_id' => 'required|exists:rw,rw_id',
            'nomor_rt' => 'required|string|max:10',
            'ketua_rt_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string|max:255',
        ]);
        
        // Validasi nomor RT unik per RW
        $exists = Rt::where('rw_id', $request->rw_id)
                    ->where('nomor_rt', $request->nomor_rt)
                    ->exists();
        
        if ($exists) {
            return back()->withErrors(['nomor_rt' => 'Nomor RT sudah ada untuk RW ini'])->withInput();
        }
        
        // Validasi: Warga hanya bisa menjadi ketua RT di satu RT
        if ($request->ketua_rt_warga_id) {
            $isAlreadyKetua = Rt::where('ketua_rt_warga_id', $request->ketua_rt_warga_id)->exists();
            if ($isAlreadyKetua) {
                $warga = Warga::find($request->ketua_rt_warga_id);
                return back()->withErrors([
                    'ketua_rt_warga_id' => "Warga {$warga->nama} sudah menjadi ketua RT di RT lain"
                ])->withInput();
            }
        }
        
        // Buat data RT
        try {
            Rt::create([
                'rw_id' => $request->rw_id,
                'nomor_rt' => $request->nomor_rt,
                'ketua_rt_warga_id' => $request->ketua_rt_warga_id ?: null,
                'keterangan' => $request->keterangan,
            ]);
            
            return redirect()->route('rt.index')
                ->with('success', 'Data RT berhasil ditambahkan.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $rt = Rt::with(['rw', 'ketuaRt'])->findOrFail($id);
        return view('pages.rt.show', compact('rt'));
    }

    public function edit($id)
    {
        $rt = Rt::with(['ketuaRt'])->findOrFail($id);
        
        // Ambil data RW
        $rwList = Rw::orderBy('nomor_rw')->get();
        
        // PERBAIKAN: Ambil SEMUA warga (tanpa filter status_warga)
        $warga = Warga::orderBy('nama')->get();
        
        return view('pages.rt.edit', compact('rt', 'rwList', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $rt = Rt::findOrFail($id);
        
        // Validasi
        $validated = $request->validate([
            'rw_id' => 'required|exists:rw,rw_id',
            'nomor_rt' => 'required|string|max:10',
            'ketua_rt_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string|max:255',
        ]);
        
        // Validasi nomor RT unik per RW (kecuali untuk RT saat ini)
        $exists = Rt::where('rw_id', $request->rw_id)
                    ->where('nomor_rt', $request->nomor_rt)
                    ->where('rt_id', '!=', $id)
                    ->exists();
        
        if ($exists) {
            return back()->withErrors(['nomor_rt' => 'Nomor RT sudah ada untuk RW ini'])->withInput();
        }

        // Validasi: Warga hanya bisa menjadi ketua RT di satu RT (kecuali untuk RT saat ini)
        if ($request->ketua_rt_warga_id && $request->ketua_rt_warga_id != $rt->ketua_rt_warga_id) {
            $isAlreadyKetua = Rt::where('ketua_rt_warga_id', $request->ketua_rt_warga_id)
                                ->where('rt_id', '!=', $id)
                                ->exists();
            if ($isAlreadyKetua) {
                $warga = Warga::find($request->ketua_rt_warga_id);
                return back()->withErrors([
                    'ketua_rt_warga_id' => "Warga {$warga->nama} sudah menjadi ketua RT di RT lain"
                ])->withInput();
            }
        }

        // Update data RT
        try {
            $rt->update([
                'rw_id' => $request->rw_id,
                'nomor_rt' => $request->nomor_rt,
                'ketua_rt_warga_id' => $request->ketua_rt_warga_id ?: null,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('rt.index')
                ->with('success', 'Data RT berhasil diperbarui.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $rt = Rt::findOrFail($id);
            $rt->delete();

            return redirect()->route('rt.index')
                ->with('success', 'Data RT berhasil dihapus.');
                
        } catch (\Exception $e) {
            return redirect()->route('rt.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}