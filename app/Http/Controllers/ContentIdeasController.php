<?php

namespace App\Http\Controllers;

use App\Models\ContentIdeas;
use Illuminate\Http\Request;

class ContentIdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $content = ContentIdeas::latest()->first();
        $content = ContentIdeas::all();
        return view('content-ideas.tables', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail($id)
    {
        //
        $detail = ContentIdeas::find($id);
        return view('content-ideas.index', compact('detail'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function calendar()
    {
        $contents = ContentIdeas::all();

        return view('content-ideas.calendar', compact('contents'));
    }

    public function updateDate(Request $request, $id)
    {
        $content = ContentIdeas::findOrFail($id);
        $content->tanggal = $request->tanggal;
        $content->save();

        return response()->json(['success' => true]);
    }



    /**
     * Display the specified resource.
     */
    public function show(ContentIdeas $contentIdeas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContentIdeas $contentIdeas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContentIdeas $contentIdeas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContentIdeas $contentIdeas)
    {
        //
    }
}
