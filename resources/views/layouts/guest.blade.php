<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Sign in')</title>

    <link rel="stylesheet" href="{{ asset('css/marvel-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])

    @yield('styles')
  </head>
  <body class="font-sans text-gray-900 antialiased bg-black">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
      <div class="text-center">
        <a href="{{ route('home') }}" class="logo text-3xl font-black tracking-widest text-white">
          <i class="fas fa-bolt"></i> MARVEL
        </a>
      </div>

      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg auth-card">
        @yield('content')
      </div>
    </div>

    @yield('scripts')
  </body>
</html>
