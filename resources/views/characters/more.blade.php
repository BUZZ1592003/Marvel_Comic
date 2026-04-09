@extends('layouts.app')
@section('title', 'Extended Character Roster | Marvel Vault')

@section('content')
@php
    $extended = [
        ['name' => 'Deadpool', 'alias' => 'Wade Wilson', 'type' => 'antihero', 'image' => asset('images/vault/characters/char-04.jpg')],
        ['name' => 'Silver Surfer', 'alias' => 'Norrin Radd', 'type' => 'hero', 'image' => asset('images/vault/characters/char-05.jpg')],
        ['name' => 'Venom', 'alias' => 'Eddie Brock', 'type' => 'antihero', 'image' => asset('images/vault/characters/char-02.jpg')],
        ['name' => 'Ghost Rider', 'alias' => 'Johnny Blaze', 'type' => 'antihero', 'image' => asset('images/vault/characters/char-03.jpg')],
        ['name' => 'Green Goblin', 'alias' => 'Norman Osborn', 'type' => 'villain', 'image' => asset('images/vault/characters/char-01.jpg')],
        ['name' => 'Captain Marvel', 'alias' => 'Carol Danvers', 'type' => 'hero', 'image' => asset('images/vault/characters/char-05.jpg')],
    ];
@endphp

<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-02.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Extended Atlas</p>
            <h1>More Characters</h1>
            <p>Deep-cut fan favorites, cosmic entities, anti-heroes, and legacy antagonists.</p>
            <div class="vault-hero__cta mt-4">
                <a href="{{ route('characters.index') }}" class="vault-btn vault-btn--ghost">Back to Main Atlas</a>
            </div>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container">
            <div class="character-grid">
                @foreach($extended as $card)
                    <article class="character-card-v2">
                        <img src="{{ $card['image'] }}" alt="{{ $card['name'] }}" loading="lazy" decoding="async">
                        <div>
                            <p>{{ strtoupper($card['type']) }}</p>
                            <h3>{{ $card['name'] }}</h3>
                            <small>{{ $card['alias'] }}</small>
                            <div class="stat-mini">
                                <span>Legacy Arc</span>
                                <span>Collector Pick</span>
                            </div>
                            <a href="{{ route('characters.index') }}" class="vault-btn vault-btn--ghost">Track Profile</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
