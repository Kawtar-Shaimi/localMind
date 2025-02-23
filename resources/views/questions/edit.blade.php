@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
    <!-- Info Bar -->
    <div class="fixed top-0 right-0 m-4 bg-gray-800/80 backdrop-blur rounded-lg p-3 hidden md:flex items-center space-x-4 z-50 border border-gray-700">
        <span class="text-gray-300 flex items-center">
            <i class="far fa-clock mr-2"></i>
            <span id="current-datetime" class="font-mono">2025-02-23 22:00:33</span>
        </span>
        <div class="border-l border-gray-700 h-6"></div>
        <span class="text-gray-300 flex items-center">
            <i class="far fa-user-circle mr-2"></i>
            <span>Kawtar-Shaimi</span>
        </span>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-24 pb-12">
        <!-- Back Button -->
        <a href="{{ route('questions.index') }}" class="inline-flex items-center text-gray-400 hover:text-gray-300 mb-8">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Questions
        </a>

        <!-- Edit Form Container -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-gray-800 rounded-lg border border-gray-700 shadow-lg overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gray-800/50 border-b border-gray-700 p-6">
                    <h1 class="text-2xl font-semibold text-gray-100">Edit Question</h1>
                </div>

                <!-- Form Body -->
                <form action="{{ route('questions.update', $question->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $question->title) }}" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-300 focus:outline-none focus:border-gray-500 transition-colors"
                            placeholder="What's your question about?"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Tags</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'MySQL', 'API'] as $tag)
                                <button 
                                    type="button"
                                    class="px-3 py-1.5 text-sm border {{ in_array($tag, $question->tags ?? []) ? 'bg-gray-600 text-white border-gray-500' : 'bg-gray-700 text-gray-300 border-gray-600' }} rounded-full hover:bg-gray-600 transition-colors"
                                    onclick="toggleTag(this, '{{ $tag }}')"
                                >
                                    {{ $tag }}
                                </button>
                            @endforeach
                        </div>
                        <input type="hidden" name="tags" id="selectedTags" value="{{ implode(',', $question->tags ?? []) }}">
                        @error('tags')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Field -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Content</label>
                        <div class="border border-gray-600 rounded-lg overflow-hidden">
                            <!-- Toolbar -->
                            <div class="bg-gray-700 p-2 flex items-center gap-1 border-b border-gray-600">
                                <button type="button" onclick="insertFormat('**', '**')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-600 rounded">
                                    <i class="fas fa-bold"></i>
                                </button>
                                <button type="button" onclick="insertFormat('*', '*')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-600 rounded">
                                    <i class="fas fa-italic"></i>
                                </button>
                                <button type="button" onclick="insertFormat('```\n', '\n```')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-600 rounded">
                                    <i class="fas fa-code"></i>
                                </button>
                                <button type="button" onclick="insertFormat('- ', '')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-600 rounded">
                                    <i class="fas fa-list"></i>
                                </button>
                                <button type="button" onclick="insertFormat('[', '](url)')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-600 rounded">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                            
                            <!-- Editor -->
                            <textarea 
                                name="content" 
                                id="content" 
                                rows="12" 
                                class="w-full bg-gray-700 text-gray-300 p-4 focus:outline-none"
                                placeholder="Describe your question in detail..."
                            >{{ old('content', $question->content) }}</textarea>
                        </div>
                        @error('content')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Preview</label>
                        <div id="preview" class="bg-gray-700 rounded-lg p-4 text-gray-300 min-h-[100px]">
                            Preview will appear here...
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-700">
                        <a href="{{ route('questions.index') }}" 
                           class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// DateTime Update
function updateDateTime() {
    const now = new Date();
    const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
    document.getElementById('current-datetime').textContent = formatted;
}
updateDateTime();
setInterval(updateDateTime, 1000);

// Tags Management
let selectedTags = new Set(document.getElementById('selectedTags').value.split(',').filter(Boolean));

function toggleTag(button, tag) {
    button.classList.toggle('bg-gray-600');
    button.classList.toggle('text-white');
    button.classList.toggle('border-gray-500');
    button.classList.toggle('bg-gray-700');
    button.classList.toggle('text-gray-300');
    button.classList.toggle('border-gray-600');

    if (selectedTags.has(tag)) {
        selectedTags.delete(tag);
    } else {
        selectedTags.add(tag);
    }
    
    document.getElementById('selectedTags').value = Array.from(selectedTags).join(',');
}

// Text Editor Functions
function insertFormat(prefix, suffix) {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const before = text.substring(0, start);
    const selection = text.substring(start, end);
    const after = text.substring(end);

    textarea.value = before + prefix + selection + suffix + after;
    updatePreview();
    
    // Reset cursor position
    textarea.focus();
    textarea.setSelectionRange(
        start + prefix.length,
        end + prefix.length
    );
}

// Preview Update
const textarea = document.getElementById('content');
const preview = document.getElementById('preview');

function updatePreview() {
    // Here you could add markdown parsing if needed
    preview.innerHTML = textarea.value.replace(/\n/g, '<br>');
}

textarea.addEventListener('input', updatePreview);
updatePreview();
</script>
@endsection