<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-clinic-text leading-tight">
            {{ __('Welcome back,') }} <span class="text-clinic-rose">{{ Auth::user()->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(Auth::user()->role === 'admin')
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="bg-clinic-blush/20 p-4 rounded-full text-clinic-rose">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Today's Appointments</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $todayAppointments }}</h3>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="bg-clinic-blush/20 p-4 rounded-full text-clinic-rose">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Patients</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $totalPatients }}</h3>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="bg-clinic-blush/20 p-4 rounded-full text-clinic-rose">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Requests</p>
                            <h3 class="text-2xl font-bold text-clinic-rose">{{ $pendingRequests }}</h3>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="font-serif text-lg font-medium text-gray-900 mb-4">Appointments (Last 7 Days)</h3>
                        <div class="relative h-64 w-full">
                            <canvas id="appointmentsChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="font-serif text-lg font-medium text-gray-900 mb-4">Revenue by Category</h3>
                        <div class="relative h-64 w-full flex justify-center">
                            <canvas id="servicesChart"></canvas>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // 1. Weekly Appointments Line Chart
                        const ctxAppt = document.getElementById('appointmentsChart').getContext('2d');
                        new Chart(ctxAppt, {
                            type: 'line',
                            data: {
                                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                                datasets: [{
                                    label: 'Bookings',
                                    data: [4, 6, 3, 8, 5, 12, 10], // Dummy data for now
                                    borderColor: '#E8A0BF', // clinic-rose
                                    backgroundColor: 'rgba(232, 160, 191, 0.2)',
                                    borderWidth: 3,
                                    tension: 0.4, // Smooth curves
                                    fill: true
                                }]
                            },
                            options: { responsive: true, maintainAspectRatio: false }
                        });

                        // 2. Revenue by Category Doughnut Chart
                        const ctxServ = document.getElementById('servicesChart').getContext('2d');
                        new Chart(ctxServ, {
                            type: 'doughnut',
                            data: {
                                labels: ['Facials', 'Laser', 'Injectables', 'Consultations'],
                                datasets: [{
                                    data: [45, 25, 20, 10], // Dummy percentage data
                                    backgroundColor: [
                                        '#F4B8CD', // clinic-blush
                                        '#E8A0BF', // clinic-rose
                                        '#D07C9E', // clinic-dark
                                        '#FDF3F4'  // clinic-light
                                    ],
                                    borderWidth: 0,
                                    hoverOffset: 4
                                }]
                            },
                            options: { responsive: true, maintainAspectRatio: false, cutout: '70%' }
                        });
                    });
                </script>

                <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-8 text-center mt-6">
                    <h3 class="font-serif text-xl font-medium text-gray-900 mb-2">Clinic Operations</h3>
                    <p class="text-gray-500 mb-6">Manage today's schedule, update the service catalog, or generate reports.</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('appointments.index') }}" class="bg-clinic-rose hover:bg-clinic-dark text-white px-6 py-2.5 rounded-full font-medium transition shadow-sm">View Schedule</a>
                        <a href="{{ route('services.index') }}" class="bg-clinic-light text-clinic-dark hover:bg-clinic-blush/50 px-6 py-2.5 rounded-full font-medium transition">Manage Services</a>
                        
                        <a href="{{ route('reports.monthly') }}" class="bg-gray-800 hover:bg-black text-white px-6 py-2.5 rounded-full font-medium transition shadow-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export Monthly PDF
                        </a>
                    </div>
                </div>

            @else
                
                <div class="bg-gradient-to-r from-clinic-rose to-clinic-dark rounded-3xl p-8 md:p-12 text-white shadow-lg flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h3 class="font-serif text-3xl mb-2">Ready for your glow up?</h3>
                        <p class="text-white/80 max-w-md">Book your next aesthetic treatment easily. Our calendar is open and waiting for you.</p>
                    </div>
                    <a href="#" class="bg-white text-clinic-rose hover:bg-clinic-light px-8 py-3 rounded-full font-semibold transition shadow-md whitespace-nowrap text-lg">
                        Book Appointment
                    </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-clinic-rose" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Upcoming Visit
                    </h4>
                    
                    @if($nextAppointment)
                        <div class="py-4">
                            <h5 class="font-bold text-lg text-gray-900">{{ $nextAppointment->service->service_name }}</h5>
                            <p class="text-clinic-rose font-medium mt-1">{{ \Carbon\Carbon::parse($nextAppointment->appointment_date)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($nextAppointment->start_time)->format('h:i A') }}</p>
                            <span class="inline-block mt-3 text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full {{ $nextAppointment->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                Status: {{ $nextAppointment->status }}
                            </span>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-400 mb-4">You don't have any upcoming appointments.</p>
                        </div>
                    @endif
                </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-clinic-rose" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Treatment History
                        </h4>
                        <ul class="space-y-4">
                            <li class="text-center py-4 text-gray-400">Your past treatments will appear here.</li>
                        </ul>
                    </div>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>