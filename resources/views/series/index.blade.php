{{-- resources/views/series/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Marvel Comic Series')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/series.css') }}">
@endsection

@section('content')
{{-- Series Hero Section --}}
<section class="series-hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-3 fw-bold">MARVEL <span class="text-primary">SERIES</span></h1>
            <p class="lead mb-4">
                Explore legendary comic series that have shaped the Marvel Universe for decades
            </p>
            <div class="hero-stats">
                <span class="badge status-ongoing me-3">25+ Active Series</span>
                <span class="badge status-completed me-3">100+ Completed</span>
                <span class="badge hero-badge">80+ Years of Stories</span>
            </div>
        </div>
    </div>
</section>

{{-- Filter Section --}}
<section class="series-filter-section">
    <div class="container">
        <div class="series-filter-row">
            <input type="text" class="series-search-input" placeholder="Search series by title or description..." id="series-search">
            <select class="series-select" id="status-filter">
                <option value="">All Status</option>
                <option value="ongoing">Ongoing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <select class="series-select" id="genre-filter">
                <option value="">All Genres</option>
                <option value="superhero">Superhero</option>
                <option value="action">Action</option>
                <option value="adventure">Adventure</option>
                <option value="sci-fi">Sci-Fi</option>
            </select>
            <select class="series-select" id="series-sort">
                <option value="popularity">Most Popular</option>
                <option value="title">Title A-Z</option>
                <option value="year">Newest First</option>
                <option value="issues">Most Issues</option>
            </select>
        </div>
    </div>
</section>

{{-- Sort and View Controls --}}
<section class="p-3" style="background: var(--marvel-dark);">
    <div class="container">
        <div class="sort-controls">
            <div class="series-count">12 series found</div>
            <div class="view-options">
                <button class="view-btn active" data-view="grid">
                    <i class="fas fa-th"></i>
                </button>
                <button class="view-btn" data-view="list">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- Series Grid --}}
