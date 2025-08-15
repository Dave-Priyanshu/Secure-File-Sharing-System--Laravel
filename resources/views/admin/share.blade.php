<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Share File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Share a File</h3>

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.share.store') }}">
                        @csrf

                        <!-- File Selection -->
                        <div class="mb-4">
                            <label for="file_id" class="block text-sm font-medium text-gray-700">Select File</label>
                            <select name="file_id" id="file_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select a file</option>
                               @foreach ($files as $file)
                                    <option value="{{ $file->id }}">
                                        {{ $file->name }} - ({{ $file->expires_at ? $file->expires_at->format('Y-m-d H:i:s') : 'Not set' }})
                                    </option>
                                @endforeach

                            </select>
                            @error('file_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Expiration Time -->
                        <div class="mb-4">
                            <label for="expiration_minutes" class="block text-sm font-medium text-gray-700">Expiration Time (Minutes)</label>
                            <input type="number" name="expiration_minutes" id="expiration_minutes" value="10" min="1" max="60" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('expiration_minutes')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div> 

                        <!-- User Selection -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Select Users</label>
                            @foreach ($users as $user)
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2">{{ $user->name }} ({{ $user->email }})</span>
                                    </label>
                                </div>
                            @endforeach
                            @error('user_ids')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="inline-block bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                                Share File
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
