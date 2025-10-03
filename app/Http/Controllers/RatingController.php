<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
     public function index(): JsonResponse
    {
        $ratings = Auth::user()->ratings()
                      ->with('rateable')
                      ->paginate(20);

        return response()->json($ratings);
    }


    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'rateable_type' => 'required|string|in:App\Models\Character,App\Models\Comic,App\Models\Series',
            'rateable_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $rating = Auth::user()->ratings()->updateOrCreate([
            'rateable_type' => $validated['rateable_type'],
            'rateable_id' => $validated['rateable_id'],
        ], [
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
        ]);

        return response()->json([
            'message' => 'Rating saved successfully',
            'rating' => $rating
        ], 201);
    }

    public function destroy(Rating $rating): JsonResponse
    {
        // Ensure user can only delete their own ratings
        if ($rating->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $rating->delete();

        return response()->json([
            'message' => 'Rating deleted successfully'
        ], 204);
    }
}
