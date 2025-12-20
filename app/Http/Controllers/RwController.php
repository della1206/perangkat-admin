<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RwController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah tabel rw ada
        try {
            $rw = Rw::with(['ketuaRw'])->orderBy('nomor_rw')->paginate(10);
        } catch (\Exception $e) {
            // Jika tabel tidak ada, buat collection kosong
            $rw = collect()->paginate(10);
        }
        
        return view('pages.rw.index', compact('rw'));
    }

    public function create()
    {
        // Ambil semua warga (tanpa filter karena tabel rw mungkin tidak ada)
        $warga = Warga::orderBy('nama')->get();
        
        return view('pages.rw.create', compact('warga'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'nomor_rw' => 'required|string|max:10',
            'ketua_rw_warga_id' => 'nullable|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);
        
        // Validasi manual untuk unique
        try {
            // Cek apakah nomor_rw sudah ada
            $exists = Rw::where('nomor_rw', $request->nomor_rw)->exists();
            if ($exists) {
                return back()->withErrors(['nomor_rw' => 'Nomor RW sudah terdaftar'])->withInput();
            }
        } catch (\Exception $e) {
            // Jika tabel tidak ada, skip validasi unique
        }
        
        // Cek apakah warga ada
        if ($request->ketua_rw_warga_id && !Warga::where('warga_id', $request->ketua_rw_warga_id)->exists()) {
            return back()->withErrors(['ketua_rw_warga_id' => 'Warga tidak ditemukan'])->withInput();
        }
        
        try {
            Rw::create([
                'nomor_rw' => $request->nomor_rw,
                'ketua_rw_warga_id' => $request->ketua_rw_warga_id,
                'keterangan' => $request->keterangan,
            ]);
            
            return redirect()->route('rw.index')
                ->with('success', 'Data RW berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('rw.index')
                ->with('error', 'Gagal menambahkan data RW. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $rw = Rw::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('rw.index')
                ->with('error', 'Data RW tidak ditemukan.');
        }
        
        // Ambil semua warga
        $warga = Warga::orderBy('nama')->get();
        
        return view('pages.rw.edit', compact('rw', 'warga'));
    }

    public function update(Request $request, $id)
    {
        try {
            $rw = Rw::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('rw.index')
                ->with('error', 'Data RW tidak ditemukan.');
        }
        
        // Validasi dasar
        $request->validate([
            'nomor_rw' => 'required|string|max:10',
            'ketua_rw_warga_id' => 'nullable|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);
        
        // Validasi manual untuk unique (kecuali data saat ini)
        try {
            $exists = Rw::where('nomor_rw', $request->nomor_rw)
                       ->where('rw_id', '!=', $id)
                       ->exists();
            if ($exists) {
                return back()->withErrors(['nomor_rw' => 'Nomor RW sudah digunakan oleh RW lain'])->withInput();
            }
        } catch (\Exception $e) {
            // Jika tabel tidak ada, skip validasi unique
        }
        
        // Cek apakah warga ada
        if ($request->ketua_rw_warga_id && !Warga::where('warga_id', $request->ketua_rw_warga_id)->exists()) {
            return back()->withErrors(['ketua_rw_warga_id' => 'Warga tidak ditemukan'])->withInput();
        }
        
        try {
            $rw->update([
                'nomor_rw' => $request->nomor_rw,
                'ketua_rw_warga_id' => $request->ketua_rw_warga_id,
                'keterangan' => $request->keterangan,
            ]);
            
            return redirect()->route('rw.index')
                ->with('success', 'Data RW berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('rw.index')
                ->with('error', 'Gagal memperbarui data RW. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $rw = Rw::findOrFail($id);
            $rw->delete();
            
            return redirect()->route('rw.index')
                ->with('success', 'Data RW berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('rw.index')
                ->with('error', 'Gagal menghapus data RW. ' . $e->getMessage());
        }
    }
}