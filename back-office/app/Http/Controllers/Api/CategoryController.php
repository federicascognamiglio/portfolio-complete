<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Get all categories with their types
        $categories = Category::with('types')->get();

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }
}