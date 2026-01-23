<?php

namespace App\Http\Controllers;

use App\Models\ContentSources;
use App\Services\ContentSourceService;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentSourcesController extends Controller
{
    public function __construct(
        protected ContentSourceService $contentSourceService
    ) {}

    public function index(): View
    {
        return view('content-source.index', [
            'sources' => $this->contentSourceService->getAll()
        ]);
    }

    public function create(): View
    {
        return view('content-source.create');
    }

    public function make(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'platform'   => 'required|in:instagram,tiktok',
                'type'       => 'required|in:username,hashtag',
                'identifier' => 'required',
                'category'   => 'nullable',
            ],
            [
                'platform.required'   => 'Platform wajib dipilih',
                'type.required'       => 'Tipe wajib dipilih',
                'identifier.required' => 'Identifier wajib diisi',
            ]
        );

        try {
            $this->contentSourceService->create($request->all());

            return redirect()
                ->route('content-source.index')
                ->with('success', 'Content source berhasil ditambahkan');

        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan data');
        }
    }

    public function edit(string $hash): View|RedirectResponse
    {
        try {
            $source = $this->contentSourceService->findByHash($hash);

            return view('content-source.edit', compact('source', 'hash'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('content-source.index')
                ->with('error', 'Link tidak valid');

        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('content-source.index')
                ->with('error', 'Data tidak ditemukan');

        } catch (Exception $e) {
            return redirect()
                ->route('content-source.index')
                ->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'platform'   => 'required|in:instagram,tiktok',
                'type'       => 'required|in:username,hashtag',
                'identifier' => 'required',
                'category'   => 'nullable',
                'is_active'  => 'required|boolean',
            ]
        );

        try {
            $source = $this->contentSourceService->findByHash($request->hash);
            $this->contentSourceService->update($source, $request->all());

            return redirect()
                ->route('content-source.index')
                ->with('success', 'Content source berhasil diupdate');

        } catch (DecryptException|ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());

        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat update');
        }
    }

    public function delete(string $hash): RedirectResponse
    {
        try {
            $this->contentSourceService->deleteByHash($hash);

            return redirect()
                ->route('content-source.index')
                ->with('success', 'Content source berhasil dihapus');

        } catch (DecryptException|ModelNotFoundException $e) {
            return redirect()
                ->route('content-source.index')
                ->with('error', $e->getMessage());

        } catch (Exception $e) {
            return redirect()
                ->route('content-source.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
