<footer class="bg-gray-800 text-white">
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="mb-8 md:mb-0">
                <h3 class="text-lg font-semibold mb-4">À propos de nous</h3>
                <p class="text-gray-400">
                    Votre partenaire de confiance depuis 2025. Innovation et excellence au service de votre réussite.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition duration-300">Accueil</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition duration-300">Services</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition duration-300">À propos</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
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

            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                <form class="space-y-4">
                    <div>
                        <input type="email" placeholder="Votre email" 
                            class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" 
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        S'abonner
                    </button>
                </div>
            </form>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                © 2025 MonApp. Tous droits réservés.
            </p>
            <div class="mt-4 md:mt-0 flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</footer>