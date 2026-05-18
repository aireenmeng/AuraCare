<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif font-semibold text-3xl text-gray-900 leading-tight">
                    {{ $patient->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Contact: {{ $patient->phone }} | {{ $patient->email }}</p>
            </div>
            <a href="{{ route('patients.index') }}" class="text-sm text-clinic-dark hover:text-clinic-rose transition">&larr; Back to Directory</a>
        </div>
    </x-slot>

    <div class="py-8 pb-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-center shadow-sm">
                    <span class="text-green-700 font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <h3 class="font-serif text-2xl font-semibold text-clinic-dark mb-6">Treatment History & Portfolio</h3>

            <div class="space-y-8">
                @forelse($appointments as $appointment)
                    <div class="bg-white shadow-sm rounded-3xl overflow-hidden border border-gray-100 p-6 md:p-8">
                        <div class="flex flex-col md:flex-row justify-between md:items-center border-b border-gray-100 pb-4 mb-6">
                            <div>
                                <h4 class="text-xl font-bold text-gray-900">{{ $appointment->service->service_name }}</h4>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</p>
                            </div>
                            <div class="mt-2 md:mt-0">
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $appointment->status }}</span>
                            </div>
                        </div>

                        @if($appointment->status === 'Completed')
                            
                            @if($appointment->treatmentRecord)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-clinic-light/20 p-6 rounded-2xl">
                                    <div>
                                        <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Staff Notes</h5>
                                        <p class="text-gray-700 leading-relaxed">{{ $appointment->treatmentRecord->staff_notes }}</p>
                                    </div>
                                    @if($appointment->treatmentRecord->photo_path)
                                        <div>
                                            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">After Photo</h5>
                                            <div class="w-full h-48 rounded-xl overflow-hidden shadow-sm">
                                                <img src="{{ asset('storage/' . $appointment->treatmentRecord->photo_path) }}" alt="Treatment Result" class="w-full h-full object-cover">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <form action="{{ route('patients.storeRecord', $appointment->id) }}" method="POST" enctype="multipart/form-data" class="bg-clinic-light/50 p-6 rounded-2xl border border-clinic-rose/20">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Post-Treatment Notes</label>
                                            <textarea name="staff_notes" rows="4" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush transition" placeholder="Enter clinical observations, skin reactions, or home-care advice..." required></textarea>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Progress Photo (Optional)</label>
                                            <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-clinic-rose file:text-white hover:file:bg-clinic-dark transition cursor-pointer">
                                            <p class="text-xs text-gray-400 mt-2">Accepted formats: JPG, PNG (Max 2MB)</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-end">
                                        <button type="submit" class="bg-clinic-dark hover:bg-clinic-rose text-white px-6 py-2 rounded-xl font-medium shadow-sm transition">Save Treatment Record</button>
                                    </div>
                                </form>
                            @endif

                        @else
                            <p class="text-sm text-gray-400 italic">Clinical notes and photos can only be added once this appointment is marked as "Completed" in the Master Schedule.</p>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-3xl border border-gray-100 shadow-sm">
                        <p class="text-gray-500 italic">This patient has no booking history yet.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>