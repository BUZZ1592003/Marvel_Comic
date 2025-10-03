{{-- resources/views/comics/index.blade.php --}}

@foreach($comics as $comic)
    <div class="comic-card">
        <h3>{{ $comic->title }}</h3>
        <p>{{ $comic->description }}</p>
        <p>Issue #{{ $comic->issue_number }}</p>
        <p>Series: {{ $comic->series->name }}</p>
    </div>
@endforeach

{{ $comics->links() }} {{-- Pagination --}}

{{-- Enhanced Version Below --}}

{{-- resources/views/comics/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Marvel Comics Collection')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/comics.css') }}">
@endsection

@section('content')
{{-- Comics Hero Section --}}
<section class="comic-hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-3 fw-bold">MARVEL <span class="text-danger">COMICS</span></h1>
            <p class="lead mb-4">
                Discover epic adventures, legendary heroes, and timeless stories from the Marvel Universe
            </p>
            <div class="hero-stats">
                <span class="badge hero-badge me-3">500+ Issues</span>
                <span class="badge villain-badge me-3">25+ Series</span>
                <span class="badge power-badge">80+ Years</span>
            </div>
        </div>
    </div>
</section>

{{-- Filter Section --}}
<section class="comic-filter-section">
    <div class="container">
        <div class="filter-row">
            <input type="text" class="comic-search-input" placeholder="Search comics by title, series, or description..." id="comic-search">
            <select class="comic-filter-select" id="series-filter">
                <option value="">All Series</option>
                <option value="spider-man">Spider-Man</option>
                <option value="x-men">X-Men</option>
                <option value="avengers">Avengers</option>
                <option value="iron-man">Iron Man</option>
                <option value="fantastic-four">Fantastic Four</option>
            </select>
            <select class="comic-filter-select" id="year-filter">
                <option value="">All Years</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="classic">Classic (1960s-1990s)</option>
            </select>
            <select class="comic-filter-select" id="sort-select">
                <option value="newest">Newest First</option>
                <option value="title">Title A-Z</option>
                <option value="year">Year</option>
                <option value="rating">Rating</option>
            </select>
        </div>
    </div>
</section>

{{-- Sort and View Options --}}
<section class="p-3" style="background: var(--marvel-dark);">
    <div class="container">
        <div class="sort-section">
            <div class="results-count">Showing 12 comics</div>
            <div class="view-toggle">
                <button class="toggle-btn active" data-view="grid">
                    <i class="fas fa-th"></i> Grid
                </button>
                <button class="toggle-btn" data-view="list">
                    <i class="fas fa-list"></i> List
                </button>
            </div>
        </div>
    </div>
</section>

