@extends('layouts.app')
@section('title', ($series->name ?? 'Series') . ' | Series Detail')

@section('content')
@php
    $banner = $series->image_url ?: asset('images/vault/universes/universe-01.jpg');
    $issues = $series->comics ?? collect();
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ $banner }}')">
        <div class="container">
            <p class="vault-kicker">Series Detail</p>
            <h1>{{ $series->name }}</h1>
            <p>{{ $series->description ?: 'No series synopsis available yet.' }}</p>

            <div class="detail-meta-grid mt-4">
                <div><strong>{{ $series->status ?: 'Unknown' }}</strong><span>Status</span></div>
                <div><strong>{{ $series->start_year ?: 'N/A' }}</strong><span>Start Year</span></div>
                <div><strong>{{ $series->end_year ?: 'Present' }}</strong><span>End Year</span></div>
                <div><strong>{{ $series->total_issues ?: $issues->count() }}</strong><span>Total Issues</span></div>
                <div><strong>{{ $series->publisher ?: 'Marvel' }}</strong><span>Publisher</span></div>
                <div><strong>{{ $series->genre ?: 'Superhero' }}</strong><span>Genre</span></div>
            </div>

            <div class="vault-hero__cta mt-4">
                <button type="button" class="vault-btn vault-btn--accent">Follow Series</button>
                <a href="{{ route('series.index') }}" class="vault-btn vault-btn--ghost">Back to Series</a>
            </div>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>Recent Issues</h2>
                <a href="{{ route('comics.index', ['search' => $series->name]) }}">Browse all issues</a>
            </div>
            <div class="catalog-grid">
                @forelse($issues->take(12) as $comic)
                    <article class="catalog-card">
                        <img src="{{ $comic->cover_image ?: asset('images/vault/covers/cover-02.jpg') }}" alt="{{ $comic->title }}" loading="lazy" decoding="async">
                        <div class="catalog-card__body">
                            <p>{{ $series->name }}</p>
                            <h3>{{ $comic->title }}</h3>
                            <small>Issue #{{ $comic->issue_number ?? 'N/A' }}</small>
                            <div class="tile-meta">
                                <span>{{ optional($comic->release_date)->format('M d, Y') ?? 'TBA' }}</span>
                                <span>{{ $comic->price ? '$' . number_format((float)$comic->price, 2) : '$4.99' }}</span>
                            </div>
                            <a href="{{ route('comics.show', $comic->slug ?? $comic->id) }}" class="vault-btn vault-btn--accent mt-3">Read Issue</a>
                        </div>
                    </article>
                @empty
                    <article class="vault-empty">
                        <h3>No issues in this series yet</h3>
                        <p>Publish comics under this series to populate the timeline.</p>
                    </article>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
