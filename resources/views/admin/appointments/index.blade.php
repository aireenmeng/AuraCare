<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-clinic-text leading-tight">
            {{ __('Master Schedule & Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12 pb-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                
                <div class="p-6 bg-clinic-light/30 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-700">All Appointments</h3>
                    <div class="text-sm text-gray-500">Manage incoming requests and active schedules.</div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Patient Name</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Service</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Schedule</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Update Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($appointments as $appointment)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $appointment->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $appointment->user->phone ?? 'No Phone' }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">{{ $appointment->service->service_name }}</div>
                                        <div class="text-xs text-gray-500">₱{{ number_format($appointment->service->price, 2) }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</div>
                                        <div class="text-xs text-clinic-rose font-semibold">{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($appointment->status == 'Pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">Pending</span>
                                        @elseif($appointment->status == 'Confirmed')
                                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Confirmed</span>
                                        @elseif($appointment->status == 'Completed')
                                            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">Completed</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">Cancelled</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" class="flex items-center justify-end gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-sm rounded-lg border-gray-200 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush py-1.5 cursor-pointer">
                                                <option value="" disabled selected>Update...</option>
                                                <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'disabled' : '' }}>Approve (Confirm)</option>
                                                <option value="Completed" {{ $appointment->status == 'Completed' ? 'disabled' : '' }}>Mark Completed</option>
                                                <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'disabled' : '' }}>Cancel</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-gray-500 italic text-lg">No appointments booked yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                {{ $appointments->links() }}
            </div>

        </div>
    </div>
</x-app-layout>