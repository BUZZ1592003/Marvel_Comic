@extends('layouts.app')
@section('title', ($character->name ?? 'Character') . ' | Character Profile')

@section('content')
@php
    $portrait = $character->image_url ?: $character->thumbnail_url ?: asset('images/vault/characters/char-01.jpg');
    $characterComics = $character->comics ?? collect();
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-01.jpg') }}')">
        <div class="container detail-hero-grid">
            <img src="{{ $portrait }}" alt="{{ $character->name }}" class="detail-cover detail-cover--portrait" loading="eager" fetchpriority="high">
            <div>
                <p class="vault-kicker">Character Dossier</p>
                <h1>{{ $character->name }}</h1>
                <p>{{ $character->description ?: 'No biography available yet.' }}</p>

                <div class="detail-meta-grid">
                    <div><strong>{{ ucfirst($character->type ?: 'Unknown') }}</strong><span>Type</span></div>
                    <div><strong>{{ $character->real_name ?: 'Unknown' }}</strong><span>Real Name</span></div>
                    <div><strong>{{ $character->alias ?: 'N/A' }}</strong><span>Alias</span></div>
                    <div><strong>{{ $character->first_appearance ?: 'N/A' }}</strong><span>First Appearance</span></div>
                    <div><strong>{{ $character->origin ?: 'Unknown' }}</strong><span>Origin</span></div>
                    <div><strong>{{ $character->status ?: 'Unknown' }}</strong><span>Status</span></div>
                </div>

                <div class="vault-hero__cta mt-4">
                    <button class="vault-btn vault-btn--accent" type="button">Follow Character</button>
                    <a href="{{ route('characters.index') }}" class="vault-btn vault-btn--ghost">Back to Atlas</a>
                </div>
            </div>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container detail-split-grid">
            <article class="bento">
                <h3>Power Metrics</h3>
                <ul class="detail-list">
                    <li><span>Intelligence</span><strong>{{ $character->intelligence ?? 0 }}/100</strong></li>
                    <li><span>Strength</span><strong>{{ $character->strength ?? 0 }}/100</strong></li>
                    <li><span>Speed</span><strong>{{ $character->speed ?? 0 }}/100</strong></li>
                    <li><span>Durability</span><strong>{{ $character->durability ?? 0 }}/100</strong></li>
                    <li><span>Energy Projection</span><strong>{{ $character->energy_projection ?? 0 }}/100</strong></li>
                    <li><span>Fighting Skills</span><strong>{{ $character->fighting_skills ?? 0 }}/100</strong></li>
                </ul>
            </article>
            <article class="bento">
                <h3>Affiliations & Powers</h3>
                <p>{{ is_array($character->powers) ? implode(', ', $character->powers) : ($character->powers ?: 'Powers not listed.') }}</p>
                <p class="mt-3">{{ is_array($character->teams) ? 'Teams: ' . implode(', ', $character->teams) : ($character->teams ? 'Teams: ' . $character->teams : 'No team data available.') }}</p>
            </article>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="section-head">
                <h2>Comics Featuring {{ $character->name }}</h2>
            </div>
            <div class="catalog-grid">
                @forelse($characterComics->take(8) as $comic)
                    <article class="catalog-card">
                        <img src="{{ $comic->cover_image ?: asset('images/vault/covers/cover-01.jpg') }}" alt="{{ $comic->title }}" loading="lazy" decoding="async">
                        <div class="catalog-card__body">
                            <p>{{ optional($comic->series)->name ?? 'Mainline' }}</p>
                            <h3>{{ $comic->title }}</h3>
                            <small>Issue #{{ $comic->issue_number ?? 'N/A' }}</small>
                            <a href="{{ route('comics.show', $comic->slug ?? $comic->id) }}" class="vault-btn vault-btn--accent mt-3">Open Issue</a>
                        </div>
                    </article>
                @empty
                    <article class="vault-empty">
                        <h3>No comics linked yet</h3>
                        <p>This character profile is ready for incoming issue associations.</p>
                    </article>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
