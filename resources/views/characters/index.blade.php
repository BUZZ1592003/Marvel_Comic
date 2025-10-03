{{-- resources/views/characters/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Marvel Characters - Heroes & Villains')

{{-- Add character-specific CSS --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('css/characters.css') }}">
@endsection

@section('content')
{{-- Characters Hero Section --}}
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, rgba(237, 29, 36, 0.9), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1611604458500-e42377334ac6?ixlib=rb-4.0.3') center/cover;">
    <div class="container">
        <div class="hero-content">
            <h1>MARVEL <span class="text-danger">CHARACTERS</span></h1>
            <p>Meet the legendary heroes and formidable villains that make up the Marvel Universe</p>
        </div>
    </div>
</section>

{{-- Filter Section --}}
<section class="p-3" style="background: var(--marvel-gray);">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search characters by name..." id="character-search">
                </div>
            </div>
            <div class="col-4">
                <select class="form-control" id="character-filter">
                    <option value="">All Characters</option>
                    <option value="hero">Heroes</option>
                    <option value="villain">Villains</option>
                    <option value="antihero">Anti-Heroes</option>
                </select>
            </div>
        </div>
    </div>
</section>

{{-- Characters Grid --}}
<section class="p-5">
    <div class="container">
        <h2 class="section-title mb-5">Iconic Characters</h2>
        
        <div class="comic-grid" id="characters-grid">
            {{-- Spider-Man --}}
            <div class="comic-card character-card" data-type="hero">
                <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Spider-Man">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge hero-badge">Hero</span>
                        <span class="character-badge power-badge">Web-Slinger</span>
                    </div>
                    <h5 class="comic-title character-name">Spider-Man</h5>
                    <h6 class="comic-series character-alias">Peter Parker</h6>
                    <p class="comic-description">
                        With great power comes great responsibility. The friendly neighborhood Spider-Man protects New York City with his web-slinging abilities and spider-sense.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Strength</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Agility</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Intelligence</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 85%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1962</small>
                        <a href="{{ route('characters.show', 'spider-man') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Iron Man --}}
            <div class="comic-card character-card" data-type="hero">
                <img src="https://images.unsplash.com/photo-1626278664285-f796b9ee7806?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Iron Man">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge hero-badge">Hero</span>
                        <span class="character-badge power-badge">Tech Genius</span>
                    </div>
                    <h5 class="comic-title character-name">Iron Man</h5>
                    <h6 class="comic-series character-alias">Tony Stark</h6>
                    <p class="comic-description">
                        Genius, billionaire, playboy, philanthropist. Tony Stark uses his intellect and resources to protect the world in his high-tech armor suit.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Strength</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 85%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Technology</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Intelligence</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1963</small>
                        <a href="{{ route('characters.show', 'iron-man') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Doctor Doom --}}
            <div class="comic-card character-card" data-type="villain">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Doctor Doom">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge villain-badge">Villain</span>
                        <span class="character-badge power-badge">Sorcery</span>
                    </div>
                    <h5 class="comic-title character-name">Doctor Doom</h5>
                    <h6 class="comic-series character-alias">Victor Von Doom</h6>
                    <p class="comic-description">
                        The armored monarch of Latveria combines scientific genius with mystical powers, making him one of Marvel's most formidable villains.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Strength</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 80%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Magic</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Intelligence</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1962</small>
                        <a href="{{ route('characters.show', 'doctor-doom') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Black Widow --}}
            <div class="comic-card character-card" data-type="hero">
                <img src="https://images.unsplash.com/photo-1594736797933-d0d9a7e00067?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Black Widow">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge hero-badge">Hero</span>
                        <span class="character-badge power-badge">Spy</span>
                    </div>
                    <h5 class="comic-title character-name">Black Widow</h5>
                    <h6 class="comic-series character-alias">Natasha Romanoff</h6>
                    <p class="comic-description">
                        A former Russian spy turned Avenger, Natasha Romanoff is a master assassin and espionage expert with unparalleled combat skills.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Combat</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Stealth</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Intelligence</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1964</small>
                        <a href="{{ route('characters.show', 'black-widow') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Wolverine --}}
            <div class="comic-card character-card" data-type="antihero">
                <img src="https://images.unsplash.com/photo-1612198188060-c7c2a3b66eae?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Wolverine">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge antihero-badge">Anti-Hero</span>
                        <span class="character-badge power-badge">Mutant</span>
                    </div>
                    <h5 class="comic-title character-name">Wolverine</h5>
                    <h6 class="comic-series character-alias">Logan / James Howlett</h6>
                    <p class="comic-description">
                        The best there is at what he does. With adamantium claws and a healing factor, Wolverine is the most dangerous member of the X-Men.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Combat</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Healing</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Durability</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1974</small>
                        <a href="{{ route('characters.show', 'wolverine') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Thanos --}}
            <div class="comic-card character-card" data-type="villain">
                <img src="https://images.unsplash.com/photo-1601645191163-3fc0d5d64e35?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Thanos">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge villain-badge">Villain</span>
                        <span class="character-badge power-badge">Cosmic</span>
                    </div>
                    <h5 class="comic-title character-name">Thanos</h5>
                    <h6 class="comic-series character-alias">The Mad Titan</h6>
                    <p class="comic-description">
                        The Mad Titan seeks to balance the universe through destruction. Armed with the Infinity Gauntlet, he's one of the most powerful beings in existence.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Strength</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Cosmic Power</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Intelligence</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1973</small>
                        <a href="{{ route('characters.show', 'thanos') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  

<section class="more-characters-section text-center p-4">
    <div class="container">
        <div class="more-characters-content">
            <h3 class="text-danger mb-3">Discover More Heroes & Villains</h3>
            <p class="text-muted mb-4">
                Explore hundreds of additional Marvel characters from across the multiverse!
            </p>
            <a href="{{ route('characters.more') }}" class="btn btn-marvel btn-lg more-btn">
                <i class="fas fa-plus-circle"></i> More Characters
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/characters.js') }}"></script>
@endsection
