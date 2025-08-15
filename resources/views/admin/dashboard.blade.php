<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                    <!-- Navigation Links -->
                    <div class="mb-6">
                        <a href="{{ route('admin.upload') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-red-600 font-bold py-2 px-4 rounded mr-2">
                            Upload New File
                        </a>
                        <a href="" class="inline-block bg-green-500 hover:bg-green-700 text-red-600 font-bold py-2 px-4 rounded">
                            Registered Users List
                        </a>
                         <a href="" class="inline-block bg-green-500 hover:bg-green-700 text-red-600 font-bold py-2 px-4 rounded">
                            Share Files
                        </a>
                    </div>

                    <!-- Files List -->
                    <div>
                        <h4 class="text-md font-medium mb-2">Uploaded Files</h4>
                        @if (empty($files))
                            <p>No files uploaded yet.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded At</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($files as $file)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $file->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $file->created_at }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $file->is_used }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
