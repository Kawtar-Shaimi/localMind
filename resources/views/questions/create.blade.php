@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
    <!-- Info Bar -->
    <div class="fixed top-0 right-0 m-4 bg-gray-800/80 backdrop-blur rounded-lg p-3 hidden md:flex items-center space-x-4 z-50 border border-gray-700">
        <span class="text-gray-300 flex items-center">
            <i class="far fa-clock mr-2"></i>
            <span id="current-datetime" class="font-mono">2025-02-23 21:52:40</span>
        </span>
        <div class="border-l border-gray-700 h-6"></div>
        <span class="text-gray-300 flex items-center">
            <i class="far fa-user-circle mr-2"></i>
            <span>Kawtar-Shaimi</span>
        </span>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-24 pb-12">
        <!-- Title -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-100 mb-4">Create New Question</h1>
            <p class="text-gray-400">Share your question with the community</p>
        </div>

        <!-- Question Form -->
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-gray-300 mb-2">Question Title</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        class="w-full bg-gray-800 text-gray-300 border border-gray-700 rounded-lg py-3 px-4 focus:outline-none focus:border-gray-600"
                        placeholder="What's your question about?"
                        required
                    >
                </div>

                <!-- Tags Section -->
                <div>
                    <label class="block text-gray-300 mb-2">Tags</label>
                    <div class="flex flex-wrap gap-2 mb-3">
                        <button type="button" class="px-3 py-1 bg-gray-700 text-gray-300 text-sm rounded-full hover:bg-gray-600 transition-colors">
                            Laravel
                        </button>
                        <button type="button" class="px-3 py-1 bg-gray-700 text-gray-300 text-sm rounded-full hover:bg-gray-600 transition-colors">
                            PHP
                        </button>
                        <button type="button" class="px-3 py-1 bg-gray-700 text-gray-300 text-sm rounded-full hover:bg-gray-600 transition-colors">
                            JavaScript
                        </button>
                        <button type="button" class="px-3 py-1 bg-gray-700 text-gray-300 text-sm rounded-full hover:bg-gray-600 transition-colors">
                            + Add Tag
                        </button>
                    </div>
                    <!-- Hidden Tags Input -->
                    <input type="hidden" name="tags" id="tags" value="">
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-gray-300 mb-2">Question Details</label>
                    <div class="border border-gray-700 rounded-lg overflow-hidden">
                        <!-- Toolbar -->
                        <div class="bg-gray-800 border-b border-gray-700 p-2 flex gap-2">
                            <button type="button" class="p-2 text-gray-400 hover:text-gray-200 transition-colors">
                                <i class="fas fa-bold"></i>
                            </button>
                            <button type="button" class="p-2 text-gray-400 hover:text-gray-200 transition-colors">
                                <i class="fas fa-italic"></i>
                            </button>
                            <button type="button" class="p-2 text-gray-400 hover:text-gray-200 transition-colors">
                                <i class="fas fa-list"></i>
                            </button>
                            <button type="button" class="p-2 text-gray-400 hover:text-gray-200 transition-colors">
                                <i class="fas fa-link"></i>
                            </button>
                            <button type="button" class="p-2 text-gray-400 hover:text-gray-200 transition-colors">
                                <i class="fas fa-code"></i>
                            </button>
                        </div>
                        <!-- Editor -->
                        <textarea 
                            id="content" 
                            name="content" 
                            rows="12"
                            class="w-full bg-gray-800 text-gray-300 p-4 focus:outline-none"
                            placeholder="Describe your question in detail..."
                            required
                        ></textarea>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-gray-300 font-semibold mb-4">Preview</h3>
                    <div id="preview" class="prose prose-invert">
                        <!-- Preview content will be inserted here -->
                        <p class="text-gray-400">Your question preview will appear here...</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('questions.index') }}" 
                       class="px-6 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-gray-200 rounded-lg flex items-center transition-colors duration-200">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Post Question
                    </button>
                </div>
            </form>
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
let selectedTags = [];

document.querySelectorAll('button[type="button"]').forEach(button => {
    if (button.textContent.trim() !== '+ Add Tag') {
        button.addEventListener('click', function() {
            this.classList.toggle('bg-gray-600');
            const tag = this.textContent.trim();
            if (selectedTags.includes(tag)) {
                selectedTags = selectedTags.filter(t => t !== tag);
            } else {
                selectedTags.push(tag);
            }
            document.getElementById('tags').value = selectedTags.join(',');
        });
    }
});

// Preview Update
const contentTextarea = document.getElementById('content');
const preview = document.getElementById('preview');

contentTextarea.addEventListener('input', function() {
    // Here you could add markdown parsing if needed
    preview.innerHTML = `<p class="text-gray-400">${this.value}</p>`;
});

// Toolbar Buttons
document.querySelectorAll('.fa-bold, .fa-italic, .fa-list, .fa-link, .fa-code').forEach(button => {
    button.parentElement.addEventListener('click', function() {
        const command = this.querySelector('i').className.split('-')[1];
        let syntax = '';
        
        switch(command) {
            case 'bold':
                syntax = '**text**';
                break;
            case 'italic':
                syntax = '*text*';
                break;
            case 'list':
                syntax = '\n- item\n- item\n- item\n';
                break;
            case 'link':
                syntax = '[text](url)';
                break;
            case 'code':
                syntax = '```\ncode\n```';
                break;
        }
        
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        textarea.value = textarea.value.slice(0, start) + syntax + textarea.value.slice(textarea.selectionEnd);
        textarea.focus();
        textarea.setSelectionRange(start + syntax.indexOf('text'), start + syntax.indexOf('text') + 4);
    });
});
</script>
@endsection