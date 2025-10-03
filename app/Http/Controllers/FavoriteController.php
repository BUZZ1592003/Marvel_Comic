<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(): JsonResponse
    {
        $favorites = Auth::user()->favorites()
                         ->with('favoritable')
                         ->paginate(20);

        return response()->json($favorites);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'favoritable_type' => 'required|string|in:App\Models\Character,App\Models\Comic,App\Models\Series',
            'favoritable_id' => 'required|integer',
        ]);

        $favorite = Auth::user()->favorites()->firstOrCreate([
            'favoritable_type' => $validated['favoritable_type'],
            'favoritable_id' => $validated['favoritable_id'],
        ]);

        return response()->json([
            'message' => 'Added to favorites',
            'favorite' => $favorite
        ], 201);
    }

    public function destroy(Favorite $favorite): JsonResponse
    {
        // Ensure user can only delete their own favorites
        if ($favorite->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $favorite->delete();

        return response()->json([
            'message' => 'Removed from favorites'
        ], 204);
    }

    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'favoritable_type' => 'required|string|in:App\Models\Character,App\Models\Comic,App\Models\Series',
            'favoritable_id' => 'required|integer',
        ]);

        $favorite = Auth::user()->favorites()->where([
            'favoritable_type' => $validated['favoritable_type'],
            'favoritable_id' => $validated['favoritable_id'],
        ])->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Removed from favorites', 'favorited' => false]);
        } else {
            Auth::user()->favorites()->create($validated);
            return response()->json(['message' => 'Added to favorites', 'favorited' => true]);
        }
    }
}
