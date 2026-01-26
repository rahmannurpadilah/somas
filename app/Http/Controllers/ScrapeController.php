<?php

namespace App\Http\Controllers;

use App\Jobs\TriggerApifyScrape;
use App\Models\ContentSources;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ScrapeController extends Controller
{
    public function start(String $hash)
    {
        try {
            $id = Crypt::decrypt($hash);
            $source = ContentSources::findOrFail($id);

            TriggerApifyScrape::dispatch($source);

            return back()->with('success', 'Scraping berhasil dijalankan');

        } catch (DecryptException $e) {
            return back()->with('error', 'Link tidak valid');

        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Sumber konten tidak ditemukan');
        }
    }
}
