<?php

namespace App\Services;

use App\Models\ContentSources;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContentSourceService
{
    public function getAll()
    {
        return ContentSources::all();
    }

    public function create(array $data): void
    {
        ContentSources::create([
            'platform'   => $data['platform'],
            'type'       => $data['type'],
            'identifier' => $data['identifier'],
            'category'   => $data['category'] ?? null,
            'is_active'  => true,
        ]);
    }

    public function findByHash(string $hash): ContentSources
    {
        try {
            $id = Crypt::decrypt($hash);
            return ContentSources::findOrFail($id);

        } catch (DecryptException $e) {
            throw new DecryptException('Link tidak valid');

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Data tidak ditemukan');
        }
    }

    public function update(ContentSources $source, array $data): void
    {
        $source->update([
            'platform'   => $data['platform'],
            'type'       => $data['type'],
            'identifier' => $data['identifier'],
            'category'   => $data['category'] ?? null,
            'is_active'  => $data['is_active'],
        ]);
    }

    public function deleteByHash(string $hash): void
    {
        $source = $this->findByHash($hash);
        $source->delete();
    }
}