<section class="p-5">
    <div class="container">
        <div class="series-grid">
            {{-- Amazing Spider-Man Series --}}
            <div class="series-card" data-status="ongoing" data-genre="superhero" data-year="1963" data-issues="700" data-popularity="95">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         class="series-banner" alt="Amazing Spider-Man Series">
                    <div class="series-overlay"></div>
                    <div class="series-status-badge status-ongoing">Ongoing</div>
                    <div class="series-issue-count">700+ Issues</div>
                </div>
                <div class="series-info">
                    <h3 class="series-title">The Amazing Spider-Man</h3>
                    <p class="series-subtitle">Your Friendly Neighborhood Web-Slinger</p>
                    <p class="series-description">
                        Follow Peter Parker as he balances life as a student, photographer, and superhero. From his humble beginnings to becoming one of Marvel's most beloved characters, witness the evolution of Spider-Man through decades of incredible storytelling.
                    </p>
                    
                    <div class="series-meta">
                        <div class="meta-item">
                            <span class="meta-value">1963</span>
                            <span class="meta-label">Started</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">700+</span>
                            <span class="meta-label">Issues</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">4.8/5</span>
                            <span class="meta-label">Rating</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">Monthly</span>
                            <span class="meta-label">Schedule</span>
                        </div>
                    </div>
                    
                    <div class="series-creators">
                        <div>
                            <i class="fas fa-pen"></i> <span class="creator-name">Stan Lee, Dan Slott</span>
                        </div>
                        <div>
                            <i class="fas fa-palette"></i> <span class="creator-name">Steve Ditko, John Romita Jr.</span>
                        </div>
                    </div>
                    
                    <div class="series-actions">
                        <a href="{{ route('series.show', 'amazing-spider-man') }}" class="btn-explore">
                            <i class="fas fa-book-open"></i> Explore Series
                        </a>
                        <button class="btn-follow">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Uncanny X-Men Series --}}
            <div class="series-card" data-status="ongoing" data-genre="superhero" data-year="1963" data-issues="600" data-popularity="92">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1611604458500-e42377334ac6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         class="series-banner" alt="X-Men Series">
                    <div class="series-overlay"></div>
                    <div class="series-status-badge status-ongoing">Ongoing</div>
                    <div class="series-issue-count">600+ Issues</div>
                </div>
                <div class="series-info">
                    <h3 class="series-title">Uncanny X-Men</h3>
                    <p class="series-subtitle">Protecting a World That Hates and Fears Them</p>
                    <p class="series-description">
                        The X-Men fight for peace and equality between normal humans and mutants in a world where antimutant bigotry is fierce and widespread. Led by Professor Xavier, they face threats both human and superhuman.
                    </p>
                    
                    <div class="series-meta">
                        <div class="meta-item">
                            <span class="meta-value">1963</span>
                            <span class="meta-label">Started</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">600+</span>
                            <span class="meta-label">Issues</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">4.7/5</span>
                            <span class="meta-label">Rating</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">Monthly</span>
                            <span class="meta-label">Schedule</span>
                        </div>
                    </div>
                    
                    <div class="series-creators">
                        <div>
                            <i class="fas fa-pen"></i> <span class="creator-name">Stan Lee, Chris Claremont</span>
                        </div>
                        <div>
                            <i class="fas fa-palette"></i> <span class="creator-name">Jack Kirby, John Byrne</span>
                        </div>
                    </div>
                    
                    <div class="series-actions">
                        <a href="{{ route('series.show', 'uncanny-x-men') }}" class="btn-explore">
                            <i class="fas fa-book-open"></i> Explore Series
                        </a>
                        <button class="btn-follow">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Add more series cards --}}
            @foreach(['Avengers', 'Iron Man', 'Thor', 'Captain America', 'Hulk', 'Fantastic Four', 'Daredevil', 'Doctor Strange', 'Black Panther', 'Captain Marvel'] as $index => $seriesName)
            <div class="series-card" data-status="{{ ['ongoing', 'completed', 'ongoing'][array_rand(['ongoing', 'completed', 'ongoing'])] }}" data-genre="superhero" data-year="{{ rand(1960, 2020) }}" data-issues="{{ rand(50, 500) }}" data-popularity="{{ rand(70, 95) }}">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-{{ ['1601645191163-3fc0d5d64e35', '1578662996442-48f60103fc96', '1626278664285-f796b9ee7806'][array_rand(['1601645191163-3fc0d5d64e35', '1578662996442-48f60103fc96', '1626278664285-f796b9ee7806'])] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         class="series-banner" alt="{{ $seriesName }} Series">
                    <div class="series-overlay"></div>
                    <div class="series-status-badge {{ ['status-ongoing', 'status-completed'][array_rand(['status-ongoing', 'status-completed'])] }}">
                        {{ ['Ongoing', 'Completed'][array_rand(['Ongoing', 'Completed'])] }}
                    </div>
                    <div class="series-issue-count">{{ rand(50, 500) }}+ Issues</div>
                </div>
                <div class="series-info">
                    <h3 class="series-title">{{ $seriesName }}</h3>
                    <p class="series-subtitle">{{ ['Epic Adventures', 'Legendary Tales', 'Heroic Stories', 'Marvel Universe'][array_rand(['Epic Adventures', 'Legendary Tales', 'Heroic Stories', 'Marvel Universe'])] }}</p>
                    <p class="series-description">
                        Experience the incredible journey of {{ $seriesName }} through decades of amazing storytelling, epic battles, and character development that has captivated readers worldwide.
                    </p>
                    
                    <div class="series-meta">
                        <div class="meta-item">
                            <span class="meta-value">{{ rand(1960, 2000) }}</span>
                            <span class="meta-label">Started</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">{{ rand(50, 500) }}+</span>
                            <span class="meta-label">Issues</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">{{ number_format(rand(35, 50)/10, 1) }}/5</span>
                            <span class="meta-label">Rating</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-value">Monthly</span>
                            <span class="meta-label">Schedule</span>
                        </div>
                    </div>
                    
                    <div class="series-creators">
                        <div>
                            <i class="fas fa-pen"></i> <span class="creator-name">{{ ['Stan Lee', 'Jack Kirby', 'Steve Ditko'][array_rand(['Stan Lee', 'Jack Kirby', 'Steve Ditko'])] }}</span>
                        </div>
                        <div>
                            <i class="fas fa-palette"></i> <span class="creator-name">{{ ['John Romita', 'Neal Adams', 'Jim Lee'][array_rand(['John Romita', 'Neal Adams', 'Jim Lee'])] }}</span>
                        </div>
                    </div>
                    
                    <div class="series-actions">
                        <a href="{{ route('series.show', strtolower(str_replace(' ', '-', $seriesName))) }}" class="btn-explore">
                            <i class="fas fa-book-open"></i> Explore Series
                        </a>
                        <button class="btn-follow">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
