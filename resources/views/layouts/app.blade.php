<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#3b82f6',
                    }
                }
            }
        }
    </script>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary">
                        <img src="/logo.png" alt="Logo" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-primary transition duration-300">Accueil</a>
                    <a href="/services" class="text-gray-600 hover:text-primary transition duration-300">Services</a>
                    <a href="/contact" class="text-gray-600 hover:text-primary transition duration-300">Contact</a>
                </div>

                <!-- User Menu with DateTime -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 hidden md:inline-flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        <span id="current-datetime">2025-02-20 16:23:21</span>
                    </span>
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-primary focus:outline-none">
                            <i class="far fa-user-circle text-xl"></i>
                            <span>Kawtar-Shaimi</span>
                        </button>
                        <div class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-lg shadow-xl hidden group-hover:block">
                            <a href="/profile" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-user-cog mr-2"></i>Profile
                            </a>
                            <a href="/settings" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i>Paramètres
                            </a>
                            <hr class="my-2">
                            <a href="/logout" class="block px-4 py-2 text-red-600 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden focus:outline-none" id="mobile-menu-button">
                    <i class="fas fa-bars text-2xl text-gray-600"></i>
                </button>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="mb-8 md:mb-0">
                    <h3 class="text-lg font-semibold mb-4">À propos de nous</h3>
                    <p class="text-gray-400">
                        Votre entreprise de confiance depuis 2025. Nous nous engageons à fournir les meilleurs services à nos clients.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white transition duration-300">Accueil</a></li>
                        <li><a href="/services" class="text-gray-400 hover:text-white transition duration-300">Services</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-white transition duration-300">À propos</a></li>
                        <li><a href="/contact" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            123 Rue Example, Ville, Pays
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-phone mr-2"></i>
                            +1 234 567 890
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-envelope mr-2"></i>
                            contact@example.com
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Suivez-nous</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © 2025 Votre Entreprise. Tous droits réservés.
                </p>
                <div class="mt-4 md:mt-0">
                    <ul class="flex space-x-4 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu -->
    <div class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-50" id="mobile-menu">
        <div class="bg-white h-full w-64 shadow-lg p-6">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-primary">Menu</h3>
                <button class="focus:outline-none" id="close-mobile-menu">
                    <i class="fas fa-times text-2xl text-gray-600"></i>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="/" class="block text-gray-600 hover:text-primary transition duration-300">Accueil</a>
                <a href="/services" class="block text-gray-600 hover:text-primary transition duration-300">Services</a>
                <a href="/contact" class="block text-gray-600 hover:text-primary transition duration-300">Contact</a>
            </nav>
        </div>
    </div>

    <!-- JavaScript for DateTime and Mobile Menu -->
    <script>
        // Update DateTime
        function updateDateTime() {
            const now = new Date();
            const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
            document.getElementById('current-datetime').textContent = formatted;
        }
        
        // Update immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Mobile Menu Functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
        });

        closeMobileMenu.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    </script>
</body>
</html>