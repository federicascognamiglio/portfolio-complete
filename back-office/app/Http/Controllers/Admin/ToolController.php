<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tool;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = Tool::all();

        return response()->json($tools);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|unique:tags,name|max:255',
            'description' => 'nullable|string',
            'logo_url' => 'nullable|string',
        ]);

        // Create a new tool
        $tool = Tool::create($validatedData);

        return response()->json($tool);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|unique:tags,name,' . $tool->id . '|max:255',
            'description' => 'nullable|string',
            'logo_url' => 'nullable|string',
        ]);

        // Update tool
        $tool->update($validatedData);

        return response()->json($tool);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        // Delete the tool
        $tool->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tool deleted successfully.',
        ]);
    }
}