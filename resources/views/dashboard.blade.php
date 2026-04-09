@extends('layouts.app')

@section('title','Dashboard | Marvel Vault')

@section('content')
<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-03.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Command Center</p>
            <h1>Welcome back, {{ auth()->user()->name }}</h1>
            <p>Resume reading, track your wishlist, and manage your collector journey.</p>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container search-hub-grid">
            <a href="{{ route('comics.index') }}" class="bento">
                <h3>Continue Reading</h3>
                <p>Return to your in-progress issue stack.</p>
            </a>
            <a href="{{ route('comics.index') }}" class="bento">
                <h3>Wishlist</h3>
                <p>Manage saved comics and collector alerts.</p>
            </a>
            <a href="{{ route('characters.index') }}" class="bento">
                <h3>Character Tracker</h3>
                <p>Follow heroes and villains you care about.</p>
            </a>
            <a href="{{ route('series.index') }}" class="bento">
                <h3>Series Follows</h3>
                <p>Monitor arcs, events, and release cadence.</p>
            </a>
        </div>
    </section>
</div>
@endsection
