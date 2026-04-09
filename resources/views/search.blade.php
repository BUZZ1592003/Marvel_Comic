@extends('layouts.app')
@section('title', 'Search | Marvel Vault')

@section('content')
<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-01.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Discovery</p>
            <h1>Search the Vault</h1>
            <p>Jump into comics, characters, and universes from one command panel.</p>

            <form method="GET" action="{{ route('search') }}" class="vault-toolbar mt-4">
                <input type="search" name="q" value="{{ $query }}" placeholder="Try: Spider-Man, cosmic saga, Doctor Doom">
                <button type="submit" class="vault-btn vault-btn--accent">Search</button>
            </form>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container search-hub-grid">
            <a href="{{ route('comics.index', ['search' => $query]) }}" class="bento">
                <h3>Search Comics</h3>
                <p>Open issue catalog with your query pre-filled.</p>
            </a>
            <a href="{{ route('characters.index', ['search' => $query]) }}" class="bento">
                <h3>Search Characters</h3>
                <p>Find heroes, villains, and anti-heroes quickly.</p>
            </a>
            <a href="{{ route('series.index', ['search' => $query]) }}" class="bento">
                <h3>Search Series</h3>
                <p>Browse long-form runs and event-driven arcs.</p>
            </a>
        </div>
    </section>
</div>
@endsection
