<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Comic;
use App\Models\Series;
use Illuminate\Http\Request;
use Throwable;

class HomeController extends Controller
{
    /**
     * Show the redesigned premium homepage.
     */
    public function index(Request $request)
    {
        $publishersAndArcs = collect([
            [
                'title' => 'Marvel Core',
                'subtitle' => 'Flagship publishing line',
                'description' => 'High-impact runs, major crossover continuity, and collector-grade key issues.',
                'tag' => 'Publisher',
            ],
            [
                'title' => 'Street-Level Requiem',
                'subtitle' => 'Noir urban storyline',
                'description' => 'Grounded heroes, moral gray zones, and city-scale consequences.',
                'tag' => 'Story Arc',
            ],
            [
                'title' => 'Incursion Protocol',
                'subtitle' => 'Multiverse collision event',
                'description' => 'Parallel realities and timeline fractures with big-canvas stakes.',
                'tag' => 'Comic Event',
            ],
        ]);

        try {
            $featured = Comic::published()
                ->with(['series', 'characters'])
                ->featured()
                ->orderByDesc('release_date')
                ->take(4)
                ->get();

            if ($featured->isEmpty()) {
                $featured = Comic::published()
                    ->with(['series', 'characters'])
                    ->orderByDesc('rating')
                    ->orderByDesc('release_date')
                    ->take(4)
                    ->get();
            }

            $trending = Comic::published()
                ->with('series')
                ->orderByDesc('rating_count')
                ->orderByDesc('rating')
                ->take(8)
                ->get();

            $latest = Comic::published()
                ->with('series')
                ->orderByDesc('release_date')
                ->take(8)
                ->get();

            $characters = Character::query()
                ->where('status', 'active')
                ->orderByDesc('strength')
                ->orderByDesc('intelligence')
                ->take(6)
                ->get();

            $universes = Series::query()
                ->withCount('comics')
                ->orderByDesc('popularity_score')
                ->orderByDesc('average_rating')
                ->take(5)
                ->get();

            $recommendationLanes = [
                [
                    'title' => 'Because You Like Spider-Man',
                    'description' => 'Fast-paced, high-stakes issues with heart and street-level intensity.',
                    'items' => $trending->take(4),
                ],
                [
                    'title' => 'Dark Storylines You May Love',
                    'description' => 'Brooding arcs, anti-heroes, and morally complex turning points.',
                    'items' => $latest->sortByDesc('rating')->take(4)->values(),
                ],
            ];

            $stats = [
                'comics' => Comic::count(),
                'characters' => Character::count(),
                'series' => Series::count(),
                'active_readers' => 12457,
            ];
        } catch (Throwable $e) {
            report($e);
            $featured = collect();
            $trending = collect();
            $latest = collect();
            $characters = collect();
            $universes = collect();
            $recommendationLanes = [
                [
                    'title' => 'Because You Like Spider-Man',
                    'description' => 'Fast-paced, high-stakes issues with heart and street-level intensity.',
                    'items' => collect(),
                ],
                [
                    'title' => 'Dark Storylines You May Love',
                    'description' => 'Brooding arcs, anti-heroes, and morally complex turning points.',
                    'items' => collect(),
                ],
            ];
            $stats = [
                'comics' => 0,
                'characters' => 0,
                'series' => 0,
                'active_readers' => 12457,
            ];
        }

        if ($featured->isEmpty() && $trending->isEmpty() && $latest->isEmpty()) {
            $demoComics = collect(range(1, 8))->map(function (int $i) {
                $coverPool = [
                    '/images/vault/covers/cover-01.jpg',
                    '/images/vault/covers/cover-02.jpg',
                    '/images/vault/covers/cover-03.jpg',
                    '/images/vault/covers/cover-04.jpg',
                ];
                return (object) [
                    'id' => 1000 + $i,
                    'slug' => 'vault-' . $i,
                    'title' => 'Vault Protocol #' . $i,
                    'description' => 'A cinematic run balancing cosmic stakes and personal fallout.',
                    'cover_image' => $coverPool[($i - 1) % count($coverPool)],
                    'release_date' => now()->subWeeks($i),
                    'page_count' => 24 + ($i % 8),
                    'price' => 3.99 + ($i * 0.35),
                    'rating' => 4.1 + (($i % 5) * 0.1),
                    'rating_count' => 120 + ($i * 33),
                    'issue_number' => 10 + $i,
                    'series' => (object) ['name' => 'Marvel Vault'],
                    'characters' => collect([(object) ['name' => 'Specter'], (object) ['name' => 'Nova Rider']]),
                    'writer' => 'Editorial Curator',
                    'artist' => 'Ink Forge Studio',
                ];
            });

            $featured = $demoComics->take(4)->values();
            $trending = $demoComics->take(8)->values();
            $latest = $demoComics->reverse()->take(8)->values();
            $characters = collect([
                (object) ['name' => 'Spider-Man', 'slug' => 'spider-man', 'type' => 'hero', 'image_url' => '/images/vault/characters/char-01.jpg'],
                (object) ['name' => 'Scarlet Witch', 'slug' => 'scarlet-witch', 'type' => 'hero', 'image_url' => '/images/vault/characters/char-02.jpg'],
                (object) ['name' => 'Moon Knight', 'slug' => 'moon-knight', 'type' => 'hero', 'image_url' => '/images/vault/characters/char-03.jpg'],
                (object) ['name' => 'Doctor Doom', 'slug' => 'doctor-doom', 'type' => 'villain', 'image_url' => '/images/vault/characters/char-04.jpg'],
                (object) ['name' => 'Storm', 'slug' => 'storm', 'type' => 'hero', 'image_url' => '/images/vault/characters/char-05.jpg'],
                (object) ['name' => 'Loki', 'slug' => 'loki', 'type' => 'villain', 'image_url' => '/images/vault/characters/char-01.jpg'],
            ]);
            $universes = collect([
                (object) ['name' => 'Earth-616', 'slug' => 'earth-616', 'genre' => 'Prime Timeline', 'average_rating' => 4.8, 'comics_count' => 284],
                (object) ['name' => 'Ultimate Line', 'slug' => 'ultimate-line', 'genre' => 'Reimagined Origins', 'average_rating' => 4.5, 'comics_count' => 97],
                (object) ['name' => 'Midnight Sector', 'slug' => 'midnight-sector', 'genre' => 'Dark Mysticism', 'average_rating' => 4.6, 'comics_count' => 63],
                (object) ['name' => 'Cosmic Front', 'slug' => 'cosmic-front', 'genre' => 'Space Opera', 'average_rating' => 4.7, 'comics_count' => 142],
                (object) ['name' => 'Mutant Dominion', 'slug' => 'mutant-dominion', 'genre' => 'Team Saga', 'average_rating' => 4.4, 'comics_count' => 119],
            ]);
            $recommendationLanes = [
                [
                    'title' => 'Because You Like Spider-Man',
                    'description' => 'Agility, wit, and emotional stakes in every issue.',
                    'items' => $trending->take(4),
                ],
                [
                    'title' => 'Dark Storylines You May Love',
                    'description' => 'My personal picks from the grittier side of Marvel canon.',
                    'items' => $latest->take(4),
                ],
            ];
        }

        return view('home', [
            'featured' => $featured,
            'trending' => $trending,
            'latest' => $latest,
            'characters' => $characters,
            'universes' => $universes,
            'publishersAndArcs' => $publishersAndArcs,
            'recommendationLanes' => $recommendationLanes,
            'stats' => $stats,
        ]);
    }
}
