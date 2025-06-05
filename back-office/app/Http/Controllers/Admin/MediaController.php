<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'url' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,gif',
            'type' => 'required|in:IMAGE,VIDEO,GIF',
            'description' => 'nullable|string',
        ]);
        
        // Store the media file
        $fileUrl = Storage::putFile('media', $validatedData['url']);

        // Create a new media record in the database
        $media = Media::create([
            'project_id' => $validatedData['project_id'],
            'type' => $validatedData['type'],
            'url' => $fileUrl,
            'description' => $validatedData['description'],
        ]);
        
        return response()->json($media);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the media record by ID
        $media = Media::findOrFail($id);

        // Delete the file from storage if it exists
        if (Storage::exists($media->url)) {
            Storage::delete($media->url);
        }

        // Delete the media record from the database
        $media->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Media deleted successfully.',
        ]);
    }
}
