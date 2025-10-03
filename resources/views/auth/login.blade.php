<x-guest-layout>
  {{-- Optional: load public auth.css for extra polish --}}
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
  <link rel="stylesheet" href="{{ asset('css/marvel-style.css') }}">

  <div class="text-center mb-6">
    <a href="{{ route('home') }}" class="logo text-3xl font-black tracking-widest" style="color:#fff">
      <i class="fas fa-bolt"></i> MARVEL
    </a>
    <p class="text-sm mt-2" style="color:#ccc">Welcome back — sign in to continue</p>
  </div>

  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    <!-- Email -->
    <div>
      <x-input-label for="email" :value="__('Email')" class="text-white" />
      <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
        class="block mt-1 w-full rounded-md border border-[#4A4A4A] bg-[#151515] text-white focus:border-[#ED1D24] focus:ring-[#ED1D24]" />
      <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#ED1D24]" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" class="text-white" />
      <x-text-input id="password" type="password" name="password" required
        class="block mt-1 w-full rounded-md border border-[#4A4A4A] bg-[#151515] text-white focus:border-[#ED1D24] focus:ring-[#ED1D24]" />
      <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#ED1D24]" />
    </div>

    <!-- Remember -->
    <label for="remember_me" class="inline-flex items-center mt-2">
      <input id="remember_me" type="checkbox" name="remember"
        class="rounded border-gray-500 text-[#ED1D24] focus:ring-[#ED1D24]" />
      <span class="ms-2 text-sm" style="color:#ccc">{{ __('Remember me') }}</span>
    </label>

    <!-- Actions -->
    <div class="flex items-center justify-between mt-6">
      @if (Route::has('password.request'))
        <a class="text-sm" style="color:#FFD700"
           href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
      @endif

      <x-primary-button
        class="ms-3 inline-flex items-center px-5 py-2.5 rounded-md 
               text-white font-semibold uppercase tracking-wider
               bg-gradient-to-r from-[#ED1D24] to-[#B71C1C]
               hover:from-[#B71C1C] hover:to-[#ED1D24]
               focus:ring-2 focus:ring-[#ED1D24] focus:ring-offset-2 focus:ring-offset-black">
        {{ __('Log in') }}
      </x-primary-button>
    </div>

    <p class="text-center text-sm mt-4" style="color:#ccc">
      New here?
      <a href="{{ route('register') }}" style="color:#FFD700">Create an account</a>
    </p>
  </form>
</x-guest-layout>
