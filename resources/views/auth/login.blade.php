<x-guest-layout>
    <!-- Animated Background and Info Bar -->
    <div class="fixed inset-0 z-0">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <!-- User Info Bar -->
    <div class="fixed top-0 right-0 m-4 bg-white/10 backdrop-blur-md rounded-lg shadow-lg p-3 hidden md:flex items-center space-x-4 z-10">
        <span class="text-white flex items-center">
            <i class="far fa-clock mr-2"></i>
            <span id="current-datetime" class="font-mono">2025-02-21 15:48:49</span>
        </span>
        <div class="border-l border-white/20 h-6"></div>
        <span class="text-white flex items-center">
            <i class="far fa-user-circle mr-2"></i>
            <span>Kawtar-Shaimi</span>
        </span>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-md space-y-8 bg-white/10 backdrop-blur-md p-8 rounded-xl shadow-2xl transform transition duration-500 hover:scale-105 relative z-10">
        <!-- Form Header -->
        <div class="text-center">
            <h2 class="mt-6 text-4xl font-extrabold text-white tracking-tight">
                Bienvenue
            </h2>
            <p class="mt-2 text-sm text-white/80">
                Connectez-vous à votre compte
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="mb-5">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="far fa-envelope text-white/60"></i>
                    </div>
                    <x-text-input 
                        id="email" 
                        class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="Entrez votre email"
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <!-- Password -->
            <div class="mb-5">
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-white/60"></i>
                    </div>
                    <x-text-input 
                        id="password" 
                        class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password"
                        placeholder="Entrez votre mot de passe"
                    />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        name="remember"
                        class="h-4 w-4 text-purple-500 focus:ring-purple-500 border-white/10 rounded cursor-pointer bg-white/20"
                    >
                    <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-sm text-purple-300 hover:text-white transition duration-300" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform transition duration-300 hover:scale-[1.02] hover:shadow-lg">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt text-purple-200 group-hover:text-white transition-colors duration-300"></i>
                    </span>
                    {{ __('Log in') }}
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-4">
                <p class="text-sm text-white/80">
                    {{ __("Don't have an account?") }}
                    <a href="{{ route('register') }}" class="font-medium text-purple-300 hover:text-white transition duration-300">
                        {{ __('Register') }}
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Animation Styles -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <!-- DateTime Update Script -->
    <script>
        function updateDateTime() {
            const now = new Date();
            const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
            document.getElementById('current-datetime').textContent = formatted;
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</x-guest-layout>