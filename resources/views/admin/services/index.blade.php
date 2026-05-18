<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-serif font-semibold text-2xl text-clinic-text leading-tight">
                {{ __('Service Menu Management') }}
            </h2>
            <div class="space-x-3">
                <a href="{{ route('services.archived') }}" class="bg-clinic-light text-clinic-dark hover:bg-clinic-blush px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm border border-clinic-rose/20">
                    View Archived
                </a>
                <a href="{{ route('services.create') }}" class="bg-clinic-rose hover:bg-clinic-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                    + Add New Service
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-clinic-light">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Service Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price (₱)</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($services as $service)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $service->service_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><span class="bg-clinic-blush/20 text-clinic-dark px-2 py-1 rounded-full text-xs font-semibold">{{ $service->category }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $service->duration_minutes }} mins</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱{{ number_format($service->price, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center gap-3">
                                <a href="{{ route('services.edit', $service->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-md transition">Edit</a>
                                
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this treatment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-md transition">Delete</button>
                                </form>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">No services added yet. Click "Add New Service" to get started.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $services->links() }}
            </div>

        </div>
    </div>
</x-app-layout>