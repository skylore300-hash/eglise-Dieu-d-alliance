<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Membre - {{ $membre['nom'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header avec retour -->
        <div class="mb-6">
            <a href="{{ route('membres.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à la liste
            </a>
            <h1 class="text-3xl font-bold text-blue-900">Détails du Membre</h1>
        </div>

        <!-- Carte principale -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Section Profil -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-8 text-white">
                <div class="flex items-start gap-6">
                    <div class="{{ $membre['color'] }} w-24 h-24 rounded-full flex items-center justify-center text-white text-3xl font-bold flex-shrink-0 shadow-lg">
                        {{ $membre['initiales'] }}
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold mb-3">{{ $membre['nom'] }}</h2>
                        <div class="flex flex-wrap items-center gap-2">
                            @if($membre['statut'] === 'Actif')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                    Actif
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium">
                                    Inactif
                                </span>
                            @endif
                            
                            @if($membre['baptise'])
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.025 1.632.647 2.24.626.613 1.471.918 2.171.918s1.545-.305 2.171-.918c.622-.608.897-1.46.647-2.24L9 10.274v3.051a2.537 2.537 0 01-2 0v-3.051zm0-5.274A1 1 0 016 6v1.323l3.954 1.582 1.599-.8a1 1 0 11.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0110 18a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 11.894-1.788l1.599.799L6 7.323V6a1 1 0 01-1-1z"/>
                                    </svg>
                                    Baptisé
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Informations -->
            <div class="p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Informations personnelles</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Email</p>
                            <p class="text-gray-900">{{ $membre['email'] }}</p>
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Téléphone</p>
                            <p class="text-gray-900">{{ $membre['telephone'] }}</p>
                        </div>
                    </div>

                    <!-- Ministère -->
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Ministère</p>
                            <p class="text-gray-900">{{ $membre['ministere'] }}</p>
                        </div>
                    </div>

                    <!-- Date d'adhésion -->
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Date d'adhésion</p>
                            <p class="text-gray-900">{{ $membre['date_adhesion'] }}</p>
                        </div>
                    </div>

                    <!-- Date de naissance -->
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Date de naissance</p>
                            <p class="text-gray-900">{{ $membre['date_naissance'] ?? 'Non renseigné' }}</p>
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div class="flex items-start gap-3 md:col-span-2">
                        <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Adresse</p>
                            <p class="text-gray-900">{{ $membre['adresse'] ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="px-8 pb-8 flex gap-3">
                <a 
                    href="{{ route('membres.index') }}"
                    class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-center"
                >
                    Retour
                </a>
                <button 
                    onclick="window.location.href='{{ route('membres.index') }}'"
                    class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </button>
            </div>
        </div>
    </div>
</body>
</html>
