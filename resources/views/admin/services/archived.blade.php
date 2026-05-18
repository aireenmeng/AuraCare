<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-serif font-semibold text-2xl text-gray-500 leading-tight">
                {{ __('Archived Services') }}
            </h2>
            <a href="{{ route('services.index') }}" class="text-clinic-dark hover:text-clinic-rose font-medium text-sm transition">
                &larr; Back to Active Menu
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-gray-50 shadow-sm rounded-2xl overflow-hidden border border-gray-200 opacity-90">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Service Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Archived Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($services as $service)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 line-through">{{ $service->service_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $service->deleted_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('services.restore', $service->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 bg-green-50 px-3 py-1 rounded-md transition">Restore to Menu</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">No archived services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $services->links() }}</div>
        </div>
    </div>
</x-app-layout>