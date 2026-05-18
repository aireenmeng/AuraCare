<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="font-serif text-3xl font-bold text-gray-900 mb-2">Begin Your Journey</h2>
        <p class="text-sm text-gray-500">Create an account to book your personalized aesthetic treatments.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input id="name" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Mobile Number</label>
            <input id="phone" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 transition-colors" type="text" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="09xxxxxxxxx" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input id="email" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 transition-colors" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" class="block mt-1 w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full bg-clinic-rose hover:bg-clinic-dark text-white font-medium py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-0.5">
                {{ __('Create Account') }}
            </button>
        </div>
        
        <div class="mt-6 text-center text-sm text-gray-500">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-clinic-dark hover:text-clinic-rose font-semibold transition-colors">Log in securely</a>
        </div>
    </form>
</x-guest-layout>