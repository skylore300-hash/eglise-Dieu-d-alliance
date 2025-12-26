@extends('layouts.gestion-membre')

@section('title', 'Liste des membres - Église Dieu d\'Alliance')

@section('content')
    <div class="min-h-screen p-6">
        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div id="success-message" class="max-w-7xl mx-auto mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div id="error-message" class="max-w-7xl mx-auto mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-blue-900">Gestion des Membres</h1>
                        <p class="text-gray-600 mt-1">Gérez tous les membres de l'église</p>
                    </div>
                </div>
                <button onclick="openModal()"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg flex items-center gap-2 font-medium shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nouveau Membre
                </button>
            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="lg:col-span-2">
                        <input type="text" id="search-membres" placeholder="Rechercher par nom ou email..."
                            class="w-full pl-4 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <select id="filter-status"
                            class="w-full pl-4 pr-10 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white cursor-pointer hover:border-gray-300 transition"
                            style="background-position: right 1rem center;">
                            <option value="all">Tous les statuts</option>
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>
                    <div>
                        <select id="filter-ministere"
                            class="w-full pl-4 pr-10 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white cursor-pointer hover:border-gray-300 transition"
                            style="background-position: right 1rem center;">
                            <option value="all">Tous les ministères</option>
                            <option value="louange">Louange</option>
                            <option value="intercession">Intercession</option>
                            <option value="accueil">Accueil</option>
                            <option value="multimedia">Multimédia</option>
                            <option value="enfants">Enfants</option>
                            <option value="jeunes">Jeunes</option>
                        </select>
                    </div>
                    <div>
                        <select id="filter-baptise"
                            class="w-full pl-4 pr-10 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white cursor-pointer hover:border-gray-300 transition"
                            style="background-position: right 1rem center;">
                            <option value="all">Tous</option>
                            <option value="1">Baptisés</option>
                            <option value="0">Non baptisés</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Total Membres -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Total Membres</p>
                            <p id="total-membres" class="text-4xl font-bold text-blue-900">{{ $stats['total'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Membres Actifs -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Membres Actifs</p>
                            <p class="text-4xl font-bold text-green-600">{{ $stats['actifs'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Baptisés -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Baptisés</p>
                            <p class="text-4xl font-bold text-red-600">{{ $stats['baptises'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Nouveaux -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Nouveaux (2024)</p>
                            <p class="text-4xl font-bold text-purple-600">{{ $stats['nouveaux'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gray-50 border-b border-gray-200">
                    <div class="grid grid-cols-12 gap-4 px-6 py-4 text-sm font-semibold text-gray-600 uppercase">
                        <div class="col-span-2">Nom</div>
                        <div class="col-span-3">Contact</div>
                        <div class="col-span-2">Ministère</div>
                        <div class="col-span-2">Date d'Adhésion</div>
                        <div class="col-span-1">Statut</div>
                        <div class="col-span-2 text-center">Actions</div>
                    </div>
                </div>

                <!-- Table Body -->
                <div class="divide-y divide-gray-200">
                    @foreach ($membres as $membre)
                        @php
                            $initiales = strtoupper(substr($membre->nom_complet, 0, 2));
                            $colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500', 'bg-yellow-500', 'bg-indigo-500', 'bg-pink-500'];
                            $color = $colors[$membre->id % count($colors)];
                        @endphp
                        <div class="membre-row grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition"
                            data-name="{{ $membre->nom_complet }}" data-email="{{ $membre->email }}"
                            data-status="{{ $membre->statut }}" data-ministere="{{ $membre->ministere ?? '' }}"
                            data-baptise="{{ $membre->baptise ? '1' : '0' }}">
                            <!-- Nom -->
                            <div class="col-span-2 flex items-center gap-3">
                                <div
                                    class="{{ $color }} w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                    {{ $initiales }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $membre->nom_complet }}</p>
                                    @if ($membre['baptise'])
                                        <div class="flex items-center gap-1 mt-1">
                                            <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-xs text-blue-600 font-medium">Baptisé</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="col-span-3">
                                <p class="text-gray-900 text-sm">{{ $membre['email'] }}</p>
                                <p class="text-gray-500 text-sm mt-1">{{ $membre['telephone'] }}</p>
                            </div>

                            <!-- Ministère -->
                            <div class="col-span-2">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                                @if ($membre->ministere === 'Louange') bg-blue-100 text-blue-700
                                @elseif($membre->ministere === 'Intercession') bg-purple-100 text-purple-700
                                @elseif($membre->ministere === 'Jeunesse') bg-green-100 text-green-700
                                @elseif($membre->ministere === 'Enseignement') bg-orange-100 text-orange-700 @endif">
                                    {{ $membre->ministere ?? 'N/A' }}
                                </span>
                            </div>

                            <!-- Date d'Adhésion -->
                            <div class="col-span-2">
                                <p class="text-gray-900 text-sm">{{ $membre->created_at ? $membre->created_at->format('d/m/Y') : 'N/A' }}</p>
                            </div>

                            <!-- Statut -->
                            <div class="col-span-1">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                                @if ($membre->statut === 'actif') bg-green-100 text-green-700
                                @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($membre->statut) }}
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="col-span-2 flex items-center justify-center gap-3">
                                <button onclick='openViewModal(@json($membre))'
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button onclick='openEditModal(@json($membre))'
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button onclick='openDeleteModal(@json($membre))'
                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Supprimer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nouveau Membre -->
    <div id="modal-nouveau-membre" class="hidden fixed inset-0 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        style="background-color: rgba(0, 0, 0, 0.15);">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[85vh] overflow-y-auto scrollbar-hide">
            <!-- Form -->
            <form action="{{ route('membres.store') }}" method="POST" class="p-5">
                @csrf
                <!-- Header intégré -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-blue-900">Nouveau Membre</h2>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nom complet -->
                    <div>
                        <label for="nom_complet" class="block text-sm font-medium text-gray-700 mb-1">
                            Nom complet <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nom_complet" name="nom_complet" value="{{ old('nom_complet') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('nom_complet') border-red-500 @enderror"
                            placeholder="Entrez le nom complet">
                        @error('nom_complet')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm @error('email') border-red-500 @enderror"
                            placeholder="exemple@email.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">
                            Téléphone <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="telephone" name="telephone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="+243 06 1234 5678">
                    </div>

                    <!-- Date de naissance -->
                    <div>
                        <label for="date_naissance" class="block text-sm font-medium text-gray-700 mb-1">
                            Date de naissance
                        </label>
                        <input type="date" id="date_naissance" name="date_naissance"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>

                    <!-- Ministère -->
                    <div>
                        <label for="ministere" class="block text-sm font-medium text-gray-700 mb-1">
                            Ministère
                        </label>
                        <select id="ministere" name="ministere"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-sm">
                            <option value="">Sélectionnez un ministère</option>
                            <option value="Louange">Louange</option>
                            <option value="Intercession">Intercession</option>
                            <option value="Jeunesse">Jeunesse</option>
                            <option value="Enseignement">Enseignement</option>
                            <option value="Média">Média</option>
                            <option value="Accueil">Accueil</option>
                        </select>
                    </div>

                    <!-- Statut -->
                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">
                            Statut <span class="text-red-500">*</span>
                        </label>
                        <select id="statut" name="statut" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-sm">
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                            Rôle <span class="text-red-500">*</span>
                        </label>
                        <select id="role" name="role" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-sm">
                            <option value="membre">Membre</option>
                            <option value="secretaire">Secrétaire</option>
                            <option value="pasteur">Pasteur</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="mot_de_passe" class="block text-sm font-medium text-gray-700 mb-1">
                            Mot de passe
                        </label>
                        <input type="password" id="mot_de_passe" name="mot_de_passe"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            placeholder="Laisser vide si non nécessaire">
                    </div>

                    <!-- Adresse -->
                    <div class="md:col-span-2">
                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">
                            Adresse
                        </label>
                        <textarea id="adresse" name="adresse" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                            placeholder="Entrez l'adresse complète"></textarea>
                    </div>

                    <!-- Baptisé -->
                    <div class="md:col-span-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" id="baptise" name="baptise" value="1"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="ml-2 text-sm font-medium text-gray-700">Baptisé</span>
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-4 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeModal()"
                        class="px-6 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition font-medium text-sm">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Modifier Membre -->
    <div id="modal-modifier-membre"
        class="hidden fixed inset-0 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        style="background-color: rgba(0, 0, 0, 0.15);">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[85vh] overflow-y-auto scrollbar-hide">
            <!-- Form -->
            <form id="edit-form" action="" method="POST" class="p-5">
                @csrf
                @method('PUT')
                <!-- Header intégré -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-blue-900">Modifier le Membre</h2>
                    <button type="button" onclick="closeEditModal()"
                        class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nom complet -->
                    <div>
                        <label for="edit-nom" class="block text-sm font-medium text-gray-700 mb-1">
                            Nom complet <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-nom" name="nom_complet" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="edit-email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="edit-email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="edit-telephone" class="block text-sm font-medium text-gray-700 mb-1">
                            Téléphone <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="edit-telephone" name="telephone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>

                    <!-- Date de naissance -->
                    <div>
                        <label for="edit-date_naissance" class="block text-sm font-medium text-gray-700 mb-1">
                            Date de naissance
                        </label>
                        <input type="date" id="edit-date_naissance" name="date_naissance"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    </div>

                    <!-- Ministère -->
                    <div>
                        <label for="edit-ministere" class="block text-sm font-medium text-gray-700 mb-1">
                            Ministère <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-ministere" name="ministere" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-sm">
                            <option value="">Sélectionnez un ministère</option>
                            <option value="Louange">Louange</option>
                            <option value="Intercession">Intercession</option>
                            <option value="Jeunesse">Jeunesse</option>
                            <option value="Enseignement">Enseignement</option>
                            <option value="Média">Média</option>
                            <option value="Accueil">Accueil</option>
                        </select>
                    </div>

                    <!-- Statut -->
                    <div>
                        <label for="edit-statut" class="block text-sm font-medium text-gray-700 mb-1">
                            Statut <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-statut" name="statut" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-sm">
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="edit-role" class="block text-sm font-medium text-gray-700 mb-1">
                            Rôle <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-role" name="role" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-sm">
                            <option value="membre">Membre</option>
                            <option value="secretaire">Secrétaire</option>
                            <option value="pasteur">Pasteur</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                    </div>

                    <!-- Adresse -->
                    <div class="md:col-span-2">
                        <label for="edit-adresse" class="block text-sm font-medium text-gray-700 mb-1">
                            Adresse
                        </label>
                        <textarea id="edit-adresse" name="adresse" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"></textarea>
                    </div>

                    <!-- Baptisé -->
                    <div class="md:col-span-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" id="edit-baptise" name="baptise" value="1"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="ml-2 text-sm font-medium text-gray-700">Baptisé</span>
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-3 mt-5 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()"
                        class="px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition font-medium">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Détails Membre -->
    <div id="modal-voir-membre" class="hidden fixed inset-0 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        style="background-color: rgba(0, 0, 0, 0.15);">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-blue-900">Détails du Membre</h2>
                    <button type="button" onclick="closeViewModal()"
                        class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Profil -->
                <div class="flex items-start gap-6 mb-6">
                    <div id="view-avatar"
                        class="w-20 h-20 rounded-full flex items-center justify-center text-white text-2xl font-bold flex-shrink-0">
                    </div>
                    <div class="flex-1">
                        <h3 id="view-nom" class="text-xl font-bold text-gray-900 mb-2"></h3>
                        <div class="flex items-center gap-2">
                            <span id="view-statut-badge" class="px-3 py-1 rounded-full text-sm font-medium"></span>
                            <span id="view-baptise-badge"
                                class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium hidden">
                                <svg class="w-4 h-4 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.025 1.632.647 2.24.626.613 1.471.918 2.171.918s1.545-.305 2.171-.918c.622-.608.897-1.46.647-2.24L9 10.274v3.051a2.537 2.537 0 01-2 0v-3.051zm0-5.274A1 1 0 016 6v1.323l3.954 1.582 1.599-.8a1 1 0 11.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0110 18a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 11.894-1.788l1.599.799L6 7.323V6a1 1 0 01-1-1z" />
                                </svg>
                                Baptisé
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Informations -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">EMAIL</p>
                        <p id="view-email" class="text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">TÉLÉPHONE</p>
                        <p id="view-telephone" class="text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">MINISTÈRE</p>
                        <p id="view-ministere" class="text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">DATE D'ADHÉSION</p>
                        <p id="view-date-adhesion" class="text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">DATE DE NAISSANCE</p>
                        <p id="view-date-naissance" class="text-gray-900"></p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 mb-1">ADRESSE</p>
                        <p id="view-adresse" class="text-gray-900"></p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="openEditFromView()"
                        class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Modifier
                    </button>
                    <button type="button" onclick="closeViewModal()"
                        class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Supprimer Membre -->
    <div id="modal-supprimer-membre"
        class="hidden fixed inset-0 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        style="background-color: rgba(0, 0, 0, 0.15);">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
            <!-- Icon -->
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <!-- Titre -->
            <h2 class="text-xl font-bold text-gray-900 text-center mb-2">Confirmer la suppression</h2>

            <!-- Message -->
            <p class="text-gray-600 text-center mb-6">
                Êtes-vous sûr de vouloir supprimer <span id="delete-membre-nom"
                    class="font-semibold text-gray-900"></span> ? Cette action est irréversible.
            </p>

            <!-- Form pour la suppression -->
            <form id="delete-form" action="" method="POST">
                @csrf
                @method('DELETE')
                
                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                        Annuler
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                    Supprimer
                </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Ouvrir automatiquement le modal s'il y a des erreurs de validation
        @if($errors->any())
            window.addEventListener('DOMContentLoaded', function() {
                openModal();
            });
        @endif

        function openModal() {
            document.getElementById('modal-nouveau-membre').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modal-nouveau-membre').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openEditModal(membre) {
            // Définir l'action du formulaire
            const form = document.getElementById('edit-form');
            form.action = `/backoffice/gestion-membre/${membre.id}`;
            
            // Remplir le formulaire avec les données du membre
            document.getElementById('edit-nom').value = membre.nom_complet || membre.nom;
            document.getElementById('edit-email').value = membre.email;
            document.getElementById('edit-telephone').value = membre.telephone;
            document.getElementById('edit-date_naissance').value = membre.date_naissance || '';
            document.getElementById('edit-ministere').value = membre.ministere || '';
            document.getElementById('edit-statut').value = membre.statut.toLowerCase();
            document.getElementById('edit-role').value = membre.role || 'membre';
            document.getElementById('edit-adresse').value = membre.adresse || '';
            document.getElementById('edit-baptise').checked = membre.baptise;

            // Afficher le modal
            document.getElementById('modal-modifier-membre').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('modal-modifier-membre').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        let membreToDelete = null;
        let currentMembre = null;

        function openViewModal(membre) {
            console.log('openViewModal appelé avec:', membre);
            currentMembre = membre;

            // Remplir les informations
            document.getElementById('view-nom').textContent = membre.nom_complet || membre.nom || '';
            document.getElementById('view-email').textContent = membre.email || '';
            document.getElementById('view-telephone').textContent = membre.telephone || '';
            document.getElementById('view-ministere').textContent = membre.ministere || 'Non spécifié';
            
            // Formater la date d'adhésion (created_at)
            let dateAdhesion = 'Non spécifié';
            if (membre.created_at) {
                const date = new Date(membre.created_at);
                dateAdhesion = date.toLocaleDateString('fr-FR');
            }
            document.getElementById('view-date-adhesion').textContent = dateAdhesion;
            
            // Formater la date de naissance
            let dateNaissance = 'Non spécifié';
            if (membre.date_naissance) {
                const date = new Date(membre.date_naissance);
                dateNaissance = date.toLocaleDateString('fr-FR');
            }
            document.getElementById('view-date-naissance').textContent = dateNaissance;
            
            document.getElementById('view-adresse').textContent = membre.adresse || 'Non spécifié';

            // Avatar
            const avatar = document.getElementById('view-avatar');
            const initiales = (membre.nom_complet || membre.nom || '?').substring(0, 2).toUpperCase();
            const colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500', 'bg-yellow-500', 'bg-indigo-500', 'bg-pink-500'];
            const color = colors[membre.id % colors.length];
            avatar.className = `w-20 h-20 ${color} rounded-full flex items-center justify-center text-white text-2xl font-bold flex-shrink-0`;
            avatar.textContent = initiales;

            // Statut badge
            const statutBadge = document.getElementById('view-statut-badge');
            if (membre.statut === 'actif' || membre.statut === 'Actif') {
                statutBadge.className = 'px-3 py-1 bg-green-50 text-green-600 rounded-full text-sm font-medium';
                statutBadge.textContent = 'Actif';
            } else {
                statutBadge.className = 'px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium';
                statutBadge.textContent = 'Inactif';
            }

            // Baptisé badge
            const baptiseBadge = document.getElementById('view-baptise-badge');
            if (membre.baptise) {
                baptiseBadge.classList.remove('hidden');
            } else {
                baptiseBadge.classList.add('hidden');
            }

            // Afficher le modal
            document.getElementById('modal-voir-membre').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeViewModal() {
            document.getElementById('modal-voir-membre').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentMembre = null;
        }

        function openEditFromView() {
            console.log('openEditFromView appelé', currentMembre);
            if (currentMembre) {
                const membre = currentMembre; // Sauvegarder avant de fermer le modal
                closeViewModal();
                setTimeout(() => {
                    console.log('Ouverture du modal d\'édition avec:', membre);
                    openEditModal(membre);
                }, 150);
            } else {
                console.error('currentMembre est null ou undefined');
            }
        }

        function openDeleteModal(membre) {
            membreToDelete = membre;
            document.getElementById('delete-membre-nom').textContent = membre.nom_complet || membre.nom;
            
            // Mettre à jour l'action du formulaire de suppression
            const deleteForm = document.getElementById('delete-form');
            if (deleteForm) {
                deleteForm.action = `/backoffice/gestion-membre/${membre.id}`;
            }
            document.getElementById('modal-supprimer-membre').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('modal-supprimer-membre').classList.add('hidden');
            document.body.style.overflow = 'auto';
            membreToDelete = null;
        }

        // La suppression se fait maintenant via la soumission du formulaire delete-form

        // Fermer le modal de création en cliquant en dehors
        document.getElementById('modal-nouveau-membre').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Fermer le modal d'édition en cliquant en dehors
        document.getElementById('modal-modifier-membre').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Fermer le modal de suppression en cliquant en dehors
        document.getElementById('modal-supprimer-membre').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Fermer le modal de visualisation en cliquant en dehors
        document.getElementById('modal-voir-membre').addEventListener('click', function(e) {
            if (e.target === this) {
                closeViewModal();
            }
        });

        // Fonction de filtrage des membres
        function filterMembers() {
            const searchValue = document.getElementById('search-membres').value.toLowerCase();
            const statusValue = document.getElementById('filter-status').value.toLowerCase();
            const ministereValue = document.getElementById('filter-ministere').value.toLowerCase();
            const baptiseValue = document.getElementById('filter-baptise').value;
            const rows = document.querySelectorAll('.membre-row');

            rows.forEach(row => {
                const name = row.getAttribute('data-name').toLowerCase();
                const email = row.getAttribute('data-email').toLowerCase();
                const status = row.getAttribute('data-status').toLowerCase();
                const ministere = row.getAttribute('data-ministere').toLowerCase();
                const baptise = row.getAttribute('data-baptise');

                const matchesSearch = name.includes(searchValue) || email.includes(searchValue);
                const matchesStatus = statusValue === 'all' || status === statusValue;
                const matchesMinistere = ministereValue === 'all' || ministere === ministereValue;
                const matchesBaptise = baptiseValue === 'all' || baptise === baptiseValue;

                if (matchesSearch && matchesStatus && matchesMinistere && matchesBaptise) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Écouter les événements de filtrage
        document.getElementById('search-membres').addEventListener('input', filterMembers);
        document.getElementById('filter-status').addEventListener('change', filterMembers);
        document.getElementById('filter-ministere').addEventListener('change', filterMembers);
        document.getElementById('filter-baptise').addEventListener('change', filterMembers);

        // Fermer avec la touche Échap
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeEditModal();
                closeDeleteModal();
                closeViewModal();
            }
        });

        // Auto-masquer les messages après 5 secondes
        setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            
            if (successMessage) {
                successMessage.style.transition = 'opacity 0.5s';
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 500);
            }
            
            if (errorMessage) {
                errorMessage.style.transition = 'opacity 0.5s';
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.remove(), 500);
            }
        }, 5000);
    </script>
@endsection
