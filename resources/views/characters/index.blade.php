@extends('layouts.app')
@section('title', 'Character Atlas | Marvel Vault')

@section('content')
@php
    $fallbackCharacters = [
        asset('images/vault/characters/char-01.jpg'),
        asset('images/vault/characters/char-02.jpg'),
        asset('images/vault/characters/char-03.jpg'),
        asset('images/vault/characters/char-04.jpg'),
        asset('images/vault/characters/char-05.jpg'),
    ];
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-03.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Atlas</p>
            <h1>Characters</h1>
            <p>Heroes, villains, anti-heroes, and iconic personalities across every timeline.</p>

            <form method="GET" action="{{ route('characters.index') }}" class="vault-toolbar mt-4">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name or alias">
                <select name="type">
                    <option value="">All Types</option>
                    <option value="hero" @selected(request('type') === 'hero')>Hero</option>
                    <option value="villain" @selected(request('type') === 'villain')>Villain</option>
                    <option value="antihero" @selected(request('type') === 'antihero')>Anti-Hero</option>
                    <option value="neutral" @selected(request('type') === 'neutral')>Neutral</option>
                </select>
                <button class="vault-btn vault-btn--accent" type="submit">Apply</button>
            </form>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>{{ number_format($characters->total()) }} Characters</h2>
                <a href="{{ route('characters.more') }}">Open Extended Roster</a>
            </div>

            <div class="character-grid">
                @forelse($characters as $character)
                    <article class="character-card-v2">
                        <img src="{{ $character->image_url ?: $character->thumbnail_url ?: $fallbackCharacters[$loop->index % count($fallbackCharacters)] }}" alt="{{ $character->name }}" loading="lazy" decoding="async">
                        <div>
                            <p>{{ strtoupper($character->type ?: 'character') }}</p>
                            <h3>{{ $character->name }}</h3>
                            <small>{{ $character->alias ?: $character->real_name ?: 'No alias listed' }}</small>

                            <div class="stat-mini">
                                <span>INT {{ $character->intelligence ?? 0 }}</span>
                                <span>STR {{ $character->strength ?? 0 }}</span>
                                <span>SPD {{ $character->speed ?? 0 }}</span>
                            </div>

                            <a href="{{ route('characters.show', $character->slug ?? $character->id) }}" class="vault-btn vault-btn--accent">View Profile</a>
                        </div>
                    </article>
                @empty
                    <article class="vault-empty">
                        <h3>No characters found</h3>
                        <p>Adjust your filters to explore the roster.</p>
                    </article>
                @endforelse
            </div>

            @if($characters->hasPages())
                <div class="vault-pagination">
                    {{ $characters->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
