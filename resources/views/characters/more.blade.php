{{-- resources/views/characters/more.blade.php --}}
@extends('layouts.app')
@section('title', 'More Marvel Characters - Extended Universe')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/characters.css') }}">
@endsection

@section('content')
{{-- More Characters Hero Section --}}
<section class="hero-section" style="min-height: 40vh; background: linear-gradient(135deg, rgba(237, 29, 36, 0.9), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1611604458500-e42377334ac6?ixlib=rb-4.0.3') center/cover;">
    <div class="container">
        <div class="hero-content">
            <h1>MORE MARVEL <span class="text-danger">CHARACTERS</span></h1>
            <p>Dive deeper into the Marvel Universe with these incredible heroes and villains</p>
            
            {{-- Back Button --}}
            <div class="mt-3">
                <a href="{{ route('characters.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Back to Main Characters
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Filter Section --}}
<section class="p-3 character-filter-section">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search more characters..." id="more-character-search">
                </div>
            </div>
            <div class="col-3">
                <select class="form-control" id="more-character-filter">
                    <option value="">All Types</option>
                    <option value="hero">Heroes</option>
                    <option value="villain">Villains</option>
                    <option value="antihero">Anti-Heroes</option>
                    <option value="cosmic">Cosmic Beings</option>
                </select>
            </div>
            <div class="col-3">
                <select class="form-control" id="universe-filter">
                    <option value="">All Universes</option>
                    <option value="earth-616">Earth-616</option>
                    <option value="earth-1610">Ultimate Universe</option>
                    <option value="earth-199999">MCU</option>
                </select>
            </div>
        </div>
    </div>
</section>

