<header class="bg-gray-800 text-white shadow-md" x-data="{ mobileMenuOpen: false }">
    <nav class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="/logo.svg" alt="Logo" class="h-10 w-auto">
                    <span class="text-2xl font-bold text-white">MonApp</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-white hover:text-gray-300 transition duration-300">Accueil</a>
                <a href="{{ route('services') }}" class="text-white hover:text-gray-300 transition duration-300">Services</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-gray-300 transition duration-300">Contact</a>
            </div>

            <!-- User Info & Menu -->
            <div class="hidden md:flex items-center space-x-6">
                <span class="text-white flex items-center">
                    <i class="far fa-clock mr-2"></i>
                    <span id="current-datetime" class="font-mono">2025-02-21 08:22:30</span>
                </span>
                <div class="border-l border-gray-600 h-6"></div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-white hover:text-gray-300 focus:outline-none">
                        <i class="far fa-user-circle text-xl"></i>
                        <span>Kawtar-Shaimi</span>
                        <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div x-show="open" 
                         @click.away="open = false" 
                         class="absolute right-0 w-48 mt-2 py-2 bg-gray-700 rounded-lg shadow-xl">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-white hover:bg-gray-600">
                            <i class="fas fa-user-cog mr-2"></i>Profile
                        </a>
                        <a href="{{ route('settings') }}" class="block px-4 py-2 text-white hover:bg-gray-600">
                            <i class="fas fa-cog mr-2"></i>Paramètres
                        </a>
                        <hr class="my-2 border-gray-600">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-gray-600 hover:text-red-300">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden focus:outline-none">
                <i class="fas fa-bars text-2xl text-white"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-cloak 
             class="md:hidden mt-4">
            <nav class="flex flex-col space-y-4 bg-gray-700 rounded-lg p-4">
                <a href="{{ route('home') }}" class="text-white hover:text-gray-300">Accueil</a>
                <a href="{{ route('services') }}" class="text-white hover:text-gray-300">Services</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-gray-300">Contact</a>
                <hr class="border-gray-600">
                <div class="flex items-center text-white">
                    <i class="far fa-clock mr-2"></i>
                    <span id="mobile-datetime" class="font-mono">2025-02-21 08:22:30</span>
                </div>
                <div class="pt-2">
                    <span class="flex items-center text-white">
                        <i class="far fa-user-circle mr-2"></i>
                        Kawtar-Shaimi
                    </span>
                </div>
            </nav>
        </div>
    </nav>
</header>

<script>
    function updateDateTime() {
        const now = new Date();
        const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
        document.getElementById('current-datetime').textContent = formatted;
        if (document.getElementById('mobile-datetime')) {
            document.getElementById('mobile-datetime').textContent = formatted;
        }
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>