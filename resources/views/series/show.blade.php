{{-- resources/views/series/show.blade.php --}}
@extends('layouts.app')
@section('title', 'The Amazing Spider-Man - Comic Series')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/series.css') }}">
@endsection

@section('content')
{{-- Series Detail Hero --}}
<section class="series-detail-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                     class="series-logo" alt="Amazing Spider-Man Logo">
            </div>
            <div class="col-md-8">
                <div class="series-detail-info">
                    <h1 class="series-main-title">THE AMAZING SPIDER-MAN</h1>
                    <p class="series-tagline">"With Great Power Comes Great Responsibility"</p>
                    
                    <p class="series-bio mb-4">
                        Since 1963, The Amazing Spider-Man has been Marvel's flagship title, chronicling the adventures of 
                        Peter Parker as he learns to balance his life as a teenager, student, photographer, and superhero. 
                        From his origin in Amazing Fantasy #15 to his current adventures, Spider-Man remains Marvel's most 
                        beloved character, facing everything from street-level crime to cosmic threats.
                    </p>

                    <div class="series-stats-grid">
                        <div class="stat-box">
                            <span class="stat-number">700+</span>
                            <span class="stat-label">Issues</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number">1963</span>
                            <span class="stat-label">Started</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number">4.8</span>
                            <span class="stat-label">Rating</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number">61</span>
                            <span class="stat-label">Years</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number">Ongoing</span>
                            <span class="stat-label">Status</span>
                        </div>
                    </div>

                    <div class="series-actions mt-4">
                        <a href="{{ route('comics.show', 'spider-man-latest') }}" class="btn btn-marvel me-3">
                            <i class="fas fa-play"></i> Read Latest Issue
                        </a>
                        <button class="btn btn-outline me-2" id="follow-series">
                            <i class="fas fa-plus"></i> Follow Series
                        </button>
                        <a href="{{ route('series.index') }}" class="btn btn-outline">
                            <i class="fas fa-arrow-left"></i> All Series
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Timeline Section --}}
<section class="p-5" style="background: var(--marvel-gray);">
    <div class="container">
        <h2 class="section-title">Series Timeline</h2>
        <div class="timeline-view">
            <div class="timeline-line"></div>
            
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4 class="text-danger">Amazing Fantasy #15 (1962)</h4>
                    <p>Spider-Man makes his first appearance in this anthology series, created by Stan Lee and Steve Ditko.</p>
                </div>
                <div class="timeline-marker"></div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4 class="text-danger">Amazing Spider-Man #1 (1963)</h4>
                    <p>The series officially begins with Spider-Man's first solo comic book series.</p>
                </div>
                <div class="timeline-marker"></div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4 class="text-danger">Death of Gwen Stacy (1973)</h4>
                    <p>Amazing Spider-Man #121 features one of comics' most shocking moments.</p>
                </div>
                <div class="timeline-marker"></div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4 class="text-danger">Black Suit Saga (1984)</h4>
                    <p>Introduction of the alien symbiote costume in Amazing Spider-Man #252.</p>
                </div>
                <div class="timeline-marker"></div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4 class="text-danger">Clone Saga (1994-1996)</h4>
                    <p>The controversial storyline that dominated Spider-Man comics in the mid-90s.</p>
                </div>
                <div class="timeline-marker"></div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4 class="text-danger">Brand New Day (2008)</h4>
                    <p>A new era begins with Amazing Spider-Man #546, published three times monthly.</p>
                </div>
                <div class="timeline-marker"></div>
            </div>
        </div>
    </div>
</section>

{{-- Issues Section --}}
<section class="issues-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="section-title text-left">Recent Issues</h2>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Search issues..." id="issue-search">
            </div>
        </div>
        
        <div class="issues-grid">
            @for($issue = 1; $issue <= 12; $issue++)
            <div class="issue-card">
                <img src="https://images.unsplash.com/photo-{{ ['1635805737707-575885ab0820', '1601645191163-3fc0d5d64e35', '1578662996442-48f60103fc96'][array_rand(['1635805737707-575885ab0820', '1601645191163-3fc0d5d64e35', '1578662996442-48f60103fc96'])] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="issue-cover" alt="Amazing Spider-Man #{{ $issue }}">
                <div class="issue-info">
                    <div class="issue-number">Issue #{{ $issue }}</div>
                    <h4 class="issue-title">{{ ['Web of Destiny', 'Spider-Verse', 'Ultimate Power', 'Final Stand', 'New Beginning', 'Dark Times'][array_rand(['Web of Destiny', 'Spider-Verse', 'Ultimate Power', 'Final Stand', 'New Beginning', 'Dark Times'])] }}</h4>
                    <div class="issue-date">{{ ['March 2024', 'February 2024', 'January 2024'][array_rand(['March 2024', 'February 2024', 'January 2024'])] }}</div>
                    <a href="{{ route('comics.show', 'spider-man-' . $issue) }}" class="btn btn-marvel">
                        <i class="fas fa-book-open"></i> Read Now
                    </a>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-outline" id="load-more-issues">
                <i class="fas fa-plus"></i> Load More Issues
            </button>
        </div>
    </div>
</section>

{{-- Related Series --}}
<section class="p-5" style="background: var(--marvel-dark);">
    <div class="container">
        <h2 class="section-title">Related Series</h2>
        <div class="series-grid">
            @foreach(['Spectacular Spider-Man', 'Spider-Man 2099', 'Ultimate Spider-Man', 'Web of Spider-Man'] as $relatedSeries)
            <div class="series-card">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="series-banner" alt="{{ $relatedSeries }}">
                    <div class="series-status-badge status-completed">Completed</div>
                    <div class="series-issue-count">{{ rand(50, 200) }} Issues</div>
                </div>
                <div class="series-info">
                    <h3 class="series-title">{{ $relatedSeries }}</h3>
                    <p class="series-description">
                        Another amazing Spider-Man series featuring unique storylines and adventures.
                    </p>
                    <div class="series-actions">
                        <a href="{{ route('series.show', strtolower(str_replace(' ', '-', $relatedSeries))) }}" class="btn-explore">
                            <i class="fas fa-book-open"></i> Explore
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
