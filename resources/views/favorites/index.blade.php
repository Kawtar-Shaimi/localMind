@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-2xl rounded-3xl border border-gray-300">
    <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">Favorite Questions</h2>
    
    @if($favorites->isEmpty())
        <p class="text-center text-gray-500">No favorite questions yet.</p>
    @else
        <div class="space-y-6">
            @foreach($favorites as $question)
                <div class="p-6 bg-gray-100 rounded-2xl shadow-md">
                    <h3 class="text-xl font-bold text-gray-800">{{ $question->title }}</h3>
                    <p class="text-gray-600 mt-2">{{ $question->description }}</p>
                    
                    <div class="mt-4 flex items-center justify-between">
                        <div>
                            @foreach(explode(',', $question->tags) as $tag)
                                <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">#{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                        
                        <form action="{{ route('favorites.remove', $question->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-2xl shadow-md hover:bg-red-700 transition-all">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
