@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
    <!-- Info Bar -->
    <div class="fixed top-0 right-0 m-4 bg-gray-800/80 backdrop-blur rounded-lg p-3 hidden md:flex items-center space-x-4 z-50 border border-gray-700">
        <span class="text-gray-300 flex items-center">
            <i class="far fa-clock mr-2"></i>
            <span id="current-datetime" class="font-mono">2025-02-23 22:57:06</span>
        </span>
        <div class="border-l border-gray-700 h-6"></div>
        <span class="text-gray-300 flex items-center">
            <i class="far fa-user-circle mr-2"></i>
            <span>Kawtar-Shaimi</span>
        </span>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-24 pb-12">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Favorite Questions</h1>
                <p class="text-gray-400">Your saved questions for quick access</p>
            </div>
            <a href="" 
               class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded-lg flex items-center transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Questions
            </a>
        </div>

        <!-- Filters and Search -->
        <div class="bg-gray-800/50 rounded-xl border border-gray-700/50 p-4 mb-8">
            <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
                <!-- Search -->
                <div class="relative w-full md:w-96">
                    <input 
                        type="search" 
                        placeholder="Search in favorites..." 
                        class="w-full bg-gray-900/50 text-gray-300 border border-gray-700 rounded-lg py-2 px-4 pl-10 focus:outline-none focus:border-gray-600"
                    >
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>

                <!-- Sort Options -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-400">Sort by:</span>
                    <select class="bg-gray-900/50 text-gray-300 border border-gray-700 rounded-lg py-2 px-4 focus:outline-none focus:border-gray-600">
                        <option value="recent">Recently Added</option>
                        <option value="oldest">Oldest First</option>
                        <option value="mostLiked">Most Liked</option>
                        <option value="mostAnswered">Most Answered</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Favorites List -->
        <div class="space-y-4">
            @for($i = 0; $i < 5; $i++)
            <div class="bg-gray-800/50 rounded-xl border border-gray-700/50 p-6 hover:border-gray-600 transition-all duration-200">
                <div class="flex justify-between">
                    <!-- Question Content -->
                    <div class="flex-1">
                        <!-- Tags -->
                        <div class="flex gap-2 mb-3">
                            <span class="px-3 py-1 bg-gray-900/50 text-gray-300 text-sm rounded-lg border border-gray-700">Laravel</span>
                            <span class="px-3 py-1 bg-gray-900/50 text-gray-300 text-sm rounded-lg border border-gray-700">PHP</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-gray-100 mb-2 hover:text-gray-300 transition-colors">
                            <a href="#">How to implement authentication with Laravel Breeze?</a>
                        </h3>

                        <!-- Preview -->
                        <p class="text-gray-400 mb-4">
                            I'm trying to understand how to set up authentication in my Laravel application using Breeze...
                        </p>

                        <!-- Meta Info -->
                        <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm">
                            <span class="text-gray-500 flex items-center">
                                <i class="far fa-clock mr-2"></i>
                                2 hours ago
                            </span>
                            <span class="text-gray-500 flex items-center">
                                <i class="far fa-heart mr-2"></i>
                                42 likes
                            </span>
                            <span class="text-gray-500 flex items-center">
                                <i class="far fa-comment mr-2"></i>
                                5 replies
                            </span>
                            <span class="text-gray-500 flex items-center">
                                <i class="far fa-eye mr-2"></i>
                                156 views
                            </span>
                            <span class="text-gray-500 flex items-center">
                                <i class="far fa-bookmark mr-2"></i>
                                Saved {{ $i + 1 }} days ago
                            </span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="ml-6 flex flex-col space-y-2">
                        <button class="p-2 text-red-400 hover:bg-red-400/10 rounded-lg transition-all" title="Remove from favorites">
                            <i class="fas fa-heart"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:bg-gray-700 rounded-lg transition-all" title="Share">
                            <i class="fas fa-share"></i>
                        </button>
                    </div>
                </div>

                <!-- Author Info -->
                <div class="mt-4 pt-4 border-t border-gray-700 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=6B7280&color=fff" 
                             class="w-8 h-8 rounded-full" 
                             alt="User avatar">
                        <div>
                            <span class="text-gray-300">John Doe</span>
                            <span class="text-gray-500 text-sm ml-2">Author</span>
                        </div>
                    </div>
                    <a href="#" class="text-gray-400 hover:text-gray-300 transition-colors">
                        View Question <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endfor

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg hover:bg-gray-700 transition-colors">
                        Previous
                    </button>
                    <button class="px-4 py-2 bg-gray-600 text-white rounded-lg">1</button>
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg hover:bg-gray-700 transition-colors">2</button>
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg hover:bg-gray-700 transition-colors">3</button>
                    <button class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg hover:bg-gray-700 transition-colors">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State (when no favorites) -->
        <div class="hidden bg-gray-800/50 rounded-xl border border-gray-700/50 p-12 text-center">
            <div class="flex flex-col items-center">
                <i class="far fa-heart text-5xl text-gray-500 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">No Favorite Questions Yet</h3>
                <p class="text-gray-400 mb-6">Start saving questions you find interesting for quick access later</p>
                <a href="" class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded-lg inline-flex items-center transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>
                    Browse Questions
                </a>
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

// Remove from favorites
document.querySelectorAll('.fa-heart').forEach(button => {
    button.closest('button').addEventListener('click', function() {
        if(confirm('Remove this question from favorites?')) {
            this.closest('.bg-gray-800\\/50').remove();
        }
    });
});
</script>
@endsection