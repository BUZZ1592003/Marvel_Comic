<x-guest-layout>
  {{-- Optional: load brand auth styles for guest pages --}}
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}"> {{-- pairs with marvel-style.css --}}
  <link rel="stylesheet" href="{{ asset('css/marvel-style.css') }}">
  
  <div class="text-center mb-6">
    <a href="{{ route('home') }}" class="logo text-3xl font-black tracking-widest" style="color:#fff">
      <i class="fas fa-bolt"></i> MARVEL
    </a>
    <p class="text-sm mt-2" style="color:#ccc">Join the universe — create an account</p>
  </div>

  <form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <!-- Name -->
    <div>
      <x-input-label for="name" :value="__('Name')" class="text-white" />
      <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name"
        class="block mt-1 w-full rounded-md border border-[#4A4A4A] bg-[#151515] text-white focus:border-[#ED1D24] focus:ring-[#ED1D24]" />
      <x-input-error :messages="$errors->get('name')" class="mt-2 text-[#ED1D24]" />
    </div>

    <!-- Email -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" class="text-white" />
      <x-text-input id="email" name="email" type="email" :value="old('email')" required autocomplete="username"
        class="block mt-1 w-full rounded-md border border-[#4A4A4A] bg-[#151515] text-white focus:border-[#ED1D24] focus:ring-[#ED1D24]" />
      <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#ED1D24]" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" class="text-white" />
      <x-text-input id="password" name="password" type="password" required autocomplete="new-password"
        class="block mt-1 w-full rounded-md border border-[#4A4A4A] bg-[#151515] text-white focus:border-[#ED1D24] focus:ring-[#ED1D4]" />
      <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#ED1D24]" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
      <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
        class="block mt-1 w-full rounded-md border border-[#4A4A4A] bg-[#151515] text-white focus:border-[#ED1D24] focus:ring-[#ED1D24]" />
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[#ED1D24]" />
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between mt-6">
      <a href="{{ route('login') }}" class="text-sm" style="color:#FFD700">
        {{ __('Already registered?') }}
      </a>

      <x-primary-button
        class="ms-4 inline-flex items-center px-5 py-2.5 rounded-md 
               text-white font-semibold uppercase tracking-wider
               bg-gradient-to-r from-[#ED1D24] to-[#B71C1C]
               hover:from-[#B71C1C] hover:to-[#ED1D24]
               focus:ring-2 focus:ring-[#ED1D24] focus:ring-offset-2 focus:ring-offset-black">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
