<x-app-layout>
    <x-slot name="header">
        <div class="text-center py-6">
            <h2 class="font-serif font-bold text-4xl text-gray-900 leading-tight mb-3">
                Our Signature <span class="text-clinic-rose italic">Treatments</span>
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Discover our range of advanced aesthetic procedures designed to bring out your natural radiance.</p>
        </div>
    </x-slot>

    <div class="py-8 pb-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @forelse($servicesByCategory as $category => $services)
                <div class="mb-12">
                    <div class="flex items-center mb-6">
                        <h3 class="font-serif text-2xl font-semibold text-clinic-dark">{{ $category }}</h3>
                        <div class="flex-grow h-px bg-clinic-rose/20 ml-4"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($services as $service)
                            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-clinic-blush transition duration-300 group flex flex-col justify-between h-full">
                                
                                <div>
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="font-semibold text-lg text-gray-900 group-hover:text-clinic-rose transition">{{ $service->service_name }}</h4>
                                        <span class="bg-clinic-light text-clinic-dark text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">
                                            ₱{{ number_format($service->price, 2) }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                                        {{ $service->description ?? 'Experience a premium ' . strtolower($category) . ' treatment tailored to your skin needs.' }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                    <div class="flex items-center text-xs text-gray-400 font-medium">
                                        <svg class="w-4 h-4 mr-1 text-clinic-rose/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $service->duration_minutes }} mins
                                    </div>
                                    
                                    <a href="{{ route('appointments.book', ['service' => $service->id]) }}" class="text-sm font-semibold text-clinic-rose hover:text-clinic-dark transition flex items-center">
    Book This <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-clinic-light text-clinic-rose mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif text-gray-900 mb-2">Check back soon!</h3>
                    <p class="text-gray-500">Our medical team is currently updating the service catalog.</p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>