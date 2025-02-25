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
    <!-- Question Card -->
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
        @if ($question->answers->count() > 0)
        <!-- Answers List -->
        <div class="space-y-4 my-5">
            <!-- Answer Card -->
            @foreach ( $question->answers as $answer)
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors duration-200">
                    <div class="flex justify-between">
                        <!-- Left Content -->
                        <div class="flex-1">

                            <!-- Content -->
                            <p class="text-gray-400 mb-4">
                                {{ $answer->content }}
                            </p>

                            <!-- Meta -->
                            <div class="flex items-center text-sm space-x-6">
                                @if (Auth::id() === $answer->utilisateur_id)
                                    <span class="text-gray-500 flex items-center hover:text-orange-500 transition-colors cursor-pointer" onclick="updateForm('{{ $answer->content }}','{{ route('answers.update', $answer) }}')">
                                        Update
                                    </span>
                                    <form action="{{ route('answers.destroy', $question) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-gray-500 flex items-center hover:text-red-500 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Right Content - Author -->
                        <div class="flex items-center gap-2 ml-4">
                            <img src="https://ui-avatars.com/api/?name={{ $answer->utilisateur->name }}&background=6B7280&color=fff"
                                    class="w-6 h-6 rounded-full"
                                    alt="User avatar">
                            <span class="text-gray-400">{{ $answer->utilisateur->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <div class="flex justify-center items-center h-[60vh]">
                <p class="text-red-500 font-extrabold text-3xl">No Answers Yet</p>
            </div>
        @endif
        <div>
            <form id="answerForm" class="flex" action="{{ route('answers.store', $question) }}" method="POST">
                @csrf
                <div class="w-11/12">
                    <input id="answer_input" type="text" name="content" placeholder="Enter your answer content" value="{{ old('content') }}"
                        class="w-full p-4 border border-gray-300 rounded-s-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
                    @error('content')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-1/12 bg-blue-500 text-white font-semibold py-4 rounded-e-lg shadow-lg ">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function updateForm(contentValue, route) {
        let form = document.getElementById('answerForm');
        let content = document.getElementById('answer_input');
        content.value = contentValue;
        form.action = route;
        form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="PUT">');
    }
</script>
@endsection
