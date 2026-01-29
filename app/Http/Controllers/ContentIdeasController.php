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
        $content = ContentIdeas::latest()->first();
        return view('content-ideas.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
