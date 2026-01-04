<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class RwController extends Controller
{
    public function index(Request $request)
    {
        // Validasi jika tabel RW belum ada
        if (!Schema::hasTable('rw')) {
            return redirect()->route('dashboard')
                ->with('error', 'Tabel RW belum tersedia. Silakan jalankan migration terlebih dahulu.');
        }

        // Query dasar dengan eager loading
        $query = Rw::with(['ketuaRw']);
        
        // SEARCH
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_rw', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('ketuaRw', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")
                         ->orWhere('no_ktp', 'like', "%{$search}%");
                  });
            });
        }
        
        // Sorting
        $sort = $request->get('sort', 'nomor_rw');
        $order = $request->get('order', 'asc');
        
        $allowedSort = ['nomor_rw', 'keterangan', 'created_at'];
        if (in_array($sort, $allowedSort)) {
            $query->orderBy($sort, $order);
        } else {
            $query->orderBy('nomor_rw', 'asc');
        }
        
        // Hitung jumlah RT per RW
        $query->withCount('rts');
        
        // PAGINATION
        $perPage = $request->get('per_page', 10);
        $rw = $query->paginate($perPage)->withQueryString();
        
        return view('pages.rw.index', compact('rw'));
    }

    public function create()
    {
        // Ambil warga yang belum menjadi ketua RW
        $warga = Warga::whereNotIn('warga_id', function($query) {
            $query->select('ketua_rw_warga_id')
                  ->from('rw')
                  ->whereNotNull('ketua_rw_warga_id');
        })
        ->orderBy('nama')
        ->get();
        
        // Jika tidak ada warga yang tersedia, ambil semua warga
        if ($warga->isEmpty()) {
            $warga = Warga::orderBy('nama')->get();
        }
        
        return view('pages.rw.create', compact('warga'));
    }

    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nomor_rw' => [
                'required',
                'string',
                'max:10',
                'unique:rw,nomor_rw',
                'regex:/^[0-9]+$/'
            ],
            'ketua_rw_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'nomor_rw.required' => 'Nomor RW wajib diisi.',
            'nomor_rw.unique' => 'Nomor RW sudah digunakan.',
            'nomor_rw.regex' => 'Nomor RW hanya boleh berisi angka.',
            'ketua_rw_warga_id.exists' => 'Warga yang dipilih tidak valid.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }
        
        // Cek apakah warga sudah menjadi ketua RW di RW lain
        if ($request->ketua_rw_warga_id) {
            $existingKetua = Rw::where('ketua_rw_warga_id', $request->ketua_rw_warga_id)->first();
            if ($existingKetua) {
                return redirect()->back()
                    ->withErrors(['ketua_rw_warga_id' => 'Warga ini sudah menjadi ketua RW di RW ' . $existingKetua->nomor_rw])
                    ->withInput();
            }
        }
        
        try {
            // Buat data RW
            Rw::create([
                'nomor_rw' => trim($request->nomor_rw),
                'ketua_rw_warga_id' => $request->ketua_rw_warga_id ?: null,
                'keterangan' => $request->keterangan ?: null,
            ]);
            
            return redirect()->route('rw.index')
                ->with('success', 'Data RW berhasil ditambahkan.');
                
        } catch (\Exception $e) {
            \Log::error('Error creating RW: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data RW. Error: ' . $e->getMessage())
                ->withInput();
        }
    }
//test
    public function show($id)
    {
        try {
            $rw = Rw::with(['ketuaRw', 'rts', 'rts.ketuaRt'])
                  ->withCount('rts')
                   ->findOrFail($id);
            
            // Hitung statistik
            $totalRT = $rw->rts_count ?? $rw->rts->count();
            $totalWarga = Warga::whereHas('rt', function($query) use ($rw) {
                $query->where('rw_id', $rw->rw_id);
            })->count();
            
            return view('pages.rw.show', compact('rw', 'totalRT', 'totalWarga'));
            
        } catch (\Exception $e) {
            return redirect()->route('rw.index')
                ->with('error', 'Data RW tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
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
            
        } catch (\Exception $e) {
            return redirect()->route('rw.index')
                ->with('error', 'Data RW tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rw = Rw::findOrFail($id);
            
            // Validasi
            $validator = Validator::make($request->all(), [
                'nomor_rw' => [
                    'required',
                    'string',
                    'max:10',
                    'unique:rw,nomor_rw,' . $rw->rw_id . ',rw_id',
                    'regex:/^[0-9]+$/'
                ],
                'ketua_rw_warga_id' => 'nullable|exists:warga,warga_id',
                'keterangan' => 'nullable|string|max:255',
            ], [
                'nomor_rw.required' => 'Nomor RW wajib diisi.',
                'nomor_rw.unique' => 'Nomor RW sudah digunakan.',
                'nomor_rw.regex' => 'Nomor RW hanya boleh berisi angka.',
                'ketua_rw_warga_id.exists' => 'Warga yang dipilih tidak valid.',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terjadi kesalahan validasi.');
            }
            
            // Cek apakah warga sudah menjadi ketua RW di RW lain (kecuali RW saat ini)
            if ($request->ketua_rw_warga_id && $request->ketua_rw_warga_id != $rw->ketua_rw_warga_id) {
                $existingKetua = Rw::where('ketua_rw_warga_id', $request->ketua_rw_warga_id)
                                  ->where('rw_id', '!=', $id)
                                  ->first();
                if ($existingKetua) {
                    return redirect()->back()
                        ->withErrors(['ketua_rw_warga_id' => 'Warga ini sudah menjadi ketua RW di RW ' . $existingKetua->nomor_rw])
                        ->withInput();
                }
            }
            
            // Update data
            $rw->update([
                'nomor_rw' => trim($request->nomor_rw),
                'ketua_rw_warga_id' => $request->ketua_rw_warga_id ?: null,
                'keterangan' => $request->keterangan ?: null,
            ]);
            
            return redirect()->route('rw.index')
                ->with('success', 'Data RW berhasil diperbarui.');
                
        } catch (\Exception $e) {
            \Log::error('Error updating RW: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data RW. Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $rw = Rw::findOrFail($id);
            
            // Cek apakah RW memiliki RT
            if ($rw->rts()->exists()) {
                return redirect()->route('rw.index')
                    ->with('error', 'Tidak dapat menghapus RW karena masih memiliki data RT. Hapus terlebih dahulu data RT yang terkait.');
            }
            
            $rw->delete();
            
            return redirect()->route('rw.index')
                ->with('success', 'Data RW berhasil dihapus.');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting RW: ' . $e->getMessage());
            
            return redirect()->route('rw.index')
                ->with('error', 'Gagal menghapus data RW. Error: ' . $e->getMessage());
        }
    }
    
    /**
     * API untuk mengambil data RW (untuk dropdown di form RT, dll)
     */
    public function getRwList()
    {
        $rwList = Rw::orderBy('nomor_rw')->get(['rw_id', 'nomor_rw']);
        return response()->json($rwList);
    }
    
    /**
     * Validasi nomor RW unik
     */
    public function checkNomorRw(Request $request)
    {
        $exists = Rw::where('nomor_rw', $request->nomor_rw)
                    ->when($request->id, function($query, $id) {
                        return $query->where('rw_id', '!=', $id);
                    })
                    ->exists();
                    
        return response()->json(['available' => !$exists]);
    }
}