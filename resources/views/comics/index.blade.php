@extends('layouts.app')
@section('title', 'Comic Vault | Browse Issues')

@section('content')
@php
    $fallbackCovers = [
        asset('images/vault/covers/cover-01.jpg'),
        asset('images/vault/covers/cover-02.jpg'),
        asset('images/vault/covers/cover-03.jpg'),
        asset('images/vault/covers/cover-04.jpg'),
    ];
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.62)), url('{{ asset('images/vault/backgrounds/bg-neon-01.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Catalog</p>
            <h1>Comic Issues</h1>
            <p>Search, filter, and collect storylines with cinematic curation and storefront clarity.</p>

            <form method="GET" action="{{ route('comics.index') }}" class="vault-toolbar mt-4">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search issues or series">
                <select name="status">
                    <option value="">All Status</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                    <option value="upcoming" @selected(request('status') === 'upcoming')>Upcoming</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                </select>
                <select name="sort">
                    <option value="release_date" @selected(request('sort', 'release_date') === 'release_date')>Release Date</option>
                    <option value="rating" @selected(request('sort') === 'rating')>Rating</option>
                    <option value="price" @selected(request('sort') === 'price')>Price</option>
                    <option value="title" @selected(request('sort') === 'title')>Title</option>
                </select>
                <button class="vault-btn vault-btn--accent" type="submit">Apply</button>
            </form>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>{{ number_format($comics->total()) }} Results</h2>
            </div>

            <div class="catalog-grid">
                @forelse($comics as $comic)
                    <article class="catalog-card">
                        <img src="{{ $comic->cover_image ?: $fallbackCovers[$loop->index % count($fallbackCovers)] }}" alt="{{ $comic->title }}" loading="lazy" decoding="async">
                        <div class="catalog-card__body">
                            <p>{{ optional($comic->series)->name ?? 'Independent Arc' }}</p>
                            <h3>{{ $comic->title }}</h3>
                            <small>Issue #{{ $comic->issue_number ?? 'N/A' }}</small>
                            <div class="tile-meta">
                                <span><i class="fas fa-star"></i> {{ $comic->rating ? number_format((float)$comic->rating, 1) : '4.5' }}</span>
                                <span>{{ $comic->price ? '$' . number_format((float)$comic->price, 2) : '$4.99' }}</span>
                            </div>
                            <div class="tile-actions">
                                <a href="{{ route('comics.show', $comic->slug ?? $comic->id) }}" class="vault-btn vault-btn--accent">View Issue</a>
                                <button type="button" class="vault-btn vault-btn--ghost">Save</button>
                            </div>
                        </div>
                    </article>
                @empty
                    <article class="vault-empty">
                        <h3>No comics matched your filters</h3>
                        <p>Try a different search, sort, or status to discover more issues.</p>
                    </article>
                @endforelse
            </div>

            @if($comics->hasPages())
                <div class="vault-pagination">
                    {{ $comics->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
