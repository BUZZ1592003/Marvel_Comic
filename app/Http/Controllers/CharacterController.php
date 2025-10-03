<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CharacterController extends Controller
{
    // Remove JsonResponse type hint to allow both JSON and view responses
    public function index(Request $request)
    {
        $query = Character::with(['comics.series']);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('real_name', 'like', "%{$search}%")
                  ->orWhere('alias', 'like', "%{$search}%");
        }
        
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sort options
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $characters = $query->paginate(12);

        // Check if this is an API request
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($characters);
        }

        // For web requests, return view
        return view('characters.index', compact('characters'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:characters,slug',
            'description' => 'required|string',
            'real_name' => 'nullable|string|max:255',
            'alias' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
            'thumbnail_url' => 'nullable|url',
            'powers' => 'nullable|array',
            'first_appearance' => 'nullable|string',
            'type' => 'required|in:hero,villain,antihero,neutral',
            'origin' => 'nullable|string',
            'teams' => 'nullable|array',
            'strength' => 'integer|min:1|max:100',
            'intelligence' => 'integer|min:1|max:100',
            'speed' => 'integer|min:1|max:100',
            'durability' => 'integer|min:1|max:100',
            'energy_projection' => 'integer|min:1|max:100',
            'fighting_skills' => 'integer|min:1|max:100',
            'status' => 'required|in:active,inactive,deceased',
        ]);

        $character = Character::create($validated);

        return response()->json([
            'message' => 'Character created successfully',
            'character' => $character
        ], 201);
    }

    // Remove JsonResponse type hint and add Request parameter
    public function show(Request $request, Character $character)
    {
        try {
            $character->load(['comics.series']);

            // Check if this is an API request
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json($character);
            }

            // For web requests, return view
            return view('characters.show', compact('character'));
            
        } catch (ModelNotFoundException $e) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Character not found'], 404);
            }
            abort(404);
        }
    }

    public function update(Request $request, Character $character): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:characters,slug,' . $character->id,
            'description' => 'sometimes|required|string',
            'real_name' => 'nullable|string|max:255',
            'alias' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
            'thumbnail_url' => 'nullable|url',
            'powers' => 'nullable|array',
            'first_appearance' => 'nullable|string',
            'type' => 'sometimes|required|in:hero,villain,antihero,neutral',
            'origin' => 'nullable|string',
            'teams' => 'nullable|array',
            'strength' => 'integer|min:1|max:100',
            'intelligence' => 'integer|min:1|max:100',
            'speed' => 'integer|min:1|max:100',
            'durability' => 'integer|min:1|max:100',
            'energy_projection' => 'integer|min:1|max:100',
            'fighting_skills' => 'integer|min:1|max:100',
            'status' => 'sometimes|required|in:active,inactive,deceased',
        ]);

        $character->update($validated);

        return response()->json([
            'message' => 'Character updated successfully',
            'character' => $character
        ]);
    }

    public function destroy(Character $character): JsonResponse
    {
        $character->delete();

        return response()->json([
            'message' => 'Character deleted successfully'
        ], 204);
    }

    public function heroes(): JsonResponse
    {
        $heroes = Character::heroes()->active()->paginate(10);
        return response()->json($heroes);
    }

    public function villains(): JsonResponse
    {
        $villains = Character::villains()->active()->paginate(10);
        return response()->json($villains);
    }
}
