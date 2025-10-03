<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Marvel Comics')</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/marvel-style.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

  <!-- Vite (include ONCE) -->
  @vite(['resources/js/app.js'])

    @yield('styles')
  </head>
  <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
      @include('layouts.navigation')

      <!-- Page Content -->
      <main class="main-content">
        @hasSection('header')
          <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
              @yield('header')
            </div>
          </header>
        @endif

        @yield('content')
      </main>
    </div>

    @include('layouts.footer')

    <!-- Public JS -->
    <script src="{{ asset('js/marvel-script.js') }}"></script>

    <!-- Route-conditional JS -->
    @if(request()->routeIs('characters.*'))
      <script src="{{ asset('js/characters.js') }}"></script>
    @endif
    @if(request()->routeIs('comics.*'))
      <script src="{{ asset('js/comics.js') }}"></script>
    @endif
    @if(request()->routeIs('series.*'))
      <script src="{{ asset('js/series.js') }}"></script>
    @endif

    @yield('scripts')
  </body>
</html>
