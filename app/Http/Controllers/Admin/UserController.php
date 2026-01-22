<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(): View
    {
        return view('admin.user.index', [
            'users' => $this->userService->getAll()
        ]);
    }

    public function create(): View
    {
        return view('admin.user.create');
    }

    public function make(Request $request): RedirectResponse
    {
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

        try {
            $this->userService->create($request->all());

            return redirect()
                ->route('admin.user.index')
                ->with('success', 'User berhasil ditambahkan');

        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan user');
        }
    }

    public function edit(string $hash): View|RedirectResponse
    {
        try {
            $user = $this->userService->findByHash($hash);

            return view('admin.user.edit', compact('user', 'hash'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Link tidak valid atau rusak');

        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'User tidak ditemukan atau sudah dihapus');

        } catch (Exception $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name'  => 'required',
                'email' => 'required|email|unique:users,email,' . $request->id,
                'role'  => 'required|in:admin,user',
            ]
        );

        try {
            $user = $this->userService->findByHash($request->hash);
            $this->userService->update($user, $request->all());

            return redirect()
                ->route('admin.user.index')
                ->with('success', 'User berhasil diupdate');

        } catch (DecryptException|ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());

        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat update');
        }
    }

    public function delete(string $hash): RedirectResponse
    {
        try {
            $this->userService->deleteByHash($hash);

            return redirect()
                ->route('admin.user.index')
                ->with('success', 'User berhasil dihapus');

        } catch (DecryptException|ModelNotFoundException $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', $e->getMessage());

        } catch (Exception $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Terjadi kesalahan saat menghapus user');
        }
    }
}
