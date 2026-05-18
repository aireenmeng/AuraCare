<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="font-serif text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
        <p class="text-sm text-gray-500">Log in to manage your appointments and aesthetic journey.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input id="email" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 transition-colors" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-clinic-rose shadow-sm focus:ring-clinic-blush" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-clinic-dark hover:text-clinic-rose font-medium transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full bg-clinic-rose hover:bg-clinic-dark text-white font-medium py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-0.5">
                {{ __('Log in securely') }}
            </button>
        </div>
        
        <div class="mt-6 text-center text-sm text-gray-500">
            Don't have an account yet? 
            <a href="{{ route('register') }}" class="text-clinic-dark hover:text-clinic-rose font-semibold transition-colors">Sign up here</a>
        </div>
    </form>
</x-guest-layout>