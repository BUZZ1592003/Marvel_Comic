<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ComicController extends Controller
{
    // Remove JsonResponse type hint to allow both JSON and view responses
    public function index(Request $request)
    {
        // $query = Comic::with(['series', 'characters']);

        // // Search functionality
        // if ($request->has('search')) {
        //     $search = $request->search;
        //     $query->where('title', 'like', "%{$search}%")
        //           ->orWhere('description', 'like', "%{$search}%")
        //           ->orWhereHas('series', function($q) use ($search) {
        //               $q->where('name', 'like', "%{$search}%");
        //           });
        // }

        // // Filter by series
        // if ($request->has('series_id')) {
        //     $query->where('series_id', $request->series_id);
        // }

        // // Filter by year
        // if ($request->has('year')) {
        //     $query->whereYear('release_date', $request->year);
        // }

        // // Filter by status
        // if ($request->has('status')) {
        //     $query->where('status', $request->status);
        // }

        // // Sort options
        // $sortBy = $request->get('sort', 'release_date');
        // $sortOrder = $request->get('order', 'desc');
        // $query->orderBy($sortBy, $sortOrder);

        // $comics = $query->paginate(12);

        // // Check if this is an API request
        // // if ($request->expectsJson() || $request->is('api/*')) {
        // //     return response()->json($comics);
        // // }

        // // For web requests, return view
        // return view('comics.index', compact('comics'));

         $query = Comic::with(['series', 'characters']);

        // Search
        if ($request->filled('search')) {
            $s = $request->string('search');
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%")
                  ->orWhereHas('series', fn($qq) => $qq->where('name', 'like', "%{$s}%"));
            });
        }

        // Filters
        if ($request->filled('series_id')) {
            $query->where('series_id', $request->integer('series_id'));
        }
        if ($request->filled('year')) {
            $query->whereYear('release_date', $request->integer('year'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        // Sorting
        $sortBy = $request->get('sort', 'release_date');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination + keep current filters in links
        $comics = $query->paginate(12)->withQueryString(); // Laravel paginator option [web:260][web:262]

        // Always return a Blade view for web
        return view('comics.index', compact('comics')); // [web:197]
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'series_id' => 'required|exists:series,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:comics,slug',
            'description' => 'required|string',
            'cover_image' => 'required|string',
            'issue_number' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'writer' => 'nullable|string',
            'artist' => 'nullable|string',
            'colorist' => 'nullable|string',
            'letterer' => 'nullable|string',
            'page_count' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:published,upcoming,draft',
            'is_featured' => ['sometimes', 'boolean'],
        ]);
        
        $comic = Comic::create($validated);

        return response()->json([
            'message' => 'Comic created successfully',
            'comic' => $comic
        ], 201);
    }

    // Remove JsonResponse type hint and add Request parameter
    public function show(Request $request, Comic $comic)
    {
        // try {
        //     $comic->load(['series', 'characters', 'pages' => function($query) {
        //         $query->orderBy('page_number');
        //     }]);

        //     // Check if this is an API request
        //     if ($request->expectsJson() || $request->is('api/*')) {
        //         return response()->json($comic);
        //     }

        //     // For web requests, return view
        //     return view('comics.show', compact('comic'));
            
        // } catch (ModelNotFoundException $e) {
        //     if ($request->expectsJson() || $request->is('api/*')) {
        //         return response()->json(['message' => 'Comic not found'], 404);
        //     }
        //     abort(404);
        // }

        $comic->load([
            'series',
            'characters',
            'pages' => fn($q) => $q->orderBy('page_number'),
        ]);

        // Always return a Blade view for web
        return view('comics.show', compact('comic')); // [web:197]
    }

    // Optional: if you still need JSON for background/API, put those in Api/ComicApiController and routes/api.php
    // Do not return JSON from this web controller to keep pages HTML-only.
    

    public function update(Request $request, Comic $comic): JsonResponse
    {
        $validated = $request->validate([
            'series_id' => 'sometimes|required|exists:series,id',
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:comics,slug,' . $comic->id,
            'description' => 'sometimes|required|string',
            'cover_image' => 'sometimes|required|string',
            'issue_number' => 'sometimes|required|integer|min:1',
            'release_date' => 'sometimes|required|date',
            'writer' => 'nullable|string',
            'artist' => 'nullable|string',
            'colorist' => 'nullable|string',
            'letterer' => 'nullable|string',
            'page_count' => 'sometimes|required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'status' => 'sometimes|required|in:published,upcoming,draft',
            'is_featured' => ['sometimes', 'boolean'],
        ]);

        $comic->update($validated);

        return response()->json([
            'message' => 'Comic updated successfully',
            'comic' => $comic
        ]);
    }

    public function destroy(Comic $comic): JsonResponse
    {
        $comic->delete();

        return response()->json([
            'message' => 'Comic deleted successfully'
        ], 204);
    }

    public function featured(): JsonResponse
    {
        $featured = Comic::where('is_featured', true)
                         ->with(['series', 'characters'])
                         ->paginate(6);

        return response()->json($featured);
    }
}
