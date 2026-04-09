<x-guest-layout>
    <div class="guest-head">
        <h1>Create Account</h1>
        <p>Join Marvel Vault and start your curated reading lane.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="vault-form">
        @csrf

        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" :value="old('email')" required class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" name="password" type="password" required class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" required class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        <div class="auth-actions">
            <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
            <x-primary-button class="vault-btn vault-btn--accent">{{ __('Register') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
