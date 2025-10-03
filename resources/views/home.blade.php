{{-- resources/views/home.blade.php --}}
@extends('layouts.app')
@section('title', 'Marvel Comics - Home')

@section('content')
{{-- Hero Section --}}
<section class="hero-section py-5">
    <div class="container">
        <div class="hero-content text-center">
            <h1>MARVEL <span class="text-danger">UNIVERSE</span></h1>
            <p class="lead">
                Discover the greatest superhero stories, iconic characters, and epic adventures
                that have captivated readers for decades.
            </p>
            <div class="hero-buttons mt-3">
                <a href="{{ route('comics.index') }}" class="btn btn-marvel mr-2">
                    <i class="fas fa-book-open"></i> Explore Comics
                </a>
                <a href="{{ route('characters.index') }}" class="btn btn-outline">
                    <i class="fas fa-users"></i> Meet Characters
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Featured Comics Section --}}
<section class="p-5">
    <div class="container">
        <h2 class="section-title">Featured Comics</h2>
        <div class="featured-layout">
            @php
                $main = $featured->first();
                $side = $featured->slice(1);
            @endphp

            <div class="featured-main">
                <div class="comic-hero-card">
                    <img src="{{ $main->cover_image ?? 'https://picsum.photos/seed/hero/800/1200' }}" alt="{{ $main->title }}" class="comic-hero-cover">
                    <div class="comic-hero-info">
                        <div class="mb-2">
                            @if(isset($main->characters) && method_exists($main->characters, 'isNotEmpty') ? $main->characters->isNotEmpty() : (count(($main->characters ?? []))>0))
                                <span class="character-badge">{{ is_object($main->characters[0]) ? $main->characters[0]->name : ($main->characters[0] ?? '') }}</span>
                            @endif
                        </div>
                        <h2 class="comic-hero-title">{{ $main->title }}</h2>
                        <h4 class="comic-hero-series">{{ optional($main->series)->name ?? (is_array($main->series) ? ($main->series['name'] ?? '') : ($main->series->name ?? '')) }}</h4>
                        <p class="comic-hero-desc">{{ \Illuminate\Support\Str::limit($main->description ?? '', 220) }}</p>
                        <div class="comic-hero-meta">
                            <small class="text-muted">{{ optional($main->release_date)->format('F Y') ?? (is_object($main->release_date) ? $main->release_date->format('F Y') : now()->format('F Y')) }} &bull; {{ $main->page_count ?? '—' }} pages</small>
                            @if(Route::has('comics.show') && isset($main->id))
                                <a href="{{ route('comics.show', $main->id) }}" class="btn btn-marvel btn-lg">Read Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <aside class="featured-side">
                @foreach($side as $comic)
                    <div class="side-thumb">
                        <img src="{{ $comic->cover_image ?? 'https://picsum.photos/seed/thumb' . $loop->index . '/300/450' }}" alt="{{ $comic->title }}">
                        <div class="side-meta">
                            <strong>{{ \Illuminate\Support\Str::limit($comic->title, 28) }}</strong>
                            <small class="text-muted">{{ optional($comic->release_date)->format('M Y') ?? '' }}</small>
                        </div>
                    </div>
                @endforeach
            </aside>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('comics.index') }}" class="btn btn-outline">
                View All Comics <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- Recent Comics Section --}}
@if(isset($recent) && $recent->isNotEmpty())
<section class="p-5 bg-light">
    <div class="container">
        <h2 class="section-title">Recent Releases</h2>
        <div class="comic-grid">
            @foreach($recent as $comic)
                <div class="comic-card">
                    <img src="{{ $comic->cover_image ?? 'https://picsum.photos/400/600?random=' . $comic->id }}" class="comic-cover" alt="{{ $comic->title }}">
                    <div class="comic-info">
                        <h5 class="comic-title">{{ $comic->title }}</h5>
                        <h6 class="comic-series">{{ optional($comic->series)->name }}</h6>
                        <div class="comic-meta">
                            <small class="text-muted">{{ optional($comic->release_date)->format('F Y') ?? '' }}</small>
                            <a href="{{ route('comics.show', $comic) }}" class="btn btn-sm btn-marvel ml-2">Read</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Statistics Section --}}
<section class="stats-section py-5">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <h3>{{ number_format($stats['comics'] ?? 0) }}</h3>
                <p>Comic Issues</p>
            </div>
            <div class="stat-item">
                <h3>{{ number_format($stats['characters'] ?? 0) }}</h3>
                <p>Iconic Characters</p>
            </div>
            <div class="stat-item">
                <h3>{{ number_format($stats['series'] ?? 0) }}</h3>
                <p>Comic Series</p>
            </div>
            <div class="stat-item">
                <h3>{{ $stats['years'] ?? '—' }}</h3>
                <p>Years of Stories</p>
            </div>
        </div>
    </div>
</section>
@endsection