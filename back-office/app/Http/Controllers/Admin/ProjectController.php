<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Tool;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get status from the request query parameters if exists
        $status = request()->query('status');

        // Fetch projects based on the status filter
        if ($status) {
            $projects = Project::where('status', $status)->orderBy('created_at', 'desc')->get();
        } else {
            $projects = Project::orderBy('created_at', 'desc')->get();
        }
        
        return view('projects.index', compact('projects', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all tags and tools
        $tags = Tag::all();
        $tools = Tool::all();

        // Media
        $media = [];

        return view('projects.create', compact('tags', 'tools', 'media'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'client' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'status' => 'required|in:draft,published,archived',
                'category_id' => 'nullable|exists:categories,id',
                'type_id' => 'nullable|exists:types,id',
                'tags' => 'nullable|array',
                'tools' => 'nullable|array',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Handle the cover image upload
            if ($request->hasFile('cover_image')) {
                $imgUrl = Storage::putFile('projects', $validatedData['cover_image']);
            }
    
            // Slug generation
            $slug = Project::generateUniqueSlug($validatedData['title']);
    
            // Create a new project
            $project = Project::create([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'subtitle' => $validatedData['subtitle'],
                'cover_image' => $imgUrl ?? null,
                'client' => $validatedData['client'],
                'description' => $validatedData['description'],
                'category_id' => $validatedData['category_id'],
                'type_id' => $validatedData['type_id'],
                'status' => $validatedData['status'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
            ]);
    
            // Attach tags and tools
            if (isset($validatedData['tags'])) {
                $project->tags()->attach($validatedData['tags']);
            }
    
            if (isset($validatedData['tools'])) {
                $project->tools()->attach($validatedData['tools']);
            }
    
            return redirect()->route('projects.index')->with('success', 'Progetto creato con successo.');
        } catch (\Exception $e) {
            // Riturn to form with error message
            return redirect()->back()
                ->withInput() // keep inputs
                ->with('error', 'Errore while creating project. Retry');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // Find the project by slug and eager load media
        $project = Project::with('media')->where('slug', $slug)->first();

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        // Find the project by slug
        $project = Project::with('tags', 'tools')->where('slug', $slug)->first();

        // Fetch all tags and tools
        $tags = Tag::all();
        $tools = Tool::all();

        // Get the selected tags and tools for the project
        $selectedTags = $project->tags()->pluck('tags.id')->toArray();
        $selectedTools = $project->tools()->pluck('tools.id')->toArray();

        return view('projects.edit', compact('project', 'tags', 'tools', 'selectedTags', 'selectedTools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
            'category_id' => 'nullable|exists:categories,id',
            'type_id' => 'nullable|exists:types,id',
            'tags' => 'nullable|array',
            'tools' => 'nullable|array',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete the old image if it exists
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            // Store the new image
            $imgUrl = Storage::putFile('projects', $validatedData['cover_image']);
        }

        // Check if the title has changed to generate a new slug
        if ($project->title !== $validatedData['title']) {
            $slug = Project::generateUniqueSlug($validatedData['title']);
        } else {
            $slug = $project->slug;
        }

        // Update the project
        $project->update([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'subtitle' => $validatedData['subtitle'],
            'cover_image' => $imgUrl ?? $project->cover_image,
            'client' => $validatedData['client'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'type_id' => $validatedData['type_id'],
            'status' => $validatedData['status'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);

        // Sync tags and tools with the project
        if (isset($validatedData['tags'])) {
            $project->tags()->sync($validatedData['tags']);
        } else {
            $project->tags()->detach();
        }

        if (isset($validatedData['tools'])) {
            $project->tools()->sync($validatedData['tools']);
        } else {
            $project->tools()->detach();
        }

        return redirect()->route('projects.show', $project->slug)->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete the project cover image if it exists
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        // Detach tags and tools from the project
        $project->tags()->detach();
        $project->tools()->detach();

        // Delete the project
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
