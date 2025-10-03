{{-- resources/views/characters/show.blade.php --}}
@extends('layouts.app')
@section('title', 'Spider-Man - Character Profile')

{{-- Add character-specific CSS --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('css/characters.css') }}">
@endsection

@section('content')
{{-- Character Hero Section --}}
<section class="character-hero" style="background: linear-gradient(135deg, rgba(237, 29, 36, 0.95), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3') center/cover; min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="character-portrait">
                    <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         class="character-main-image" alt="Spider-Man">
                </div>
            </div>
            <div class="col-8">
                <div class="character-details">
                    <div class="character-badges mb-3">
                        <span class="character-badge hero-badge">Hero</span>
                        <span class="character-badge power-badge">Web-Slinger</span>
                        <span class="character-badge team-badge">Avengers</span>
                    </div>
                    
                    <h1 class="character-main-title">SPIDER-MAN</h1>
                    <h2 class="character-subtitle text-gold">Peter Benjamin Parker</h2>
                    
                    <p class="character-bio">
                        When high school student Peter Parker was bitten by a radioactive spider, he gained the proportionate 
                        strength, speed, and agility of a spider along with a precognitive spider-sense that warns him of danger. 
                        After learning that with great power comes great responsibility, he became the Amazing Spider-Man!
                    </p>

                    <div class="character-quick-stats">
                        <div class="row">
                            <div class="col-3">
                                <div class="quick-stat">
                                    <h4 class="text-danger">1962</h4>
                                    <p>First Appearance</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="quick-stat">
                                    <h4 class="text-danger">5'10"</h4>
                                    <p>Height</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="quick-stat">
                                    <h4 class="text-danger">167 lbs</h4>
                                    <p>Weight</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="quick-stat">
                                    <h4 class="text-danger">Earth-616</h4>
                                    <p>Universe</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Powers & Abilities --}}
<section class="character-powers p-5">
    <div class="container">
        <h2 class="section-title">Powers & Abilities</h2>
        <div class="row">
            <div class="col-6">
                <div class="powers-grid">
                    <div class="power-item">
                        <div class="power-icon">
                            <i class="fas fa-fist-raised text-danger"></i>
                        </div>
                        <div class="power-details">
                            <h4>Superhuman Strength</h4>
                            <p>Spider-Man possesses superhuman strength, enabling him to lift approximately 10 tons.</p>
                        </div>
                    </div>
                    
                    <div class="power-item">
                        <div class="power-icon">
                            <i class="fas fa-running text-danger"></i>
                        </div>
                        <div class="power-details">
                            <h4>Superhuman Speed & Agility</h4>
                            <p>Enhanced reflexes and agility allow him to dodge attacks and move with incredible grace.</p>
                        </div>
                    </div>

                    <div class="power-item">
                        <div class="power-icon">
                            <i class="fas fa-hand-paper text-danger"></i>
                        </div>
                        <div class="power-details">
                            <h4>Wall-Crawling</h4>
                            <p>Ability to adhere to any surface, allowing him to climb walls and ceilings.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="powers-grid">
                    <div class="power-item">
                        <div class="power-icon">
                            <i class="fas fa-eye text-danger"></i>
                        </div>
                        <div class="power-details">
                            <h4>Spider-Sense</h4>
                            <p>Precognitive ability that warns him of incoming danger with a tingling sensation.</p>
                        </div>
                    </div>
                    
                    <div class="power-item">
                        <div class="power-icon">
                            <i class="fas fa-spider text-danger"></i>
                        </div>
                        <div class="power-details">
                            <h4>Web-Shooting</h4>
                            <p>Mechanical web-shooters allow him to swing through the city and create web constructs.</p>
                        </div>
                    </div>

                    <div class="power-item">
                        <div class="power-icon">
                            <i class="fas fa-brain text-danger"></i>
                        </div>
                        <div class="power-details">
                            <h4>Genius Intellect</h4>
                            <p>Brilliant scientist and inventor, particularly in chemistry and physics.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Character Stats --}}
<section class="character-stats-detailed p-5" style="background: var(--marvel-gray);">
    <div class="container">
        <h2 class="section-title">Character Statistics</h2>
        <div class="stats-detailed-grid">
            <div class="stat-detailed">
                <div class="stat-name">Intelligence</div>
                <div class="stat-bar-detailed">
                    <div class="stat-fill-detailed" style="width: 90%;" data-value="90"></div>
                </div>
                <div class="stat-value">90/100</div>
            </div>

            <div class="stat-detailed">
                <div class="stat-name">Strength</div>
                <div class="stat-bar-detailed">
                    <div class="stat-fill-detailed" style="width: 75%;" data-value="75"></div>
                </div>
                <div class="stat-value">75/100</div>
            </div>

            <div class="stat-detailed">
                <div class="stat-name">Speed</div>
                <div class="stat-bar-detailed">
                    <div class="stat-fill-detailed" style="width: 85%;" data-value="85"></div>
                </div>
                <div class="stat-value">85/100</div>
            </div>

            <div class="stat-detailed">
                <div class="stat-name">Durability</div>
                <div class="stat-bar-detailed">
                    <div class="stat-fill-detailed" style="width: 70%;" data-value="70"></div>
                </div>
                <div class="stat-value">70/100</div>
            </div>

            <div class="stat-detailed">
                <div class="stat-name">Energy Projection</div>
                <div class="stat-bar-detailed">
                    <div class="stat-fill-detailed" style="width: 30%;" data-value="30"></div>
                </div>
                <div class="stat-value">30/100</div>
            </div>

            <div class="stat-detailed">
                <div class="stat-name">Fighting Skills</div>
                <div class="stat-bar-detailed">
                    <div class="stat-fill-detailed" style="width: 85%;" data-value="85"></div>
                </div>
                <div class="stat-value">85/100</div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Comics --}}
<section class="character-comics p-5">
    <div class="container">
        <h2 class="section-title">Featured Comics</h2>
        <div class="comic-grid">
            @for($i = 1; $i <= 4; $i++)
            <div class="comic-card">
                <img src="https://images.unsplash.com/photo-1601645191163-3fc0d5d64e35?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover" alt="Spider-Man Comic">
                <div class="comic-info">
                    <h5 class="comic-title">Amazing Spider-Man #{{ $i }}</h5>
                    <p class="comic-description">
                        An incredible adventure featuring Spider-Man in action-packed storytelling.
                    </p>
                    <div class="comic-meta">
                        <small class="text-muted">2024</small>
                        <a href="{{ route('comics.show', 'spider-man-' . $i) }}" class="btn btn-marvel">
                            Read Comic
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
<script src="{{ asset('js/characters.js') }}"></script>
@endsection