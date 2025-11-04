<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan daftar user
    public function index()
    {
        $users = User::all();
<<<<<<< HEAD
        return view('pages.user.index', compact('users'));
=======
        return view('user.index', compact('users'));
>>>>>>> 0b0f6c7eab133f3a92c051b30a4b878e479e7405
    }

    // Form tambah user
    public function create()
    {
<<<<<<< HEAD
        return view('pages.user.create');
=======
        return view('user.create');
>>>>>>> 0b0f6c7eab133f3a92c051b30a4b878e479e7405
    }

    // Simpan user baru
   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        // 'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:6',
    ]);

    // Hash password dengan benar
    $validated['password'] = Hash::make($validated['password']);

    // Simpan user
    User::create($validated);

    return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
}


    // Form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            // 'username' => 'required|string|max:255|unique:users,username,' . $id,
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
