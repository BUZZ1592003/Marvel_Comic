<?php

namespace App\Http\Controllers;

use App\Models\ComicPage;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ComicPageController extends Controller
{
    public function index(Comic $comic): JsonResponse
    {
        $pages = $comic->pages()->orderBy('page_number')->get();

        return response()->json($pages);
    }

    public function show(ComicPage $page): JsonResponse
   {
    return response()->json($page);
   }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'page_number' => 'required|integer|min:1',
            'image_url' => 'required|string',
            'alt_text' => 'nullable|string',
        ]);

        $page = ComicPage::create($validated);

        return response()->json([
            'message' => 'Comic page created successfully',
            'page' => $page
        ], 201);
    }

    public function update(Request $request, ComicPage $page): JsonResponse
    {
        $validated = $request->validate([
            'page_number' => 'sometimes|required|integer|min:1',
            'image_url' => 'sometimes|required|string',
            'alt_text' => 'nullable|string',
        ]);

        $page->update($validated);

        return response()->json([
            'message' => 'Comic page updated successfully',
            'page' => $page
        ]);
    }

    public function destroy(ComicPage $page): JsonResponse
    {
        $page->delete();

        return response()->json([
            'message' => 'Comic page deleted successfully'
        ], 204);
    }
    
}
