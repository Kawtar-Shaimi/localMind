@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
    <!-- Info Bar -->
    <div class="fixed top-0 right-0 m-4 bg-gray-800/80 backdrop-blur rounded-lg p-3 hidden md:flex items-center space-x-4 z-50 border border-gray-700">
        <span class="text-gray-300 flex items-center">
            <i class="far fa-clock mr-2"></i>
            <span id="current-datetime" class="font-mono">2025-02-23 22:32:17</span>
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
        <div class="max-w-4xl mx-auto mb-6">
            <a href="" 
               class="inline-flex items-center text-gray-400 hover:text-gray-300 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Question
            </a>
        </div>

        <!-- Form Container -->
        <div class="max-w-4xl mx-auto bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700/50 overflow-hidden shadow-xl">
            <div class="p-6 sm:p-8">
                <!-- Form Header -->
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-white mb-2">Edit Question</h1>
                    <p class="text-gray-400">Update your question details</p>
                </div>

                <!-- Question Form -->
                <form action="" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="title" class="text-sm font-medium text-gray-300">Title</label>
                            <span class="text-xs text-gray-500">Be specific and imagine you're asking a question to another person</span>
                        </div>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="w-full bg-gray-900/50 text-gray-100 border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-gray-600 focus:ring-1 focus:ring-gray-600 transition-all placeholder-gray-500"
                            placeholder="e.g., How to implement authentication with Laravel Breeze?"
                            value="{{ old('title', $question->title) }}"
                            required
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category & Tags -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Category -->
                        <div>
                            <label class="text-sm font-medium text-gray-300 mb-2 block">Category</label>
                            <select name="category" class="w-full bg-gray-900/50 text-gray-100 border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-gray-600 focus:ring-1 focus:ring-gray-600 transition-all">
                                <option value="">Select a category</option>
                                <option value="general" {{ $question->category === 'general' ? 'selected' : '' }}>General Discussion</option>
                                <option value="help" {{ $question->category === 'help' ? 'selected' : '' }}>Help Wanted</option>
                                <option value="bug" {{ $question->category === 'bug' ? 'selected' : '' }}>Bug Report</option>
                                <option value="feature" {{ $question->category === 'feature' ? 'selected' : '' }}>Feature Request</option>
                            </select>
                        </div>

                        <!-- Tags -->
                        <div>
                            <label class="text-sm font-medium text-gray-300 mb-2 block">Tags</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'API', 'Database'] as $tag)
                                    <button 
                                        type="button"
                                        class="px-3 py-1.5 text-sm border border-gray-700 rounded-lg {{ in_array($tag, $question->tags ?? []) ? 'bg-gray-800 text-gray-300 border-gray-600' : 'bg-gray-900/50 text-gray-400' }} hover:bg-gray-800 hover:text-gray-300 transition-all"
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
                    </div>

                    <!-- Content -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="content" class="text-sm font-medium text-gray-300">Question Details</label>
                            <span class="text-xs text-gray-500">Include all the information someone would need to answer your question</span>
                        </div>
                        <div class="border border-gray-700 rounded-lg overflow-hidden">
                            <!-- Toolbar -->
                            <div class="bg-gray-900/50 border-b border-gray-700 p-2 flex items-center gap-1">
                                <button type="button" onclick="insertFormat('**', '**')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded transition-all" title="Bold">
                                    <i class="fas fa-bold"></i>
                                </button>
                                <button type="button" onclick="insertFormat('*', '*')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded transition-all" title="Italic">
                                    <i class="fas fa-italic"></i>
                                </button>
                                <button type="button" onclick="insertFormat('# ', '')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded transition-all" title="Heading">
                                    <i class="fas fa-heading"></i>
                                </button>
                                <div class="h-4 w-px bg-gray-700 mx-1"></div>
                                <button type="button" onclick="insertFormat('- ', '')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded transition-all" title="List">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                                <button type="button" onclick="insertFormat('[', '](url)')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded transition-all" title="Link">
                                    <i class="fas fa-link"></i>
                                </button>
                                <button type="button" onclick="insertFormat('```\n', '\n```')" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded transition-all" title="Code Block">
                                    <i class="fas fa-code"></i>
                                </button>
                            </div>
                            
                            <!-- Editor -->
                            <textarea 
                                id="content" 
                                name="content" 
                                rows="12" 
                                class="w-full bg-gray-900/50 text-gray-100 p-4 focus:outline-none placeholder-gray-500"
                                placeholder="Describe your question in detail..."
                            >{{ old('content', $question->content) }}</textarea>
                        </div>
                        @error('content')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview -->
                    <div>
                        <label class="text-sm font-medium text-gray-300 mb-2 block">Preview</label>
                        <div id="preview" class="bg-gray-900/50 rounded-lg p-4 prose prose-invert max-w-none min-h-[100px]">
                            <p class="text-gray-500">Your content preview will appear here...</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6">
                        <!-- Delete Button -->
                        <form action="" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                onclick="return confirm('Are you sure you want to delete this question?')"
                                class="px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-all focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                <i class="fas fa-trash-alt mr-2"></i>
                                Delete Question
                            </button>
                        </form>

                        <!-- Save/Cancel Buttons -->
                        <div class="flex items-center space-x-4">
                            <button 
                                type="button"
                                onclick="window.location.href=''"
                                class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-all focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-all focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800 inline-flex items-center"
                            >
                                <i class="fas fa-save mr-2"></i>
                                Save Changes
                            </button>
                        </div>
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
    button.classList.toggle('bg-gray-800');
    button.classList.toggle('text-gray-300');
    button.classList.toggle('border-gray-600');
    
    if (selectedTags.has(tag)) {
        selectedTags.delete(tag);
    } else {
        selectedTags.add(tag);
    }
    
    document.getElementById('selectedTags').value = Array.from(selectedTags).join(',');
}

// Editor Functions
function insertFormat(prefix, suffix) {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const before = text.substring(0, start);
    const selection = text.substring(start, end);
    const after = text.substring(end);

    textarea.value = before + prefix + selection + suffix + after;
    textarea.focus();
    updatePreview();
    
    if (selection) {
        textarea.setSelectionRange(start + prefix.length, end + prefix.length);
    } else {
        textarea.setSelectionRange(start + prefix.length, start + prefix.length);
    }
}

// Preview Update with Markdown Support
function updatePreview() {
    const content = document.getElementById('content').value;
    const preview = document.getElementById('preview');
    
    // Basic Markdown parsing
    let html = content
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.*?)\*/g, '<em>$1</em>')
        .replace(/\n/g, '<br>')
        .replace(/```([\s\S]*?)```/g, '<pre><code>$1</code></pre>')
        .replace(/`([^`]+)`/g, '<code>$1</code>')
        .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" class="text-blue-400 hover:underline">$1</a>');

    preview.innerHTML = html || '<p class="text-gray-500">Your content preview will appear here...</p>';
}

// Initialize preview on load
document.addEventListener('DOMContentLoaded', updatePreview);
document.getElementById('content').addEventListener('input', updatePreview);
</script>
@endsection