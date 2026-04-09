@extends('layouts.app')
@section('title', 'About Marvel Vault')

@section('content')
<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/banners/hero-banner-01.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Our Identity</p>
            <h1>Built By A Developer. Curated By A Fan.</h1>
            <p>Marvel Vault exists for readers who care about story order, creator legacy, first appearances, and emotionally unforgettable arcs.</p>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container detail-split-grid">
            <article class="bento">
                <h3>What Makes It Different</h3>
                <ul class="detail-list">
                    <li><span>Voice</span><strong>Geek-smart, cinematic, collector-first</strong></li>
                    <li><span>Curation</span><strong>Editorial shelves, not random dumps</strong></li>
                    <li><span>Design</span><strong>Dark premium UI with narrative motion</strong></li>
                    <li><span>Goal</span><strong>Fandom identity plus storefront clarity</strong></li>
                </ul>
            </article>
            <article class="bento">
                <h3>Creator Promise</h3>
                <p>This project is intentionally handcrafted to feel like a living fan archive, not a generic e-commerce skin. Every lane is designed to help readers discover, collect, and keep reading.</p>
            </article>
        </div>
    </section>
</div>
@endsection
