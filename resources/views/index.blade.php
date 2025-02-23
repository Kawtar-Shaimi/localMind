@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
    <!-- Info Bar -->
    <div class="fixed top-0 right-0 m-4 bg-gray-800/80 backdrop-blur rounded-lg p-3 hidden md:flex items-center space-x-4 z-50 border border-gray-700">
        <span class="text-gray-300 flex items-center">
            <i class="far fa-clock mr-2"></i>
            <span id="current-datetime" class="font-mono">2025-02-23 21:45:23</span>
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
            <h1 class="text-4xl font-bold text-gray-100 mb-4">Questions Forum</h1>
            <p class="text-gray-400">Explore and share knowledge</p>
        </div>

        <!-- Actions Bar -->
        <div class="mb-8 flex justify-between items-center">
            <div class="relative w-96">
                <input 
                    type="search" 
                    placeholder="Search..." 
                    class="w-full bg-gray-800 text-gray-300 border border-gray-700 rounded-lg py-2 px-4 pl-10 focus:outline-none focus:border-gray-600"
                >
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
            </div>

            <button class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded-lg flex items-center transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Add Question
            </button>
        </div>

        <!-- Questions List -->
        <div class="space-y-4">
            <!-- Question Card -->
            @for($i = 0; $i < 5; $i++)
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 hover:border-gray-600 transition-colors duration-200">
                <div class="flex justify-between">
                    <!-- Left Content -->
                    <div class="flex-1">
                        <!-- Tags -->
                        <div class="flex gap-2 mb-3">
                            <span class="px-3 py-1 bg-gray-700 text-gray-300 text-sm rounded-full">Laravel</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-300 text-sm rounded-full">PHP</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-gray-200 mb-2">
                            How to implement authentication with Laravel Breeze?
                        </h3>

                        <!-- Preview -->
                        <p class="text-gray-400 mb-4">
                            I'm trying to understand how to set up authentication in my Laravel application using Breeze...
                        </p>

                        <!-- Meta -->
                        <div class="flex items-center text-sm space-x-6">
                            <span class="text-gray-500 flex items-center">
                                <i class="far fa-clock mr-2"></i>
                            </span>
                            <button class="text-gray-500 flex items-center hover:text-red-400 transition-colors">
                                <i class="far fa-heart mr-2"></i>
                                <span>42 likes</span>
                            </button>
                            <button class="text-gray-500 flex items-center hover:text-blue-400 transition-colors" onclick="toggleReply(this)">
                                <i class="far fa-comment mr-2"></i>
                                <span>5 replies</span>
                            </button>
                            <span class="text-gray-500 flex items-center">
                                <i class="far fa-eye mr-2"></i>
                            </span>
                            <button class="text-gray-500 flex items-center hover:text-red-500 transition-colors" onclick="deleteQuestion(this)">
                                <i class="far fa-trash-alt mr-2"></i>
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Right Content - Author -->
                    <div class="flex items-center gap-2 ml-4">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=6B7280&color=fff" 
                             class="w-6 h-6 rounded-full" 
                             alt="User avatar">
                        <span class="text-gray-400">John Doe</span>
                    </div>
                </div>

                <!-- Reply Form (Hidden by default) -->
                <div class="hidden mt-4 pt-4 border-t border-gray-700">
                    <textarea 
                        placeholder="Write your reply..." 
                        class="w-full bg-gray-700 text-gray-300 border border-gray-600 rounded-lg p-3 focus:outline-none focus:border-gray-500"
                        rows="3"
                    ></textarea>
                    <div class="flex justify-end space-x-2 mt-2">
                        <button class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors" onclick="cancelReply(this)">
                            Cancel
                        </button>
                        <button class="px-4 py-2 bg-gray-600 text-gray-200 rounded-lg hover:bg-gray-500 transition-colors">
                            Submit Reply
                        </button>
                    </div>
                </div>
            </div>
            @endfor

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded hover:bg-gray-700 transition-colors">
                        Previous
                    </button>
                    <button class="px-4 py-2 bg-gray-700 text-gray-200 rounded">1</button>
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded hover:bg-gray-700 transition-colors">2</button>
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded hover:bg-gray-700 transition-colors">3</button>
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded hover:bg-gray-700 transition-colors">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateDateTime() {
    const now = new Date();
    const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
    document.getElementById('current-datetime').textContent = formatted;
}
updateDateTime();
setInterval(updateDateTime, 1000);

// Toggle like
document.querySelectorAll('.fa-heart').forEach(icon => {
    icon.parentElement.addEventListener('click', function() {
        const heartIcon = this.querySelector('.fa-heart');
        heartIcon.classList.toggle('far');
        heartIcon.classList.toggle('fas');
        this.classList.toggle('text-red-400');
    });
});

// Toggle reply form
function toggleReply(button) {
    const questionCard = button.closest('.bg-gray-800');
    const replyForm = questionCard.querySelector('.hidden');
    replyForm.classList.toggle('hidden');
}

// Cancel reply
function cancelReply(button) {
    const replyForm = button.closest('.hidden');
    replyForm.querySelector('textarea').value = '';
    replyForm.classList.add('hidden');
}

// Delete question
function deleteQuestion(button) {
    if(confirm('Are you sure you want to delete this question?')) {
        button.closest('.bg-gray-800').remove();
    }
}
</script>
@endsection