{{-- Extended Characters Grid --}}
<section class="p-5">
    <div class="container">
        <h2 class="section-title mb-5">Extended Marvel Universe</h2>
        
        <div class="comic-grid" id="more-characters-grid">
            {{-- Deadpool --}}
            <div class="comic-card character-card" data-type="antihero" data-universe="earth-616">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Deadpool">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge antihero-badge">Anti-Hero</span>
                        <span class="character-badge power-badge">Regeneration</span>
                    </div>
                    <h5 class="comic-title character-name">Deadpool</h5>
                    <h6 class="comic-series character-alias">Wade Wilson</h6>
                    <p class="comic-description">
                        The Merc with a Mouth breaks the fourth wall while wielding katanas and wise-cracks in equal measure.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Combat</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Healing</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Sanity</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 15%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1991</small>
                        <a href="{{ route('characters.show', 'deadpool') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Silver Surfer --}}
            <div class="comic-card character-card" data-type="hero" data-universe="earth-616">
                <img src="https://images.unsplash.com/photo-1446776653964-20c1d3a81b06?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Silver Surfer">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge hero-badge">Hero</span>
                        <span class="character-badge power-badge">Cosmic</span>
                    </div>
                    <h5 class="comic-title character-name">Silver Surfer</h5>
                    <h6 class="comic-series character-alias">Norrin Radd</h6>
                    <p class="comic-description">
                        Former herald of Galactus, wielding the Power Cosmic to surf through space and protect the universe.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Power Cosmic</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Flight</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Nobility</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1966</small>
                        <a href="{{ route('characters.show', 'silver-surfer') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Venom --}}
            <div class="comic-card character-card" data-type="antihero" data-universe="earth-616">
                <img src="https://images.unsplash.com/photo-1594736797933-d0d9a7e00067?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Venom">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge antihero-badge">Anti-Hero</span>
                        <span class="character-badge power-badge">Symbiote</span>
                    </div>
                    <h5 class="comic-title character-name">Venom</h5>
                    <h6 class="comic-series character-alias">Eddie Brock + Symbiote</h6>
                    <p class="comic-description">
                        The lethal protector formed by the bond between journalist Eddie Brock and an alien symbiote.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Strength</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 85%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Symbiosis</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Web-Slinging</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1988</small>
                        <a href="{{ route('characters.show', 'venom') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Ghost Rider --}}
            <div class="comic-card character-card" data-type="antihero" data-universe="earth-616">
                <img src="https://images.unsplash.com/photo-1566492031773-4f4e44671d66?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Ghost Rider">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge antihero-badge">Anti-Hero</span>
                        <span class="character-badge power-badge">Supernatural</span>
                    </div>
                    <h5 class="comic-title character-name">Ghost Rider</h5>
                    <h6 class="comic-series character-alias">Johnny Blaze</h6>
                    <p class="comic-description">
                        Spirit of Vengeance with a flaming skull who rides a hellish motorcycle to punish the wicked.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Hellfire</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Penance Stare</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Vengeance</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1972</small>
                        <a href="{{ route('characters.show', 'ghost-rider') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Captain Marvel --}}
            <div class="comic-card character-card" data-type="hero" data-universe="earth-616">
                <img src="https://images.unsplash.com/photo-1594736797933-d0d9a7e00067?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Captain Marvel">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge hero-badge">Hero</span>
                        <span class="character-badge power-badge">Cosmic</span>
                    </div>
                    <h5 class="comic-title character-name">Captain Marvel</h5>
                    <h6 class="comic-series character-alias">Carol Danvers</h6>
                    <p class="comic-description">
                        Former Air Force pilot with cosmic powers who can fly faster than light and project energy blasts.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Flight</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Energy</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Leadership</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1968</small>
                        <a href="{{ route('characters.show', 'captain-marvel') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>

            {{-- Green Goblin --}}
            <div class="comic-card character-card" data-type="villain" data-universe="earth-616">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="comic-cover character-image" alt="Green Goblin">
                <div class="comic-info">
                    <div class="mb-2">
                        <span class="character-badge villain-badge">Villain</span>
                        <span class="character-badge power-badge">Tech</span>
                    </div>
                    <h5 class="comic-title character-name">Green Goblin</h5>
                    <h6 class="comic-series character-alias">Norman Osborn</h6>
                    <p class="comic-description">
                        Spider-Man's greatest enemy, using advanced technology and a split personality to terrorize New York.
                    </p>
                    <div class="character-stats mb-3">
                        <div class="stat-bar">
                            <span class="stat-label">Intelligence</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Technology</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 85%;"></div>
                            </div>
                        </div>
                        <div class="stat-bar">
                            <span class="stat-label">Insanity</span>
                            <div class="stat-progress">
                                <div class="stat-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="comic-meta">
                        <small class="text-muted">First Appearance: 1964</small>
                        <a href="{{ route('characters.show', 'green-goblin') }}" class="btn btn-marvel">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Load More Button --}}
        <div class="text-center mt-5">
            <button class="btn btn-outline load-more-btn" id="load-more-characters">
                <i class="fas fa-spinner"></i> Load More Characters
            </button>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/characters.js') }}"></script>
<script>
// Additional functionality for more characters page
document.addEventListener('DOMContentLoaded', function() {
    const moreSearchInput = document.getElementById('more-character-search');
    const moreFilterSelect = document.getElementById('more-character-filter');
    const universeFilter = document.getElementById('universe-filter');
    const characterCards = document.querySelectorAll('.character-card');
    const loadMoreBtn = document.getElementById('load-more-characters');

    // Enhanced filtering for more page
    function filterMoreCharacters() {
        const searchTerm = moreSearchInput.value.toLowerCase();
        const filterType = moreFilterSelect.value;
        const universeType = universeFilter.value;

        characterCards.forEach(card => {
            const name = card.querySelector('.character-name')?.textContent.toLowerCase() || '';
            const alias = card.querySelector('.character-alias')?.textContent.toLowerCase() || '';
            const type = card.dataset.type;
            const universe = card.dataset.universe;

            const matchesSearch = name.includes(searchTerm) || alias.includes(searchTerm);
            const matchesFilter = !filterType || type === filterType;
            const matchesUniverse = !universeType || universe === universeType;

            if (matchesSearch && matchesFilter && matchesUniverse) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    moreSearchInput.addEventListener('input', filterMoreCharacters);
    moreFilterSelect.addEventListener('change', filterMoreCharacters);
    universeFilter.addEventListener('change', filterMoreCharacters);

    // Load more functionality (simulate)
    loadMoreBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-check"></i> All Characters Loaded';
            this.disabled = true;
            this.classList.add('btn-success');
        }, 2000);
    });
});
</script>
@endsection
