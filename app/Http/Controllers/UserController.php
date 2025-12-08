<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        // PERIKSA: Apakah user yang login adalah admin/super_admin
        $userRole = auth()->user()->role;
        
        // Izinkan admin dan super_admin
        if (!in_array($userRole, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action. Your role: ' . $userRole);
        }
        
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi akses
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:super_admin,admin,warga'
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Izinkan: 1. User mengedit dirinya sendiri, 2. Admin/super_admin mengedit siapa saja
        $userRole = auth()->user()->role;
        
        if (auth()->id() !== $user->id && !in_array($userRole, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action. Your role: ' . $userRole);
        }
        
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Izinkan: 1. User mengupdate dirinya sendiri, 2. Admin/super_admin mengupdate siapa saja
        if (auth()->id() !== $user->id && !in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:super_admin,admin,warga'
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);
        
        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }
        
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
        
        // Hanya admin/super_admin yang bisa hapus
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $user->delete();
        
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
    
    /**
     * Edit profile user sendiri
     */
    public function editProfile()
    {
        $user = auth()->user();
        return view('pages.user.profile', compact('user'));
    }
    
    /**
     * Update profile user sendiri
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        // Jika password diisi, update password
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed'
            ]);
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }
        
        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }
}