<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();

        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|unique:tags,name|max:255',
            'color' => 'nullable|string',
        ]);

        // Create a new tag
        $tag = Tag::create($validatedData);

        return response()->json( $tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|unique:tags,name,' . $tag->id . '|max:255',
            'color' => 'nullable|string',
        ]);

        // Update tag
        $tag->update($validatedData);

        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // Delete the tag
        $tag->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tag deleted successfully.',
        ]);
    }
}
