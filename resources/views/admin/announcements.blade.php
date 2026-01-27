@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Manage Announcements</h1>

        <div class="flex flex-wrap -mx-4">
            <!-- Add New Announcement Form -->
            <div class="w-full md:w-1/2 px-4 mb-8">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">Add New Announcement</h2>
                    <form action="{{ route('admin.announcements.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Title
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="e.g., New Class Available" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                                Content
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" name="content" placeholder="e.g., A new yoga class has been added..." required></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Add Announcement
                        </button>
                    </form>
                </div>
            </div>

            <!-- Existing Announcements -->
            <div class="w-full md:w-1/2 px-4">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">Existing Announcements</h2>
                    <ul class="divide-y divide-gray-200">
                        @foreach($announcements as $announcement)
                            <li class="py-4">
                                <h3 class="text-lg font-semibold">{{ $announcement->title }}</h3>
                                <p class="text-gray-600">{{ $announcement->content }}</p>
                                <small class="text-gray-500">{{ $announcement->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
