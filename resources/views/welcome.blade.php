@extends('layouts.app')
@section('title', 'Marvel Vault | Home')

@section('content')
<div class="vault-page">
    <section class="vault-page-hero reveal" style="min-height:68vh;background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/banners/hero-banner-01.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Fandom-Driven Platform</p>
            <h1>Marvel Vault</h1>
            <p>A premium comic discovery and collection interface built for modern readers and hardcore fans.</p>
            <div class="vault-hero__cta mt-4">
                <a href="{{ route('home') }}" class="vault-btn vault-btn--accent">Enter Homepage Experience</a>
                <a href="{{ route('comics.index') }}" class="vault-btn vault-btn--ghost">Browse Comics</a>
            </div>
        </div>
    </section>
</div>
@endsection
