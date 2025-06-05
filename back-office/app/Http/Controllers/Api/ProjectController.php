<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('category', 'type')->where('status' , 'published');

        // Filtro per nome categoria
        if ($request->has('category_name')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category_name);
            });
        }

        // Filtro per nome tipo
        if ($request->has('type_name')) {
            $query->whereHas('type', function ($q) use ($request) {
                $q->where('name', $request->type_name);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->get(),
        ]);
    }

    public function show(string $slug)
    {
        $project = Project::with('category', 'type', 'media', 'tags', 'tools')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $project,
        ]);
    }
}