{{-- resources/views/comics/show.blade.php --}}
@extends('layouts.app')
@section('title', 'Amazing Spider-Man #1 - Read Comic')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/comics.css') }}">
@endsection

@section('content')
{{-- Comic Reader Header --}}
<section class="comic-reader-header">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="text-center">
                    <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         class="comic-cover-large" alt="Amazing Spider-Man #1">
                </div>
            </div>
            <div class="col-8">
                <div class="comic-details-panel">
                    <div class="mb-3">
                        <span class="character-badge hero-badge">Marvel Comics</span>
                        <span class="character-badge power-badge">Action</span>
                        <span class="character-badge team-badge">Superhero</span>
                    </div>
                    
                    <h1 class="comic-title-large">AMAZING SPIDER-MAN</h1>
                    <h2 class="comic-subtitle">Issue #{{ $comic ?? '1' }} - Web of Destiny</h2>
                    
                    <p class="comic-bio mb-4">
                        Peter Parker faces his greatest challenge yet as a mysterious new villain emerges from the shadows. 
                        With great power comes great responsibility, but sometimes even Spider-Man's best isn't enough. 
                        Join the web-slinger in this action-packed adventure that will change everything!
                    </p>

                    <div class="comic-meta-grid">
                        <div class="meta-item">
                            <span class="meta-value">Dan Slott</span>
                            <span class="meta-label">Writer</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">John Romita Jr.</span>
                            <span class="meta-label">Artist</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">22 Pages</span>
                            <span class="meta-label">Length</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">March 2024</span>
                            <span class="meta-label">Published</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">4.8/5</span>
                            <span class="meta-label">Rating</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">$3.99</span>
                            <span class="meta-label">Price</span>
                        </div>
                    </div>

                    <div class="comic-actions mt-4">
                        <button class="btn btn-marvel me-3" id="start-reading">
                            <i class="fas fa-play"></i> Start Reading
                        </button>
                        <button class="btn btn-outline me-2" id="add-favorite">
                            <i class="far fa-heart"></i> Add to Favorites
                        </button>
                        <button class="btn btn-outline me-2" id="download-comic">
                            <i class="fas fa-download"></i> Download
                        </button>
                        <a href="{{ route('comics.index') }}" class="btn btn-outline">
                            <i class="fas fa-arrow-left"></i> Back to Comics
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Reading Mode Toggle --}}
<section class="p-3" style="background: var(--marvel-dark); border-bottom: 2px solid var(--marvel-red);">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="view-toggle">
                    <button class="toggle-btn active" data-mode="single" id="single-page">
                        <i class="fas fa-file"></i> Single Page
                    </button>
                    <button class="toggle-btn" data-mode="double" id="double-page">
                        <i class="fas fa-columns"></i> Double Page
                    </button>
                    <button class="toggle-btn" data-mode="continuous" id="continuous-scroll">
                        <i class="fas fa-scroll"></i> Continuous
                    </button>
                </div>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-outline" id="fullscreen-btn">
                    <i class="fas fa-expand"></i> Fullscreen
                </button>
                <button class="btn btn-outline" id="zoom-in">
                    <i class="fas fa-search-plus"></i>
                </button>
                <button class="btn btn-outline" id="zoom-out">
                    <i class="fas fa-search-minus"></i>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- Comic Reader Section --}}
<section class="comic-reader-section" id="comic-reader">
    <div class="container">
        {{-- Single Page Mode (Default) --}}
        <div id="single-page-reader" class="reader-mode active">
            @for($page = 1; $page <= 22; $page++)
            <div class="comic-page-container" data-page="{{ $page }}" style="{{ $page > 1 ? 'display: none;' : '' }}">
                <img src="https://images.unsplash.com/photo-{{ ['1578662996442-48f60103fc96', '1601645191163-3fc0d5d64e35', '1626278664285-f796b9ee7806', '1611604458500-e42377334ac6'][array_rand(['1578662996442-48f60103fc96', '1601645191163-3fc0d5d64e35', '1626278664285-f796b9ee7806', '1611604458500-e42377334ac6'])] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     class="comic-page-image" alt="Page {{ $page }}" data-page="{{ $page }}">
                <div class="page-number">Page {{ $page }} of 22</div>
            </div>
            @endfor
        </div>

        {{-- Double Page Mode --}}
        <div id="double-page-reader" class="reader-mode" style="display: none;">
            @for($page = 1; $page <= 22; $page += 2)
            <div class="comic-page-container double-page" data-page="{{ $page }}" style="{{ $page > 1 ? 'display: none;' : '' }}">
                <div class="double-page-spread">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="comic-page-image" alt="Page {{ $page }}">
                    @if($page + 1 <= 22)
                    <img src="https://images.unsplash.com/photo-1601645191163-3fc0d5d64e35?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="comic-page-image" alt="Page {{ $page + 1 }}">
                    @endif
                </div>
                <div class="page-number">Pages {{ $page }}{{ $page + 1 <= 22 ? '-' . ($page + 1) : '' }} of 22</div>
            </div>
            @endfor
        </div>

        {{-- Continuous Scroll Mode --}}
        <div id="continuous-reader" class="reader-mode" style="display: none;">
            @for($page = 1; $page <= 22; $page++)
            <div class="comic-page-container continuous">
                <img src="https://images.unsplash.com/photo-{{ ['1578662996442-48f60103fc96', '1601645191163-3fc0d5d64e35', '1626278664285-f796b9ee7806', '1611604458500-e42377334ac6'][array_rand(['1578662996442-48f60103fc96', '1601645191163-3fc0d5d64e35', '1626278664285-f796b9ee7806', '1611604458500-e42377334ac6'])] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     class="comic-page-image" alt="Page {{ $page }}">
                <div class="page-number">Page {{ $page }}</div>
            </div>
            @endfor
        </div>
    </div>
</section>

{{-- Reader Navigation Controls --}}
<div class="reader-controls" id="reader-controls">
    <button class="control-btn" id="first-page" title="First Page">
        <i class="fas fa-step-backward"></i>
    </button>
    <button class="control-btn" id="prev-page" title="Previous Page">
        <i class="fas fa-chevron-left"></i>
    </button>
    <span class="control-info" id="page-info">1 / 22</span>
    <button class="control-btn" id="next-page" title="Next Page">
        <i class="fas fa-chevron-right"></i>
    </button>
    <button class="control-btn" id="last-page" title="Last Page">
        <i class="fas fa-step-forward"></i>
    </button>
</div>

{{-- Related Comics Section --}}
<section class="p-5" style="background: var(--marvel-gray);">
    <div class="container">
        <h2 class="section-title">More from This Series</h2>
        <div class="comic-grid">
            @for($i = 2; $i <= 5; $i++)
            <div class="comic-card">
                <img src="https://images.unsplash.com/photo-1601645191163-3fc0d5d64e35?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover" alt="Spider-Man #{{ $i }}">
                <div class="comic-info">
                    <h5 class="comic-title">Amazing Spider-Man #{{ $i }}</h5>
                    <p class="comic-description">
                        Continue the epic adventure with Spider-Man in this thrilling issue.
                    </p>
                    <div class="comic-meta">
                        <small class="text-muted">2024</small>
                        <a href="{{ route('comics.show', 'spider-man-' . $i) }}" class="btn btn-marvel">
                            Read Next
                        </a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('JS/comics1.js') }}"></script>
@endsection