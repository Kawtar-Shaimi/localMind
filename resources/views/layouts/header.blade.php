<div class="fixed top-0 right-0 m-4 bg-gray-800/80 backdrop-blur rounded-lg p-3 hidden md:flex items-center space-x-4 z-50 border border-gray-700">
    <span class="text-gray-300 flex items-center justify-around gap-4">
        <a href="{{ route('home') }}" class="font-mono hover:underline cursor-pointer">Home</a>
        <a href="{{ route('questions.userQuestion') }}" class="font-mono hover:underline cursor-pointer">My Question</a>
        <a href="{{ route('favorites.index') }}" class="font-mono hover:underline cursor-pointer">Favorites</a>
    </span>
    <div class="border-l border-gray-700 h-6"></div>
    <span class="text-gray-300 flex items-center">
        <span>{{ auth()->user()->name }}</span>
    </span>
    <div class="border-l border-gray-700 h-6"></div>
    <span class="text-gray-300 flex items-center">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="font-mono hover:underline cursor-pointer">Logout</button>
        </form>
    </span>
</div>