<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Backoffice - Église')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-50 text-gray-900 antialiased" x-data="{ mobileMenuOpen: false }">
    <div class="min-h-screen flex overflow-hidden">

        {{-- Overlay pour mobile (fond sombre) --}}
        <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-40 md:hidden" x-cloak>
        </div>

        {{-- Sidebar --}}
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-gray-200 flex flex-col shadow-xl transition-transform duration-300 ease-in-out md:static md:translate-x-0 md:flex md:shadow-sm">

            {{-- Logo / Brand --}}
            <div class="p-6 flex flex-col gap-1 relative">
                {{-- Bouton fermer (Mobile uniquement) --}}
                <button @click="mobileMenuOpen = false"
                    class="md:hidden absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xs shadow-lg shadow-indigo-200">
                        LOGO
                    </div>
                    <h1 class="text-lg font-bold tracking-tight text-gray-900 leading-tight">Gestion membres</h1>
                </div>
                <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mt-2">Église Dieu d'Alliance
                </p>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-4 overflow-y-auto font-medium">
                <ul class="space-y-1.5">
                    <li>
                        <a href="{{ url('/backoffice/gestion-membre/dashboard') }}"
                            class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('*dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-100' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="text-sm">Tableau de bord</span>
                        </a>
                    </li>

                    <li class="pt-6 pb-2 px-3">
                        <span class="text-[11px] font-bold uppercase tracking-[0.15em] text-gray-400">Communauté</span>
                    </li>

                    <li>
                        <a href="{{ url('/backoffice/gestion-membre/membres-list') }}"
                            class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->is('*liste') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-100' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-600' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="text-sm">Liste des membres</span>
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Footer Sidebar --}}
            <div class="p-4 border-t border-gray-100">
                <button
                    class="w-full flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Déconnexion
                </button>
            </div>
        </aside>

        {{-- Contenu principal --}}
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">

            {{-- Header --}}
            <header
                class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-30 flex items-center justify-between px-4 md:px-8">
                <div class="flex items-center gap-4">
                    {{-- Bouton hamburger --}}
                    <button @click="mobileMenuOpen = true"
                        class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition shadow-sm border border-gray-200">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="h-6 w-px bg-gray-200 mx-2 hidden md:block"></div>
                    <span class="text-sm font-medium text-gray-500 hidden sm:inline">
                        @yield('breadcrumb', 'Application') / <span class="text-gray-900 font-bold">@yield('page_title', 'Dashboard')</span>
                    </span>
                </div>

                <div class="flex items-center gap-4 sm:gap-6">
                    {{-- Notifications --}}
                    <button class="relative p-2 text-gray-400 hover:text-indigo-600 transition">
                        <span
                            class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-3 pl-4 sm:pl-6 border-l border-gray-100">
                        <div class="text-right hidden lg:block">
                            <p class="text-xs font-bold text-gray-900 uppercase">Administrateur</p>
                            <p class="text-[10px] text-green-600 font-bold uppercase tracking-tighter">En ligne</p>
                        </div>
                        <div
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-blue-500 flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                            <span class="font-bold text-xs sm:text-sm">AD</span>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Slot de page --}}
            <main class="p-4 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
