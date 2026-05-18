<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-clinic-text leading-tight">
            {{ __('Add New Skincare Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl p-8 border border-gray-100">
                
                <form action="{{ route('services.store') }}" method="POST" class="space-y-6">
                    @csrf 

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Treatment Name</label>
                            <input type="text" name="service_name" value="{{ old('service_name') }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50" required>
                            @error('service_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50" required>
                                <option value="">Select a category...</option>
                                <option value="Facial">Facial</option>
                                <option value="Laser">Laser</option>
                                <option value="Injectable">Injectable</option>
                                <option value="Consultation">Consultation</option>
                            </select>
                            @error('category') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price (₱)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50" required>
                            @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50" required>
                            @error('duration_minutes') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-clinic-rose focus:ring focus:ring-clinic-blush focus:ring-opacity-50">{{ old('description') }}</textarea>
                            @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('services.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 mr-4 hover:bg-gray-50 transition">Cancel</a>
                        <button type="submit" class="bg-clinic-rose hover:bg-clinic-dark text-white px-6 py-2 rounded-lg font-medium transition shadow-sm">Save Treatment</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>