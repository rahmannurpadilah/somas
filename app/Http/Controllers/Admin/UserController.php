<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    // tampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // form create
    public function create()
    {
        return view('admin.user.create');
    }

    // simpan user baru
    public function make(Request $request)
    {
        try {
            $request->validate(
                [
                    'name'     => 'required',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required|min:6',
                    'role'     => 'required|in:admin,user',
                ],
                [
                    'name.required'     => 'Nama wajib diisi',
                    'email.required'    => 'Email wajib diisi',
                    'email.email'       => 'Format email tidak valid',
                    'email.unique'      => 'Email sudah terdaftar',
                    'password.required' => 'Password wajib diisi',
                    'password.min'      => 'Password minimal 6 karakter',
                    'role.required'     => 'Role wajib dipilih',
                    'role.in'           => 'Role tidak valid',
                ]
            );

            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            return redirect()
                ->route('user.index')
                ->with('success', 'User berhasil ditambahkan');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan user');
        }
    }

    // form edit
    public function edit($hash)
    {
        try {
            $id = Crypt::decrypt($hash);
            $user = User::findOrFail($id);

            return view('admin.user.edit', compact('user', 'hash'));
        } catch (Exception $e) {
            return redirect()
                ->route('user.index')
                ->with('error', 'User tidak ditemukan');
        }
    }

    // update user
    public function update(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->hash);
            $user = User::findOrFail($id);

            $request->validate(
                [
                    'name'  => 'required',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'role'  => 'required|in:admin,user',
                ],
                [
                    'name.required'  => 'Nama wajib diisi',
                    'email.required' => 'Email wajib diisi',
                    'email.email'    => 'Format email tidak valid',
                    'email.unique'   => 'Email sudah digunakan user lain',
                    'role.required'  => 'Role wajib dipilih',
                    'role.in'        => 'Role tidak valid',
                ]
            );

            $data = $request->only(['name', 'email', 'role']);

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()
                ->route('user.index')
                ->with('success', 'User berhasil diupdate');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal mengupdate user');
        }
    }

    // delete user
    public function delete($hash)
    {
        try {
            $id = Crypt::decrypt($hash);
            User::findOrFail($id)->delete();

            return redirect()
                ->route('user.index')
                ->with('success', 'User berhasil dihapus');
        } catch (Exception $e) {
            return redirect()
                ->route('user.index')
                ->with('error', 'Gagal menghapus user');
        }
    }
}