{{-- Comics Grid --}}
<section class="p-5">
    <div class="container">
        <div class="comics-grid">
            {{-- Spider-Man Comic --}}
            <div class="comic-card-enhanced" data-series="spider-man" data-year="2024" data-rating="4.8">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="comic-cover-enhanced" alt="Amazing Spider-Man">
                    <div class="comic-overlay"></div>
                    <div class="comic-issue-badge">#1</div>
                    <div class="comic-price-badge">$3.99</div>
                </div>
                <div class="comic-info-enhanced">
                    <div class="comic-series-title">Amazing Spider-Man</div>
                    <h5 class="comic-main-title">Web of Destiny</h5>
                    <p class="comic-description-enhanced">
                        Peter Parker faces his greatest challenge yet as a new villain emerges from the shadows, threatening everything he holds dear.
                    </p>
                    <div class="comic-creators">
                        <div class="creator-info">
                            <i class="fas fa-pen"></i> <span class="creator-name">Dan Slott</span>
                        </div>
                        <div class="creator-info">
                            <i class="fas fa-palette"></i> <span class="creator-name">John Romita Jr.</span>
                        </div>
                    </div>
                    <div class="comic-rating">
                        <div class="stars">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                        </div>
                        <span class="rating-text">4.8/5</span>
                    </div>
                    <div class="comic-actions">
                        <a href="{{ route('comics.show', 'spider-man-1') }}" class="btn-read">
                            <i class="fas fa-book-open"></i> Read Now
                        </a>
                        <button class="btn-favorite">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- X-Men Comic --}}
            <div class="comic-card-enhanced" data-series="x-men" data-year="2024" data-rating="4.6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1611604458500-e42377334ac6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="comic-cover-enhanced" alt="Uncanny X-Men">
                    <div class="comic-overlay"></div>
                    <div class="comic-issue-badge">#15</div>
                    <div class="comic-price-badge">$4.99</div>
                </div>
                <div class="comic-info-enhanced">
                    <div class="comic-series-title">Uncanny X-Men</div>
                    <h5 class="comic-main-title">Days of Future Present</h5>
                    <p class="comic-description-enhanced">
                        The X-Men must unite to face a threat that spans across time itself, as past and future collide in epic fashion.
                    </p>
                    <div class="comic-creators">
                        <div class="creator-info">
                            <i class="fas fa-pen"></i> <span class="creator-name">Jonathan Hickman</span>
                        </div>
                        <div class="creator-info">
                            <i class="fas fa-palette"></i> <span class="creator-name">Pepe Larraz</span>
                        </div>
                    </div>
                    <div class="comic-rating">
                        <div class="stars">
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="fas fa-star star"></i>
                            <i class="far fa-star star"></i>
                        </div>
                        <span class="rating-text">4.6/5</span>
                    </div>
                    <div class="comic-actions">
                        <a href="{{ route('comics.show', 'x-men-15') }}" class="btn-read">
                            <i class="fas fa-book-open"></i> Read Now
                        </a>
                        <button class="btn-favorite">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Add more comic cards following the same pattern --}}
            @for($i = 3; $i <= 12; $i++)
            <div class="comic-card-enhanced" data-series="{{ ['avengers', 'iron-man', 'fantastic-four'][array_rand(['avengers', 'iron-man', 'fantastic-four'])] }}" data-year="2024" data-rating="{{ number_format(rand(35, 50)/10, 1) }}">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-{{ ['1601645191163-3fc0d5d64e35', '1578662996442-48f60103fc96', '1626278664285-f796b9ee7806'][array_rand(['1601645191163-3fc0d5d64e35', '1578662996442-48f60103fc96', '1626278664285-f796b9ee7806'])] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="comic-cover-enhanced" alt="Marvel Comic">
                    <div class="comic-overlay"></div>
                    <div class="comic-issue-badge">#{{ $i }}</div>
                    <div class="comic-price-badge">${{ number_format(rand(299, 599)/100, 2) }}</div>
                </div>
                <div class="comic-info-enhanced">
                    <div class="comic-series-title">{{ ['Avengers', 'Iron Man', 'Fantastic Four'][array_rand(['Avengers', 'Iron Man', 'Fantastic Four'])] }}</div>
                    <h5 class="comic-main-title">{{ ['Epic Battle', 'Secret Origins', 'Ultimate Power', 'Final Stand'][array_rand(['Epic Battle', 'Secret Origins', 'Ultimate Power', 'Final Stand'])] }}</h5>
                    <p class="comic-description-enhanced">
                        An incredible adventure featuring Marvel's greatest heroes in action-packed storytelling that will keep you on the edge of your seat.
                    </p>
                    <div class="comic-creators">
                        <div class="creator-info">
                            <i class="fas fa-pen"></i> <span class="creator-name">{{ ['Stan Lee', 'Brian Bendis', 'Chris Claremont'][array_rand(['Stan Lee', 'Brian Bendis', 'Chris Claremont'])] }}</span>
                        </div>
                        <div class="creator-info">
                            <i class="fas fa-palette"></i> <span class="creator-name">{{ ['Jack Kirby', 'John Romita', 'Jim Lee'][array_rand(['Jack Kirby', 'John Romita', 'Jim Lee'])] }}</span>
                        </div>
                    </div>
                    <div class="comic-rating">
                        <div class="stars">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="fas fa-star star"></i>
                            @endfor
                        </div>
                        <span class="rating-text">{{ number_format(rand(35, 50)/10, 1) }}/5</span>
                    </div>
                    <div class="comic-actions">
                        <a href="{{ route('comics.show', 'comic-' . $i) }}" class="btn-read">
                            <i class="fas fa-book-open"></i> Read Now
                        </a>
                        <button class="btn-favorite">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        {{-- Pagination --}}
        <div class="comic-pagination">
            <a href="#" class="pagination-btn" disabled>
                <i class="fas fa-chevron-left"></i> Previous
            </a>
            <a href="#" class="pagination-btn active">1</a>
            <a href="#" class="pagination-btn">2</a>
            <a href="#" class="pagination-btn">3</a>
            <a href="#" class="pagination-btn">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('JS/comics.js') }}"></script>
@endsection
