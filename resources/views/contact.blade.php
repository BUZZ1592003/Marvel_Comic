@extends('layouts.app')
@section('title', 'Contact Marvel Vault')

@section('content')
<div class="vault-page">
    <section class="vault-page-hero reveal" style="background-image: linear-gradient(130deg, rgba(8,11,17,0.92), rgba(8,11,17,0.64)), url('{{ asset('images/vault/backgrounds/bg-neon-02.jpg') }}')">
        <div class="container">
            <p class="vault-kicker">Contact</p>
            <h1>Let’s Talk Comics</h1>
            <p>Share feedback, report issues, request features, or pitch a crossover-ready idea.</p>
        </div>
    </section>

    <section class="vault-section reveal">
        <div class="container detail-split-grid">
            <article class="bento">
                <h3>Send A Message</h3>
                <form class="vault-form">
                    <input type="text" placeholder="Your name" aria-label="Your name">
                    <input type="email" placeholder="Your email" aria-label="Your email">
                    <textarea rows="5" placeholder="Message"></textarea>
                    <button type="button" class="vault-btn vault-btn--accent">Send</button>
                </form>
            </article>
            <article class="bento">
                <h3>Community Channels</h3>
                <ul class="detail-list">
                    <li><span>Email</span><strong>vault@comicverse.dev</strong></li>
                    <li><span>Discord</span><strong>Marvel Vault Lounge</strong></li>
                    <li><span>Instagram</span><strong>@marvelvault</strong></li>
                    <li><span>Support Window</span><strong>Mon-Sat, 10:00-19:00 IST</strong></li>
                </ul>
            </article>
        </div>
    </section>
</div>
@endsection
