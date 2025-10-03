<header class="header-fixed bg-white border-b">
  <nav class="navbar">
    <div class="container flex items-center justify-between">
      {{-- Brand --}}
      <div class="nav-brand">
        <a href="{{ route('home') }}" class="logo">
          <i class="fas fa-bolt"></i> MARVEL
        </a>
      </div>

      {{-- Left menu --}}
      <ul class="nav-menu flex items-center gap-6" id="nav-menu">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('comics.index') }}" class="nav-link"><i class="fas fa-book"></i> Comics</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('characters.index') }}" class="nav-link"><i class="fas fa-mask"></i> Characters</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('series.index') }}" class="nav-link"><i class="fas fa-layer-group"></i> Series</a>
        </li>
      </ul>

      {{-- Right auth area --}}
      <div class="nav-auth flex items-center gap-4 ms-auto">
        @guest
          <a href="{{ route('login') }}" class="nav-link"><i class="fas fa-right-to-bracket"></i> Login</a>
          <a href="{{ route('register') }}" class="nav-link"><i class="fas fa-user-plus"></i> Register</a>
        @endguest

        @auth
          <div class="dropdown relative">
            <button class="dropdown-toggle nav-link flex items-center gap-1" type="button" id="userMenu">
              <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
              <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div class="dropdown-menu absolute right-0 mt-2 hidden min-w-[12rem] rounded-md bg-white shadow-lg ring-1 ring-black/5 z-50">
              <a class="dropdown-item block px-4 py-2 nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-gauge"></i> Dashboard
              </a>
              <a class="dropdown-item block px-4 py-2 nav-link" href="{{ route('profile.edit') }}">
                <i class="fas fa-id-badge"></i> Profile
              </a>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item block w-full text-left px-4 py-2 nav-link">
                  <i class="fas fa-right-from-bracket"></i> Log Out
                </button>
              </form>
            </div>
          </div>
        @endauth
      </div>

      {{-- Mobile toggle --}}
      <button class="nav-toggle" id="nav-toggle" aria-controls="nav-menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>
</header>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle (uses your existing CSS hooks)
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('nav-menu');
    if (toggle && menu) {
      toggle.addEventListener('click', () => {
        const expanded = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!expanded));
        menu.classList.toggle('open'); // style .nav-menu.open in CSS
      });
    }
    // Profile dropdown
    const ddToggle = document.getElementById('userMenu');
    const ddMenu = ddToggle ? ddToggle.parentElement.querySelector('.dropdown-menu') : null;
    if (ddToggle && ddMenu) {
      ddToggle.addEventListener('click', (e) => {
        e.preventDefault();
        ddMenu.classList.toggle('hidden');
      });
      document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown')) ddMenu.classList.add('hidden');
      });
    }
  });
</script>
