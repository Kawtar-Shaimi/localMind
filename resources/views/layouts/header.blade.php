<!-- Main Navigation -->
<header class="fixed top-0 left-0 right-0 z-50 bg-gray-900/80 backdrop-blur-sm border-b border-gray-800/60">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Primary Nav -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="" class="text-gray-100 font-bold text-xl">
                    Forum<span class="text-purple-400">App</span>
                </a>

                <!-- Primary Navigation -->
                <nav class="hidden md:flex items-center space-x-1">
                    <a href="" 
                       class="px-4 py-2 text-gray-300 hover:text-white rounded-lg hover:bg-gray-700/50 transition-colors ">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                    <a href="" 
                       class="px-4 py-2 text-gray-300 hover:text-white rounded-lg hover:bg-gray-700/50 transition-colors ">
                        <i class="far fa-heart mr-2"></i>
                        Favorites
                    </a>
                    <a href="#" 
                       class="px-4 py-2 text-gray-300 hover:text-white rounded-lg hover:bg-gray-700/50 transition-colors">
                        <i class="far fa-chart-bar mr-2"></i>
                        Statistics
                    </a>
                </nav>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                <!-- UTC Time -->
                <div class="hidden lg:flex items-center px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                    <i class="far fa-clock mr-2 text-gray-400"></i>
                    <span id="current-datetime" class="font-mono text-gray-300">2025-02-23 23:04:49</span>
                </div>

                <!-- Post Question Button -->
                <a href="" 
                   class="hidden md:flex items-center px-4 py-2 bg-purple-500/10 text-purple-400 rounded-lg hover:bg-purple-500/20 transition-all">
                    <i class="fas fa-plus mr-2"></i>
                    Post Question
                </a>

                <!-- User Menu -->
                <div class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open"
                        class="flex items-center space-x-3 px-4 py-2 bg-gray-800/50 rounded-lg hover:bg-gray-700/50 transition-colors border border-gray-700/50"
                    >
                        <img 
                            src="https://ui-avatars.com/api/?name=Kawtar+Shaimi&background=6B7280&color=fff" 
                            alt="Kawtar-Shaimi"
                            class="w-6 h-6 rounded-full"
                        >
                        <span class="text-gray-300">Kawtar-Shaimi</span>
                        <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div 
                        x-show="open" 
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg border border-gray-700/50 py-1"
                    >
                        <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700/50 transition-colors">
                            <i class="fas fa-user mr-2"></i>
                            Profile
                        </a>
                        <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700/50 transition-colors">
                            <i class="fas fa-cog mr-2"></i>
                            Settings
                        </a>
                        <div class="border-t border-gray-700 my-1"></div>
                        <form method="POST" action="" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-gray-700/50 transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button 
                    class="md:hidden p-2 text-gray-400 hover:text-white hover:bg-gray-700/50 rounded-lg transition-colors"
                    @click="mobileMenu = !mobileMenu"
                >
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div 
        x-show="mobileMenu"
        class="md:hidden border-t border-gray-800/60"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
    >
        <nav class="px-4 py-2 space-y-1">
            <a href="" class="block px-4 py-2 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors ">
                <i class="fas fa-home mr-2"></i>
                Home
            </a>
            <a href="" class="block px-4 py-2 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors ">
                <i class="far fa-heart mr-2"></i>
                Favorites
            </a>
            <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700/50 rounded-lg transition-colors">
                <i class="far fa-chart-bar mr-2"></i>
                Statistics
            </a>
            <a href="" class="block px-4 py-2 text-purple-400 hover:bg-purple-500/10 rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Post Question
            </a>
        </nav>
    </div>
</header>

<script>
// DateTime Update
function updateDateTime() {
    const now = new Date();
    const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
    document.getElementById('current-datetime').textContent = formatted;
}
updateDateTime();
setInterval(updateDateTime, 1000);
</script>