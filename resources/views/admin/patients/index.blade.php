<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-clinic-text leading-tight">
            {{ __('Patient Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                
                <div class="p-6 bg-clinic-light/30 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-700">Registered Patients</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Patient Name</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Contact Info</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Completed Visits</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($patients as $patient)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $patient->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $patient->phone ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-500">{{ $patient->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                        {{ $patient->appointments_count }} visits
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('patients.show', $patient->id) }}" class="text-clinic-rose hover:text-clinic-dark bg-clinic-blush/10 px-4 py-2 rounded-lg transition">Open Digital File &rarr;</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">No patients registered yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">{{ $patients->links() }}</div>
        </div>
    </div>
</x-app-layout>