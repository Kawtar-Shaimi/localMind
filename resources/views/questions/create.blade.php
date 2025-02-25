@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full flex justify-center items-center">
    <form class="w-1/3 my-10 bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors duration-200" method="POST" action="{{ route('questions.store') }}">
        @csrf
        <h2 class="text-3xl font-extrabold text-white text-center">Ask a Question</h2>

        <div class="my-5">
            <label for="title" class="block text-sm font-semibold text-white">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter your question title" value="{{ old('title') }}"
                    class="w-full mt-2 p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
        </div>

        @error('title')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror

        <div class="my-5">
            <label for="content" class="block text-sm font-semibold text-white">Content</label>
            <textarea id="content" name="content" rows="4" placeholder="Enter your question content"
                    class="w-full mt-2 p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none transition-all duration-300">{{ old('content') }}</textarea>
        </div>

        @error('content')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror

        <div class="my-5">
            <label for="location_name" class="block text-sm font-semibold text-white">Location Name</label>
            <input type="text" id="location_name" name="location_name" placeholder="e.g., Safi, Marrakech, Fes..." value="{{ old('location_name') }}"
                    class="w-full mt-2 p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
        </div>

        @error('location_name')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror

        <button type="submit" class="w-full my-5 bg-blue-500 text-white font-semibold py-4 rounded-lg shadow-lg ">
            Submit Question
        </button>
    </form>
</div>
@endsection
