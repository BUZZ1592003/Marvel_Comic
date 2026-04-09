<x-guest-layout>
    <div class="guest-head">
        <h1>Sign In</h1>
        <p>Continue your collector journey.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="vault-form">
        @csrf

        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" type="password" name="password" required class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <label for="remember_me" class="remember-row">
            <input id="remember_me" type="checkbox" name="remember">
            <span>{{ __('Remember me') }}</span>
        </label>

        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif
            <x-primary-button class="vault-btn vault-btn--accent">{{ __('Log in') }}</x-primary-button>
        </div>
    </form>

    <p class="auth-note">New here? <a href="{{ route('register') }}">Create an account</a></p>
</x-guest-layout>
