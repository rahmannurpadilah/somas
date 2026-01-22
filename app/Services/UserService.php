<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserService
{
    public function getAll()
    {
        return User::all();
    }

    public function create(array $data): void
    {
        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);
    }

    public function findByHash(string $hash): User
    {
        try {
            $id = Crypt::decrypt($hash);
            return User::findOrFail($id);

        } catch (DecryptException $e) {
            throw new DecryptException('Link tidak valid');

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('User tidak ditemukan');
        }
    }

    public function update(User $user, array $data): void
    {
        $updateData = [
            'name'  => $data['name'],
            'email' => $data['email'],
            'role'  => $data['role'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);
    }

    public function deleteByHash(string $hash): void
    {
        $user = $this->findByHash($hash);
        $user->delete();
    }
}
