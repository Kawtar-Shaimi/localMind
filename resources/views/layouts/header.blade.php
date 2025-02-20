<header class="bg-white shadow-md" x-data="{ mobileMenuOpen: false }">
    <nav class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="/logo.svg" alt="Logo" class="h-10 w-auto">
                    <span class="text-2xl font-bold text-primary">MonApp</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary transition duration-300">Accueil</a>
                <a href="{{ route('services') }}" class="text-gray-600 hover:text-primary transition duration-300">Services</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-primary transition duration-300">Contact</a>
            </div>

            <!-- User Info & Menu -->
            <div class="hidden md:flex items-center space-x-4">
                <span class="text-gray-600">
                    <i class="far fa-clock mr-2"></i>
                    <span id="current-datetime">2025-02-20 20:54:20</span>
                </span>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-primary focus:outline-none">
                        <i class="far fa-user-circle text-xl"></i>
                        <span>Kawtar-Shaimi</span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-lg shadow-xl">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-user-cog mr-2"></i>Profile
                        </a>
                        <a href="{{ route('settings') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-cog mr-2"></i>Paramètres
                        </a>
                        <hr class="my-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden focus:outline-none">
                <i class="fas fa-bars text-2xl text-gray-600"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden mt-4">
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary">Accueil</a>
                <a href="{{ route('services') }}" class="text-gray-600 hover:text-primary">Services</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-primary">Contact</a>
            </nav>
        </div>
    </nav>
</header>

<script>
    function updateDateTime() {
        const now = new Date();
        const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
        document.getElementById('current-datetime').textContent = formatted;
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>