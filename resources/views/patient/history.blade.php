<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-3xl text-gray-900 leading-tight">
            My <span class="text-clinic-rose italic">Aesthetic Journey</span>
        </h2>
    </x-slot>

    <div class="py-12 pb-24">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <section>
                <div class="flex items-center mb-6">
                    <h3 class="font-serif text-2xl font-semibold text-clinic-dark">Upcoming Visits</h3>
                    <div class="flex-grow h-px bg-clinic-rose/20 ml-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($upcoming as $appt)
                        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-start space-x-4">
                            <div class="bg-clinic-light p-4 rounded-2xl text-clinic-rose shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-bold text-gray-900">{{ $appt->service->service_name }}</h4>
                                    <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-full 
                                        {{ $appt->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $appt->status }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('F d, Y') }}</p>
                                <p class="text-sm font-semibold text-clinic-rose">{{ \Carbon\Carbon::parse($appt->start_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white p-8 rounded-3xl border border-dashed border-gray-200 text-center text-gray-400">
                            You have no upcoming appointments. <a href="{{ route('appointments.book') }}" class="text-clinic-rose hover:underline font-medium">Book one now.</a>
                        </div>
                    @endforelse
                </div>
            </section>


            <section>
                <div class="flex items-center mb-6">
                    <h3 class="font-serif text-2xl font-semibold text-gray-400">Treatment Portfolio</h3>
                    <div class="flex-grow h-px bg-gray-200 ml-4"></div>
                </div>

                <div class="space-y-6">
                    @forelse($past as $appt)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100">
                            
                            <div class="p-6 md:px-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $appt->service->service_name }}</h4>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full 
                                        {{ $appt->status == 'Completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $appt->status }}
                                    </span>
                                </div>
                            </div>

                            @if($appt->status === 'Completed' && $appt->treatmentRecord)
                                <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                                    
                                    <div class="md:col-span-2 space-y-3">
                                        <h5 class="text-xs font-bold text-clinic-rose uppercase tracking-widest">Clinic Notes</h5>
                                        <p class="text-gray-600 text-sm leading-relaxed bg-clinic-light/30 p-4 rounded-2xl border border-clinic-rose/10">
                                            "{{ $appt->treatmentRecord->staff_notes }}"
                                        </p>
                                    </div>

                                    <div class="md:col-span-1">
                                        @if($appt->treatmentRecord->photo_path)
                                            <div class="relative w-full h-40 rounded-2xl overflow-hidden shadow-sm border-2 border-white group">
                                                <img src="{{ asset('storage/' . $appt->treatmentRecord->photo_path) }}" alt="Treatment Result" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                                    <span class="text-white text-xs font-bold tracking-widest uppercase">Post-Treatment</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-full h-40 rounded-2xl bg-gray-50 flex items-center justify-center border border-dashed border-gray-200">
                                                <span class="text-xs text-gray-400 font-medium">No photo uploaded</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif($appt->status === 'Cancelled')
                                <div class="p-6 text-sm text-gray-400 italic">This appointment was cancelled.</div>
                            @else
                                <div class="p-6 text-sm text-gray-400 italic">Processing treatment records...</div>
                            @endif

                        </div>
                    @empty
                        <div class="bg-white p-12 rounded-3xl border border-gray-100 text-center shadow-sm">
                            <p class="text-gray-500">Your past treatment history will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>
</x-app-layout>