<?php

namespace App\Http\Controllers;

use App\Models\ReadingHistory;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReadingHistoryController extends Controller
{
     public function index(): JsonResponse
    {
        $history = Auth::user()->readingHistory()
                      ->with('comic.series')
                      ->orderBy('last_read_at', 'desc')
                      ->paginate(20);

        return response()->json($history);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'last_read_page' => 'required|integer|min:1',
        ]);

        $comic = Comic::findOrFail($validated['comic_id']);
        $isCompleted = $validated['last_read_page'] >= $comic->page_count;

        $history = Auth::user()->readingHistory()->updateOrCreate([
            'comic_id' => $validated['comic_id'],
        ], [
            'last_read_page' => $validated['last_read_page'],
            'is_completed' => $isCompleted,
            'started_reading_at' => now(),
            'last_read_at' => now(),
        ]);

        return response()->json([
            'message' => 'Reading progress saved',
            'history' => $history
        ], 201);
    }

    public function update(Request $request, Comic $comic): JsonResponse
    {
        $validated = $request->validate([
            'last_read_page' => 'required|integer|min:1',
        ]);

        $isCompleted = $validated['last_read_page'] >= $comic->page_count;

        $history = Auth::user()->readingHistory()->updateOrCreate([
            'comic_id' => $comic->id,
        ], [
            'last_read_page' => $validated['last_read_page'],
            'is_completed' => $isCompleted,
            'last_read_at' => now(),
        ]);

        return response()->json([
            'message' => 'Reading progress updated',
            'history' => $history
        ]);
    }

    public function destroy(Comic $comic): JsonResponse
    {
        $deleted = Auth::user()->readingHistory()
                      ->where('comic_id', $comic->id)
                      ->delete();

        if ($deleted) {
            return response()->json([
                'message' => 'Reading history deleted'
            ], 204);
        }

        return response()->json([
            'message' => 'Reading history not found'
        ], 404);
    }

    
}
