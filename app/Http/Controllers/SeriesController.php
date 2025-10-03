<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SeriesController extends Controller
{
    // Remove JsonResponse type hint to allow both JSON and view responses
    public function index(Request $request)
    {
        $query = Series::query();

        // Apply filters
        if($request->has('search')){
            $search = $request->search;
            $query->where('name','like',"%{$search}%")->orwhere('description','like',"%{$search}%");
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('genre')) {
            $query->where('genre', $request->genre);
        }

        // Sort options
        $sortBy = $request->get('sort', 'popularity_score');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $series = $query->paginate(12);

        // Check if this is an API request
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($series);
        }

        // For web requests, return view
        return view('series.index', compact('series'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:series,slug',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'end_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'status' => 'required|in:ongoing,completed,cancelled,hiatus',
            'genre' => 'required|in:superhero,action,adventure,sci-fi,fantasy,horror,comedy',
            'frequency' => 'nullable|string',
        ]);

        $series = Series::create($validated);

        return response()->json([
            'message' => 'Series created successfully',
            'series' => $series
        ], 201);
    }

    // Remove JsonResponse type hint and add Request parameter
    public function show(Request $request, Series $series)
    {
        $series->load(['comics.characters', 'comics' => function($query) {
            $query->orderBy('issue_number');
        }]);

        // Check if this is an API request
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($series);
        }

        // For web requests, return view
        return view('series.show', compact('series'));
    }

    public function update(Request $request, Series $series): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:series,slug,' . $series->id,
            'description' => 'sometimes|required|string',
            'image_url' => 'nullable|url',
            'start_year' => 'sometimes|required|integer|min:1900|max:' . date('Y'),
            'end_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'status' => 'sometimes|required|in:ongoing,completed,cancelled,hiatus',
            'genre' => 'sometimes|required|in:superhero,action,adventure,sci-fi,fantasy,horror,comedy',
            'frequency' => 'nullable|string',
        ]);

        $series->update($validated);

        return response()->json([
            'message' => 'Series updated successfully',
            'series' => $series
        ]);
    }

    public function destroy(Series $series): JsonResponse
    {
        $series->delete();

        return response()->json([
            'message' => 'Series deleted successfully'
        ], 204);
    }

    public function followers(Series $series): JsonResponse
    {
        $followers = $series->followers()->paginate(20);
        return response()->json($followers);
    }
}
