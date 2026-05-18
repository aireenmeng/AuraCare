<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-3xl text-gray-900 leading-tight">
            Book Your <span class="text-clinic-rose italic">Visit</span>
        </h2>
    </x-slot>

    <div class="py-12 pb-24">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-center shadow-sm">
                    <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-red-700 font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-xl shadow-clinic-rose/5 rounded-3xl overflow-hidden border border-gray-100">
                <div class="p-8 md:p-10">
                    <p class="text-gray-500 mb-8">Select your desired treatment and preferred schedule. Our clinic team will review and confirm your request shortly.</p>

                    <form action="{{ route('appointments.store') }}" method="POST" class="space-y-8">
                        @csrf 

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">1. Choose a Treatment</label>
                            <select name="service_id" class="w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 py-3 transition" required>
                                <option value="" disabled selected>Select from our catalog...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->service_name }} (₱{{ number_format($service->price, 2) }} - {{ $service->duration_minutes }} mins)
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">2. Preferred Date</label>
                                <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" class="w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 py-3 transition" required>
                                @error('appointment_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">3. Preferred Time</label>
                                <select name="start_time" class="w-full rounded-xl border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50 py-3 transition" required>
                                    <option value="" disabled selected>Select a time...</option>
                                    <option value="09:00:00" {{ old('start_time') == '09:00:00' ? 'selected' : '' }}>09:00 AM</option>
                                    <option value="10:00:00" {{ old('start_time') == '10:00:00' ? 'selected' : '' }}>10:00 AM</option>
                                    <option value="11:00:00" {{ old('start_time') == '11:00:00' ? 'selected' : '' }}>11:00 AM</option>
                                    <option value="13:00:00" {{ old('start_time') == '13:00:00' ? 'selected' : '' }}>01:00 PM</option>
                                    <option value="14:00:00" {{ old('start_time') == '14:00:00' ? 'selected' : '' }}>02:00 PM</option>
                                    <option value="15:00:00" {{ old('start_time') == '15:00:00' ? 'selected' : '' }}>03:00 PM</option>
                                    <option value="16:00:00" {{ old('start_time') == '16:00:00' ? 'selected' : '' }}>04:00 PM</option>
                                    <option value="17:00:00" {{ old('start_time') == '17:00:00' ? 'selected' : '' }}>05:00 PM</option>
                                </select>
                                @error('start_time') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex justify-end">
                            <button type="submit" class="w-full md:w-auto bg-clinic-rose hover:bg-clinic-dark text-white font-medium py-3 px-8 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                Submit Booking Request
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>