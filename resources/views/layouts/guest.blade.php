<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100  dark:bg-gradient-to-br from-blue-600 via-blue-900 to-blue-650">
            
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <div class="w-20 h-20 bg-white rounded-xl flex items-center justify-center shadow-lg">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Église" class="w-14 h-14 object-contain">
      </div>
    </div>

    <!-- Titre -->
    <h1 class="text-2xl font-bold mb-1">Système de Gestion d'Église</h1>
    <p class="text-blue-200 mb-8">
      Connectez-vous pour accéder à votre espace
    </p>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
