<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-clinic-rose/20 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <span class="font-serif text-2xl font-bold text-clinic-rose tracking-tight">AuraCare.</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()?->role === 'admin')
                        <x-nav-link :href="route('appointments.index')" :active="request()->is('appointments*')">
                            {{ __('Appointments') }}
                        </x-nav-link>
                        <x-nav-link :href="route('patients.index')" :active="request()->is('patients*')">
                            {{ __('Patient Records') }}
                        </x-nav-link>
                        <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.*')">
                            {{ __('Services Catalog') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('appointments.book')" :active="request()->is('book-appointment')">
                            {{ __('Book Now') }}
                        </x-nav-link>
                        <x-nav-link :href="route('patient.history')" :active="request()->routeIs('patient.history')">
                            {{ __('My History') }}
                        </x-nav-link>
                        <x-nav-link :href="route('patient.services')" :active="request()->routeIs('patient.services')">
                            {{ __('Menu') }}
                        </x-nav-link>
                        
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-clinic-rose focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()?->name }} <span class="text-xs text-clinic-rose font-bold ml-1">({{ ucfirst(Auth::user()?->role) }})</span></div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>