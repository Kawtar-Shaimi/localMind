@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl shadow-2xl border border-gray-300 space-y-6">
    <h1 class="text-4xl font-extrabold text-gray-900 text-center">{{ $question->title }}</h1>
    
    <p class="text-gray-700 text-lg mt-4">{{ $question->description }}</p>
    
    <div class="mt-4">
        <span class="text-sm font-semibold text-gray-600">Tags:</span>
        <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
            {{ $question->tags }}
        </span>
    </div>
    
    <div class="flex justify-between items-center mt-6">
        <a href="{{ route('questions.edit', $question->id) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105">
            Edit
        </a>
        
        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105">
                Delete
            </button>
        </form>
    </div>
</div>
@endsection
