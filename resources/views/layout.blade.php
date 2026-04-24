<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="min-h-screen flex flex-col">
        {{-- Header / Navigation --}}
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Logo / Brand --}}
                    <div class="flex-shrink-0">
                        <a href="{{ url('/users') }}" class="text-xl font-bold text-gray-800 hover:text-gray-600 transition">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    {{-- Desktop Navigation Links --}}
                    <div class="hidden md:flex space-x-8">
                        <a href="#" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Home</a>
                        <a href="#" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">About</a>
                        <a href="#" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Services</a>
                        <a href="#" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Contact</a>
                    </div>

                    {{-- Right side buttons / Auth --}}
                    <div class="flex items-center space-x-4">
                        @auth
                            <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800">Logout</button>
                            </form>
                        @else
                            <a href="#" class="text-sm text-gray-600 hover:text-gray-900">Login</a>
                            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">Register</a>
                        @endauth
                    </div>

                    {{-- Mobile menu button --}}
                    <div class="md:hidden">
                        <button type="button" id="mobile-menu-button" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Mobile Navigation (hidden by default) --}}
                <div id="mobile-menu" class="md:hidden hidden pb-4 space-y-1">
                    <a href="#" class="block text-gray-600 hover:text-gray-900 px-3 py-2 text-base font-medium">Home</a>
                    <a href="#" class="block text-gray-600 hover:text-gray-900 px-3 py-2 text-base font-medium">About</a>
                    <a href="#" class="block text-gray-600 hover:text-gray-900 px-3 py-2 text-base font-medium">Services</a>
                    <a href="#" class="block text-gray-600 hover:text-gray-900 px-3 py-2 text-base font-medium">Contact</a>
                </div>
            </nav>
        </header>

        {{-- Page Header / Hero Section (Optional) --}}
        @hasSection('page-header')
            <section class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    @yield('page-header')
                </div>
            </section>
        @endif

        {{-- Main Content --}}
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                {{-- Flash Messages / Alerts --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                        <p class="font-medium">Success!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                        <p class="font-medium">Error!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                {{-- Page Content --}}
                @yield('content')
            </div>
        </main>

        {{-- Footer --}}
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    {{-- About Section --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase">About</h3>
                        <p class="mt-4 text-sm text-gray-500">
                            {{ config('app.name') }} - Building amazing web applications with Laravel & Tailwind CSS.
                        </p>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase">Quick Links</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900">Features</a></li>
                            <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900">Pricing</a></li>
                            <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900">FAQ</a></li>
                        </ul>
                    </div>

                    {{-- Resources --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase">Resources</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900">Documentation</a></li>
                            <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900">Support</a></li>
                            <li><a href="#" class="text-sm text-gray-500 hover:text-gray-900">Privacy Policy</a></li>
                        </ul>
                    </div>

                    {{-- Social / Newsletter --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase">Follow Us</h3>
                        <div class="mt-4 flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">GitHub</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                        <div class="mt-4">
                            <p class="text-xs text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    {{-- Simple Mobile Menu Toggle Script --}}
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    {{-- Additional Page Scripts --}}
    @stack('scripts')
</body>
</html>
