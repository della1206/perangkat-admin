<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = User::query();

        // Filter berdasarkan role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Pagination dengan 10 data per halaman
        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        // Tambahkan parameter filter ke pagination links
        if ($request->has('role')) {
            $users->appends(['role' => $request->role]);
        }
        if ($request->has('search')) {
            $users->appends(['search' => $request->search]);
        }

        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          // Otorisasi sudah dilakukan di middleware atau di blade (seperti pada index.blade.php)
        // Tapi jika ingin memastikan di controller:
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }


        return view('pages.user.create');
    }

   /*
     * CATATAN:
     * Dua fungsi helper 'uploadPhoto' dan 'deleteOldPhoto' yang lama di sini
     * telah dihapus untuk menghindari konflik (redeclare) dengan fungsi helper
     * yang lebih baik di bagian bawah.
    */

    /**
     * Store a newly created resource in storage.
     */
// AKU TUTUP DIBAGIAN INI
    // private function uploadPhoto($file)
    // {
    //     if (!$file) {
    //         return null;
    //     }

    //     // Validasi file
    //     $validated = validator(['photo' => $file], [
    //         'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ])->validate();

    //     // Generate nama file unik
    //     $fileName = 'user_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

    //     // Simpan file original
    //     $path = $file->storeAs('public/photos', $fileName);

    //     // Untuk versi sederhana, tidak buat thumbnail dulu
    //     // Bisa ditambahkan nanti setelah package berfungsi
        
    //     return $fileName;
    // }

    // /**
    //  * Hapus foto lama jika ada
    //  */

    // private function deleteOldPhoto($fileName)
    // {
    //     if ($fileName) {
    //         // Hapus file original
    //         $originalPath = 'public/photos/' . $fileName;
    //         if (Storage::exists($originalPath)) {
    //             Storage::delete($originalPath);
    //         }

    //         // Jika ada thumbnail, hapus juga
    //         $thumbnailPath = 'public/photos/thumbnails/' . $fileName;
    //         if (Storage::exists($thumbnailPath)) {
    //             Storage::delete($thumbnailPath);
    //         }
    //     }
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        // Validasi akses - hanya admin dan super_admin
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk menambahkan user.');
        }

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:super_admin,admin,warga',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload foto jika ada
        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = $this->uploadPhoto($request->file('photo'));
        }

        // Buat user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
            'photo' => $photoName
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Semua role bisa melihat detail user
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Hanya admin dan super_admin yang bisa mengedit
        $userRole = auth()->user()->role;

        if (!in_array($userRole, ['admin', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit user.');
        }

        // Super_admin bisa edit semua, admin hanya bisa edit admin dan warga
        if ($userRole === 'admin' && $user->role === 'super_admin') {
            abort(403, 'Admin tidak dapat mengedit Super Admin.');
        }

        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Hanya admin dan super_admin yang bisa update
        $currentUserRole = auth()->user()->role;

        if (!in_array($currentUserRole, ['admin', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengupdate user.');
        }

        // Super_admin bisa update semua, admin hanya bisa update admin dan warga
        if ($currentUserRole === 'admin' && $user->role === 'super_admin') {
            abort(403, 'Admin tidak dapat mengupdate Super Admin.');
        }

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:super_admin,admin,warga',
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Admin tidak bisa mengubah role menjadi super_admin
        if ($currentUserRole === 'admin' && $validatedData['role'] === 'super_admin') {
            abort(403, 'Admin tidak dapat mengubah role menjadi Super Admin.');
        }

        // Handle upload foto
        $photoName = $user->photo;
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            $this->deleteOldPhoto($photoName);
            
            // Upload foto baru
            $photoName = $this->uploadPhoto($request->file('photo'));
        }

        // Update data user
        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'photo' => $photoName
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($updateData);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Cegah penghapusan diri sendiri
        if ($user->id == auth()->id()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        // Hanya admin dan super_admin yang bisa hapus
        $currentUserRole = auth()->user()->role;

        if (!in_array($currentUserRole, ['admin', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus user.');
        }

        // Super_admin bisa hapus semua, admin hanya bisa hapus admin dan warga
        if ($currentUserRole === 'admin' && $user->role === 'super_admin') {
            abort(403, 'Admin tidak dapat menghapus Super Admin.');
        }

        // Hapus foto jika ada
        $this->deleteOldPhoto($user->photo);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Edit profile user sendiri (untuk semua role)
     */
    public function editProfile()
    {
        $user = auth()->user();
        return view('pages.user.profile', compact('user'));
    }

    /**
     * Update profile user sendiri (untuk semua role)
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validasi current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak valid.']);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'required'
        ]);

        // Handle upload foto
        $photoName = $user->photo;
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            $this->deleteOldPhoto($photoName);
            
            // Upload foto baru
            $photoName = $this->uploadPhoto($request->file('photo'));
        }

        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'photo' => $photoName
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($updateData);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }

      // --- Helper Methods untuk Photo Upload/Delete ---

    /**
     * Menyimpan file foto ke storage.
     * @param \Illuminate\Http\UploadedFile $file
     * @return string Nama file yang disimpan
     */
    protected function uploadPhoto($file)
    {
        // Generate nama file unik
        $fileName = 'user_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Simpan di folder storage/app/public/photos
        // Menggunakan storeAs dengan disk 'public' lebih baik
        $file->storeAs('photos', $fileName, 'public'); 
        
        // Catatan: Jika ingin menggunakan Image Intervention untuk thumbnail, 
        // Anda bisa menambahkannya di sini.

        return $fileName;
    }

    /**
     * Menghapus foto lama dari storage, termasuk thumbnail jika ada.
     * @param string|null $fileName Nama file foto lama
     */
    protected function deleteOldPhoto(?string $fileName)
    {
        if ($fileName) {
            // Hapus file original
            $originalPath = 'photos/' . $fileName;
            if (Storage::disk('public')->exists($originalPath)) {
                Storage::disk('public')->delete($originalPath);
            }

            // Jika ada thumbnail, hapus juga (untuk antisipasi di masa depan)
            $thumbnailPath = 'photos/thumbnails/' . $fileName;
            if (Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
    
    }
    }
}