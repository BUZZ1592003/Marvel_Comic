@extends('layouts.app')
@section('title', 'Universe Series | Marvel Vault')

@section('content')
@php
    $fallbackUniverse = [
        asset('images/vault/universes/universe-01.jpg'),
        asset('images/vault/universes/universe-02.jpg'),
        asset('images/vault/universes/universe-03.jpg'),
        asset('images/vault/universes/universe-04.jpg'),
        asset('images/vault/universes/universe-05.jpg'),
    ];
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-03.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Universe Map</p>
            <h1>Series & Story Lines</h1>
            <p>Navigate ongoing and completed runs across timeline-defining universes.</p>

            <form method="GET" action="{{ route('series.index') }}" class="vault-toolbar mt-4">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search a series">
                <select name="status">
                    <option value="">All Status</option>
                    <option value="ongoing" @selected(request('status') === 'ongoing')>Ongoing</option>
                    <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
                    <option value="hiatus" @selected(request('status') === 'hiatus')>Hiatus</option>
                </select>
                <select name="sort">
                    <option value="popularity_score" @selected(request('sort', 'popularity_score') === 'popularity_score')>Popularity</option>
                    <option value="average_rating" @selected(request('sort') === 'average_rating')>Rating</option>
                    <option value="start_year" @selected(request('sort') === 'start_year')>Start Year</option>
                    <option value="name" @selected(request('sort') === 'name')>Name</option>
                </select>
                <button class="vault-btn vault-btn--accent" type="submit">Apply</button>
            </form>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>{{ number_format($series->total()) }} Series Indexed</h2>
            </div>

            <div class="series-grid-v2">
                @forelse($series as $entry)
                    <article class="series-card-v2">
                        <img src="{{ $entry->image_url ?: $fallbackUniverse[$loop->index % count($fallbackUniverse)] }}" alt="{{ $entry->name }}" loading="lazy" decoding="async">
                        <div>
                            <p>{{ strtoupper($entry->status ?: 'unknown') }}</p>
                            <h3>{{ $entry->name }}</h3>
                            <small>{{ $entry->genre ?: 'Comic Saga' }}</small>
                            <p class="series-copy">{{ \Illuminate\Support\Str::limit($entry->description ?: 'No synopsis available yet.', 130) }}</p>
                            <div class="detail-list-inline">
                                <span>{{ $entry->start_year ?: 'N/A' }}</span>
                                <span>{{ $entry->total_issues ?: 0 }} issues</span>
                                <span>{{ $entry->average_rating ? number_format((float)$entry->average_rating, 1) : '4.5' }} score</span>
                            </div>
                            <a href="{{ route('series.show', $entry->slug ?? $entry->id) }}" class="vault-btn vault-btn--accent">Open Series</a>
                        </div>
                    </article>
                @empty
                    <article class="vault-empty">
                        <h3>No series available</h3>
                        <p>Try another filter or add new series in your admin panel.</p>
                    </article>
                @endforelse
            </div>

            @if($series->hasPages())
                <div class="vault-pagination">
                    {{ $series->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
