<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Marvel Vault') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/heroic-style.css') }}">
</head>
<body class="vault-body guest-body">
    <div class="guest-shell">
        <a href="{{ route('home') }}" class="logo guest-logo" aria-label="Home">
            <span class="logo-mark">MV</span>
            <span class="logo-text"><strong>Marvel Vault</strong><small>Auth Portal</small></span>
        </a>
        <div class="guest-card">
            {{ $slot }}
        </div>
    </div>
    <script src="{{ asset('js/heroic-script.js') }}"></script>
</body>
</html>
