<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... head content reste le même ... -->
</head>
<body class="bg-gray-900 font-sans antialiased">
    <div class="min-h-screen flex flex-col" x-data="{ mobileMenu: false }">
        @include('layouts.header')
        
        <!-- Page Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')

        <!-- Toast Notifications -->
        <div 
            x-data="{ show: false, message: '', type: 'success' }"
            @notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            class="fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg border"
            :class="{
                'bg-green-500/10 border-green-500/20 text-green-400': type === 'success',
                'bg-red-500/10 border-red-500/20 text-red-400': type === 'error',
                'bg-blue-500/10 border-blue-500/20 text-blue-400': type === 'info'
            }"
        >
            <div class="flex items-center space-x-3">
                <template x-if="type === 'success'">
                    <i class="fas fa-check-circle"></i>
                </template>
                <template x-if="type === 'error'">
                    <i class="fas fa-exclamation-circle"></i>
                </template>
                <template x-if="type === 'info'">
                    <i class="fas fa-info-circle"></i>
                </template>
                <span x-text="message"></span>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Initialize UTC time update
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Global notification function
        window.notify = function(message, type = 'success') {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: { message, type }
            }));
        };
    </script>

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>
</html>