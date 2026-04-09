<header class="header-fixed">
    <nav class="navbar">
        <div class="container nav-shell">
            <div class="nav-brand">
                <a href="{{ route('home') }}" class="logo" aria-label="Marvel Vault home">
                    <span class="logo-mark">MV</span>
                    <span class="logo-text">
                        <strong>Marvel Vault</strong>
                        <small>Curated Comic Verse</small>
                    </span>
                </a>
            </div>

            <button class="nav-toggle" id="nav-toggle" aria-controls="nav-menu" aria-expanded="false" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>

            <div class="nav-menu-wrap" id="nav-menu">
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('comics.index') }}" class="nav-link">Comics</a></li>
                    <li><a href="{{ route('characters.index') }}" class="nav-link">Characters</a></li>
                    <li><a href="{{ route('series.index') }}" class="nav-link">Universes</a></li>
                </ul>

                <div class="nav-tools">
                    <a href="{{ route('search') }}" class="tool-pill" aria-label="Search">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </a>
                    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="tool-icon" aria-label="Wishlist">
                        <i class="fas fa-bookmark"></i>
                    </a>
                    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="tool-icon" aria-label="Cart">
                        <i class="fas fa-cart-shopping"></i>
                    </a>
                    <button type="button" class="tool-icon" id="theme-toggle" aria-label="Toggle theme">
                        <i class="fas fa-circle-half-stroke"></i>
                    </button>

                    @guest
                        <a href="{{ route('login') }}" class="vault-btn vault-btn--ghost">Sign In</a>
                        <a href="{{ route('register') }}" class="vault-btn vault-btn--accent">Join Vault</a>
                    @endguest

                    @auth
                        <div class="dropdown">
                            <button class="dropdown-toggle tool-pill" type="button" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu hidden">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
