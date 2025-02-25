@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="container mx-auto px-4 pt-24 pb-12">

    @if (session()->has('success'))
        <x-alert type="success" :message="session('success')" />
    @elseif (session()->has('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <!-- Title -->
    <div class="text-center mb-12">
        <p class="text-gray-400">Explore and share knowledge</p>
    </div>

    <!-- Actions Bar -->
    <div class="mb-8 flex justify-end items-end">
        <a href="{{ route('questions.create') }}" class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded-lg flex items-center transition-colors duration-200">
            Add Question
        </a>
    </div>

    @if ($questions->count() > 0)
        <!-- Questions List -->
        <div class="space-y-4">
            <!-- Question Card -->
            @foreach ( $questions as $question)
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors duration-200">
                    <div class="flex justify-between">
                        <!-- Left Content -->
                        <div class="flex-1">

                            <!-- location Name -->
                            <div class="flex gap-2 mb-3">
                                <span class="px-3 py-1 bg-gray-900/50 text-gray-300 text-sm rounded-lg border border-gray-700">{{ $question->location_name }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-semibold text-gray-200 mb-2">
                                {{ $question->title }}
                            </h3>

                            <!-- Content -->
                            <p class="text-gray-400 mb-4">
                                {{ Str::limit($question->content, 100) }}
                            </p>

                            <!-- Meta -->
                            <div class="flex items-center text-sm space-x-6">
                                <button class="text-gray-500 flex items-center hover:text-blue-400 transition-colors">
                                    <a href="{{ route('questions.show', $question) }}">{{ $question->answers_count }} replies</a>
                                </button>
                                @if (Auth::id() === $question->utilisateur_id)
                                    <a href="{{ route('questions.edit', $question) }}" class="text-gray-500 flex items-center hover:text-orange-500 transition-colors">
                                        Update
                                    </a>
                                    <form action="{{ route('questions.destroy', $question) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-gray-500 flex items-center hover:text-red-500 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                @endif

                                @php
                                   $is_a_fav = \App\Models\Favorite::where('question_id', $question->id)->where('utilisateur_id', Auth::id())->exists();
                                @endphp

                                @if ($is_a_fav)
                                    <form action="{{ route('favorites.destroy', $question) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-gray-500 flex items-center hover:text-red-500 transition-colors">
                                            Remove Favorite
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorites.store', $question) }}" method="POST">
                                        @csrf
                                        <button class="text-gray-500 flex items-center hover:text-green-500 transition-colors">
                                            Add Favorite
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Right Content - Author -->
                        <div class="flex items-center gap-2 ml-4">
                            <img src="https://ui-avatars.com/api/?name={{ $question->utilisateur->name }}&background=6B7280&color=fff"
                                    class="w-6 h-6 rounded-full"
                                    alt="User avatar">
                            <span class="text-gray-400">{{ $question->utilisateur->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex justify-center items-center h-[60vh]">
            <p class="text-red-500 font-extrabold text-3xl">No Questions Yet</p>
        </div>
    @endif
</div>
@endsection
