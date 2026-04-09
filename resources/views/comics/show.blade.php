@extends('layouts.app')
@section('title', ($comic->title ?? 'Comic') . ' | Issue Detail')

@section('content')
@php
    $cover = $comic->cover_image ?: asset('images/vault/covers/cover-01.jpg');
    $pages = $comic->pages ?? collect();
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-02.jpg') }}')">
        <div class="container detail-hero-grid">
            <img src="{{ $cover }}" alt="{{ $comic->title }}" class="detail-cover" loading="eager" fetchpriority="high">
            <div>
                <p class="vault-kicker">Issue Detail</p>
                <h1>{{ $comic->title }}</h1>
                <p>{{ $comic->description ?: 'No synopsis provided yet for this issue.' }}</p>

                <div class="detail-meta-grid">
                    <div><strong>{{ optional($comic->series)->name ?? 'Standalone' }}</strong><span>Series</span></div>
                    <div><strong>#{{ $comic->issue_number ?? 'N/A' }}</strong><span>Issue</span></div>
                    <div><strong>{{ $comic->page_count ?? 0 }}</strong><span>Pages</span></div>
                    <div><strong>{{ optional($comic->release_date)->format('M d, Y') ?? 'TBA' }}</strong><span>Release</span></div>
                    <div><strong>{{ $comic->writer ?: 'Unknown' }}</strong><span>Writer</span></div>
                    <div><strong>{{ $comic->artist ?: 'Unknown' }}</strong><span>Artist</span></div>
                </div>

                <div class="vault-hero__cta mt-4">
                    <button type="button" class="vault-btn vault-btn--accent">Add to Cart</button>
                    <button type="button" class="vault-btn vault-btn--ghost">Add to Wishlist</button>
                    <a href="{{ route('comics.index') }}" class="vault-btn vault-btn--ghost">Back to Catalog</a>
                </div>
            </div>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>Creators & Characters</h2>
            </div>
            <div class="detail-split-grid">
                <article class="bento">
                    <h3>Creative Team</h3>
                    <ul class="detail-list">
                        <li><span>Writer</span><strong>{{ $comic->writer ?: 'TBA' }}</strong></li>
                        <li><span>Artist</span><strong>{{ $comic->artist ?: 'TBA' }}</strong></li>
                        <li><span>Colorist</span><strong>{{ $comic->colorist ?: 'TBA' }}</strong></li>
                        <li><span>Letterer</span><strong>{{ $comic->letterer ?: 'TBA' }}</strong></li>
                    </ul>
                </article>
                <article class="bento">
                    <h3>Featured Characters</h3>
                    <div class="character-chip-grid">
                        @forelse($comic->characters as $character)
                            <a href="{{ route('characters.show', $character->slug ?? $character->id) }}" class="character-chip">
                                <img src="{{ $character->image_url ?: asset('images/vault/characters/char-01.jpg') }}" alt="{{ $character->name }}" loading="lazy">
                                <span>{{ $character->name }}</span>
                            </a>
                        @empty
                            <p class="text-dim">No linked characters yet.</p>
                        @endforelse
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>Reader Preview</h2>
            </div>
            <div class="reader-grid">
                @if($pages->isNotEmpty())
                    @foreach($pages->take(6) as $page)
                        <figure class="reader-page">
                            <img src="{{ $page->image_url ?: $cover }}" alt="Page {{ $page->page_number }}" loading="lazy" decoding="async">
                            <figcaption>Page {{ $page->page_number }}</figcaption>
                        </figure>
                    @endforeach
                @else
                    @for($i = 1; $i <= 6; $i++)
                        <figure class="reader-page">
                            <img src="{{ asset('images/vault/backgrounds/bg-neon-0' . (($i % 3) + 1) . '.jpg') }}" alt="Preview panel {{ $i }}" loading="lazy" decoding="async">
                            <figcaption>Preview {{ $i }}</figcaption>
                        </figure>
                    @endfor
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
