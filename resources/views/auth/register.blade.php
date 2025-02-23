@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Login Form Card -->
    <div class="max-w-md w-full space-y-8 bg-white/10 backdrop-blur-md p-8 rounded-xl shadow-2xl transform transition duration-500 hover:scale-105 relative z-10">
        <!-- Form Header -->
        <div class="text-center">
            <h2 class="mt-6 text-4xl font-extrabold text-white tracking-tight">
                Bienvenue
            </h2>
            <p class="mt-2 text-sm text-white/80">
                Connectez-vous à votre compte
            </p>
        </div>

        <!-- Login Form -->
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="rounded-md -space-y-px">
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-white mb-1">
                        Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="far fa-envelope text-white/60"></i>
                        </div>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            required
                            class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                            placeholder="Entrez votre name"
                        >
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-white mb-1">
                        Adresse email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="far fa-envelope text-white/60"></i>
                        </div>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                            placeholder="Entrez votre email"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-white mb-1">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-white/60"></i>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                            placeholder="Entrez votre mot de passe"
                        >
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="block text-sm font-medium text-white mb-1">
                        Confirme Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-white/60"></i>
                        </div>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                            placeholder="Entrez votre mot de passe"
                        >
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-purple-500 focus:ring-purple-500 border-white/10 rounded cursor-pointer bg-white/20"
                    >
                    <label for="remember" class="ml-2 block text-sm text-white">
                        Se souvenir de moi
                    </label>
                </div>
            </div>

            <!-- Login Button -->
            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform transition duration-300 hover:scale-[1.02] hover:shadow-lg"
                >
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt text-purple-200 group-hover:text-white transition-colors duration-300"></i>
                    </span>
                    Inscrit
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-4">
            <p class="text-sm text-white/80">
                Vous n'avez pas de compte?
                <a href="{{ route('loginView') }}" class="font-medium text-purple-300 hover:text-white transition duration-300">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
