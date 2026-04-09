@extends('layouts.app')
@section('title', 'Marvel Vault | Curated Comic Universe')

@section('content')
@php
    $heroComic = $featured->first();
    $vaultCovers = [
        asset('images/vault/covers/cover-01.jpg'),
        asset('images/vault/covers/cover-02.jpg'),
        asset('images/vault/covers/cover-03.jpg'),
        asset('images/vault/covers/cover-04.jpg'),
    ];
    $vaultCharacters = [
        asset('images/vault/characters/char-01.jpg'),
        asset('images/vault/characters/char-02.jpg'),
        asset('images/vault/characters/char-03.jpg'),
        asset('images/vault/characters/char-04.jpg'),
        asset('images/vault/characters/char-05.jpg'),
    ];
    $vaultUniverses = [
        asset('images/vault/universes/universe-01.jpg'),
        asset('images/vault/universes/universe-02.jpg'),
        asset('images/vault/universes/universe-03.jpg'),
        asset('images/vault/universes/universe-04.jpg'),
        asset('images/vault/universes/universe-05.jpg'),
    ];
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="min-height: 68vh; background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/banners/hero-banner-01.jpg') }}')">
        <div class="container detail-hero-grid">
            <div>
                <p class="vault-kicker">Curated By A Dev + Lifelong Fan</p>
                <h1>Enter The Multiverse Vault</h1>
                <p>Cinematic comic discovery with collector DNA. Built for readers who care about story arcs, key issues, and creator legacy.</p>

                <div class="detail-meta-grid mt-4">
                    <div><strong>{{ number_format($stats['comics'] ?? 0) }}</strong><span>Issues Indexed</span></div>
                    <div><strong>{{ number_format($stats['characters'] ?? 0) }}</strong><span>Characters</span></div>
                    <div><strong>{{ number_format($stats['series'] ?? 0) }}</strong><span>Universes</span></div>
                    <div><strong>{{ number_format($stats['active_readers'] ?? 0) }}</strong><span>Weekly Readers</span></div>
                    <div><strong>2026</strong><span>Design Direction</span></div>
                    <div><strong>Vault</strong><span>Collector System</span></div>
                </div>

                <div class="vault-hero__cta mt-4">
                    <a href="{{ route('comics.index') }}" class="vault-btn vault-btn--accent">Explore Issues</a>
                    <a href="#trending" class="vault-btn vault-btn--ghost">View Trending</a>
                </div>
            </div>

            @if($heroComic)
                <article class="catalog-card">
                    <img src="{{ $heroComic->cover_image ?? $vaultCovers[0] }}" alt="{{ $heroComic->title }}" loading="eager" fetchpriority="high" decoding="async">
                    <div class="catalog-card__body">
                        <p>Featured Drop</p>
                        <h3>{{ $heroComic->title }}</h3>
                        <small>{{ optional($heroComic->series)->name ?? 'Marvel Vault' }}</small>
                        <div class="tile-meta">
                            <span><i class="fas fa-star"></i> {{ $heroComic->rating ? number_format((float)$heroComic->rating, 1) : '4.6' }}</span>
                            <span>{{ $heroComic->price ? '$' . number_format((float)$heroComic->price, 2) : '$4.99' }}</span>
                        </div>
                        <div class="tile-actions mt-3">
                            <a href="{{ route('comics.show', $heroComic->slug ?? $heroComic->id) }}" class="vault-btn vault-btn--accent">Read Synopsis</a>
                            <button
                                type="button"
                                class="vault-btn vault-btn--ghost quick-preview"
                                data-title="{{ $heroComic->title }}"
                                data-image="{{ $heroComic->cover_image ?? $vaultCovers[0] }}"
                                data-description="{{ \Illuminate\Support\Str::limit($heroComic->description ?? 'No synopsis available.', 220) }}"
                                data-series="{{ optional($heroComic->series)->name ?? 'Marvel Vault' }}"
                                data-price="{{ $heroComic->price ? '$' . number_format((float)$heroComic->price, 2) : '$4.99' }}"
                                data-rating="{{ $heroComic->rating ? number_format((float)$heroComic->rating, 1) : '4.6' }}"
                                data-url="{{ route('comics.show', $heroComic->slug ?? $heroComic->id) }}"
                            >Quick Preview</button>
                        </div>
                    </div>
                </article>
            @endif
        </div>
    </section>

    <section class="vault-section reveal" id="trending">
        <div class="container">
            <div class="section-head">
                <h2>Trending Comics</h2>
                <a href="{{ route('comics.index') }}">See all issues</a>
            </div>
            <div class="catalog-grid">
                @foreach($trending->take(8) as $comic)
                    <article class="catalog-card">
                        <img src="{{ $comic->cover_image ?? $vaultCovers[$loop->index % count($vaultCovers)] }}" alt="{{ $comic->title }}" loading="lazy" decoding="async">
                        <div class="catalog-card__body">
                            <p>{{ optional($comic->series)->name ?? 'Unknown Universe' }}</p>
                            <h3>{{ $comic->title }}</h3>
                            <small>Issue #{{ $comic->issue_number ?? 'N/A' }}</small>
                            <div class="tile-meta">
                                <span><i class="fas fa-star"></i> {{ $comic->rating ? number_format((float)$comic->rating, 1) : '4.5' }}</span>
                                <span>{{ $comic->price ? '$' . number_format((float)$comic->price, 2) : '$4.99' }}</span>
                            </div>
                            <div class="tile-actions mt-3">
                                <a href="{{ route('comics.show', $comic->slug ?? $comic->id) }}" class="vault-btn vault-btn--accent">Add to Cart</a>
                                <button
                                    type="button"
                                    class="vault-btn vault-btn--ghost quick-preview"
                                    data-title="{{ $comic->title }}"
                                    data-image="{{ $comic->cover_image ?? $vaultCovers[$loop->index % count($vaultCovers)] }}"
                                    data-description="{{ \Illuminate\Support\Str::limit($comic->description ?? 'No synopsis available.', 220) }}"
                                    data-series="{{ optional($comic->series)->name ?? 'Marvel Vault' }}"
                                    data-price="{{ $comic->price ? '$' . number_format((float)$comic->price, 2) : '$4.99' }}"
                                    data-rating="{{ $comic->rating ? number_format((float)$comic->rating, 1) : '4.6' }}"
                                    data-url="{{ route('comics.show', $comic->slug ?? $comic->id) }}"
                                >Preview</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container detail-split-grid">
            <article class="bento">
                <div class="section-head">
                    <h2>Latest Releases</h2>
                </div>
                <div class="release-row">
                    @foreach($latest->take(6) as $comic)
                        <a href="{{ route('comics.show', $comic->slug ?? $comic->id) }}" class="release-chip">
                            <img src="{{ $comic->cover_image ?? $vaultCovers[$loop->index % count($vaultCovers)] }}" alt="{{ $comic->title }}" loading="lazy" decoding="async">
                            <div>
                                <strong>{{ \Illuminate\Support\Str::limit($comic->title, 28) }}</strong>
                                <span>{{ optional($comic->release_date)->format('M d, Y') ?? now()->subDays($loop->index)->format('M d, Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </article>

            <article class="bento">
                <div class="section-head">
                    <h2>Popular Characters</h2>
                </div>
                <div class="character-stack">
                    @foreach($characters->take(6) as $character)
                        <a href="{{ route('characters.show', $character->slug ?? $character->id) }}" class="character-item">
                            <img src="{{ $character->image_url ?? $character->thumbnail_url ?? $vaultCharacters[$loop->index % count($vaultCharacters)] }}" alt="{{ $character->name }}" loading="lazy" decoding="async">
                            <div>
                                <strong>{{ $character->name }}</strong>
                                <span>{{ ucfirst($character->type ?? 'Hero') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </article>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>Browse By Universe</h2>
                <a href="{{ route('series.index') }}">Open universe map</a>
            </div>
            <div class="series-grid-v2">
                @foreach($universes as $universe)
                    <article class="series-card-v2">
                        <img src="{{ $vaultUniverses[$loop->index % count($vaultUniverses)] }}" alt="{{ $universe->name }}" loading="lazy" decoding="async">
                        <div>
                            <p>{{ strtoupper($universe->genre ?? 'MARVEL ARC') }}</p>
                            <h3>{{ $universe->name }}</h3>
                            <small>{{ number_format((int)($universe->comics_count ?? 0)) }} issues</small>
                            <p class="series-copy">Universe score {{ $universe->average_rating ? number_format((float)$universe->average_rating, 1) : '4.7' }} with high fan momentum.</p>
                            <a href="{{ route('series.show', $universe->slug ?? $universe->id) }}" class="vault-btn vault-btn--accent">Enter Universe</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container search-hub-grid">
            @foreach($publishersAndArcs as $item)
                <article class="bento">
                    <p class="vault-kicker">{{ $item['tag'] }}</p>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['subtitle'] }}</p>
                    <p class="mt-3">{{ $item['description'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            @foreach($recommendationLanes as $lane)
                <article class="bento" style="margin-bottom: 0.75rem;">
                    <div class="section-head">
                        <h2>{{ $lane['title'] }}</h2>
                    </div>
                    <p style="color: var(--text-dim); margin-top: -0.35rem; margin-bottom: 0.75rem;">{{ $lane['description'] }}</p>
                    <div class="catalog-grid">
                        @foreach($lane['items'] as $comic)
                            <article class="catalog-card">
                                <img src="{{ $comic->cover_image ?? $vaultCovers[($loop->parent->index + $loop->index) % count($vaultCovers)] }}" alt="{{ $comic->title }}" loading="lazy" decoding="async">
                                <div class="catalog-card__body">
                                    <p>{{ optional($comic->series)->name ?? 'Marvel Vault' }}</p>
                                    <h3>{{ \Illuminate\Support\Str::limit($comic->title, 28) }}</h3>
                                    <small>{{ $comic->price ? '$' . number_format((float)$comic->price, 2) : '$4.99' }}</small>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="vault-section reveal collector-manifesto">
        <div class="container collector-manifesto__layout">
            <div>
                <p class="vault-kicker">Collector Identity</p>
                <h2>The Curator's Desk</h2>
                <p>Built by a developer who actually reads and collects. Every shelf and recommendation lane exists to celebrate fandom, not just transactions.</p>
                <div class="collector-badges">
                    <span>First Appearance Tracker</span>
                    <span>Key Issue Radar</span>
                    <span>Creator Spotlight Notes</span>
                </div>
            </div>
            <aside class="collector-panel">
                <h3>Fan Utility</h3>
                <ul>
                    <li>Continue reading queue</li>
                    <li>Recently viewed timeline</li>
                    <li>Wishlist and cart handoff</li>
                    <li>Weekly event digest newsletter</li>
                </ul>
            </aside>
        </div>
    </section>
</div>

<div class="vault-preview" id="vaultPreview" aria-hidden="true">
    <div class="vault-preview__backdrop" data-close-preview="true"></div>
    <article class="vault-preview__card">
        <button type="button" class="vault-preview__close" data-close-preview="true" aria-label="Close preview">&times;</button>
        <img src="" alt="Preview cover" id="previewImage">
        <div>
            <p id="previewSeries"></p>
            <h3 id="previewTitle"></h3>
            <p id="previewDescription"></p>
            <div class="preview-meta">
                <span id="previewRating"></span>
                <span id="previewPrice"></span>
            </div>
            <a href="#" id="previewLink" class="vault-btn vault-btn--accent">Open Comic</a>
        </div>
    </article>
</div>
@endsection
