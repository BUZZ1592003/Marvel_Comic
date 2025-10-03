<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withCount(['favorites', 'ratings', 'readingHistory'])
                    ->paginate(20);
                    
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user->load([
            'favorites.favoritable',
            'ratings.rateable',
            'readingHistory.comic',
            'followedSeries'
        ]);

        $userData = [
            'user' => $user,
            'stats' => [
                'favorites_count' => $user->favorites->count(),
                'ratings_count' => $user->ratings->count(),
                'comics_read' => $user->readingHistory->where('is_completed', true)->count(),
                'series_following' => $user->followedSeries->count(),
            ]
        ];

        return response()->json($userData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', Password::defaults()],
        ]);

        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }

        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

         $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], 204);
    }

    public function dashboard(User $user): JsonResponse
    {
    //  try {
    //     $dashboardData = [
    //         'user' => [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'email' => $user->email,
    //         ],
    //         'stats' => [
    //             'total_favorites' => $user->favorites()->count(),
    //             'total_ratings' => $user->rating()->count(),  // Changed to singular
    //             'total_reading' => $user->readingHistory()->count(),
    //         ],
    //     ];

    //     return response()->json($dashboardData);
        
    // } catch (\Exception $e) {
    //     return response()->json([
    //         'error' => 'Dashboard failed',
    //         'message' => $e->getMessage()
    //     ], 500);
    // }

// Initialize fallback values
    $favoritesCount = 0;
    $ratingsCount = 0;
    $readingCount = 0;
    
    // Test each relationship individually
    try {
        $favoritesCount = $user->favorites()->count();
    } catch (\Exception $e) {
        // Log if needed: \Log::warning('Favorites relationship missing');
    }
    
    try {
        $ratingsCount = $user->ratings()->count();  // Note: might be plural
    } catch (\Exception $e) {
        // Relationship doesn't exist yet
    }
    
    try {
        $readingCount = $user->readingHistory()->count();
    } catch (\Exception $e) {
        // Relationship doesn't exist yet
    }
    
    return response()->json([
        'user' => $user->only(['id', 'name', 'email']),
        'stats' => [
            'favorites_count' => $favoritesCount,
            'ratings_count' => $ratingsCount,
            'reading_count' => $readingCount,
        ],
        'message' => 'Dashboard loaded successfully'
    ]);}

    public function favorites(User $user): JsonResponse
    {
        $favorites = $user->favorites()
                         ->with('favoritable')
                         ->paginate(20);

        return response()->json($favorites);
    }

    public function readingHistory(User $user): JsonResponse
    {
        $history = $user->readingHistory()
                       ->with('comic.series')
                       ->orderBy('last_read_at', 'desc')
                       ->paginate(20);

        return response()->json($history);
    }

    public function followedSeries(User $user): JsonResponse
    {
        $series = $user->followedSeries()
                      ->withPivot('notifications_enabled')
                      ->paginate(20);

        return response()->json($series);
    }
}
