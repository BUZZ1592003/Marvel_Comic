<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\Series;
use App\Models\Character;

class HomeController extends Controller
{
    /**
     * Show the application dashboard/home.
     */
    public function index(Request $request)
    {
        $featured = Comic::published()->featured()->with('series','characters')->take(6)->get();
        // Fallback to recent if no featured
        if ($featured->isEmpty()) {
            $featured = Comic::published()->recent()->with('series','characters')->take(6)->get();
        }

        // If still empty (no DB data), create an in-memory demo collection so the UI remains dynamic
        if ($featured->isEmpty()) {
            $demo = collect();
            for ($i = 1; $i <= 6; $i++) {
                $demo->push((object) [
                    'id' => 10000 + $i,
                    'title' => "Phantom Saga #{$i}",
                    'slug' => 'phantom-saga-' . $i,
                    'cover_image' => "https://picsum.photos/seed/featured{$i}/600/900",
                    'description' => 'A dark, gritty mission that pushes heroes to their limits. Intrigue, betrayal, and hard choices.',
                    'release_date' => now()->subMonths($i),
                    'page_count' => 20 + ($i % 6),
                    'series' => (object) ['name' => 'Phantom Saga'],
                    'characters' => collect([(object)['name' => 'Raven'], (object)['name' => 'Wraith']]),
                ]);
            }

            // ensure $featured behaves like a collection of models for the view
            $featured = $demo;
        }

        $recent = Comic::published()->recent()->with('series')->take(8)->get();

        $stats = [
            'comics' => Comic::count(),
            'characters' => Character::count(),
            'series' => Series::count(),
            'years' => max(0, now()->year - (Series::min('start_year') ?: now()->year)),
        ];

        return view('home', compact('featured','recent','stats'));
    }
}
