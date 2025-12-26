@extends('layouts.gestion-membre')

@section('title', 'Dashboard - Église Dieu d\'Alliance')

@section('content')
    {{-- En-tête avec Fil d'Ariane --}}
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
    {{-- Aperçu rapide des membres  --}}
    @isset($previewMembres)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gray-50 border-b border-gray-200">
                <div class="grid grid-cols-12 gap-4 px-6 py-4 text-sm font-semibold text-gray-600 uppercase">
                    <div class="col-span-3">Nom</div>
                    <div class="col-span-3">Contact</div>
                    <div class="col-span-2">Ministère</div>
                    <div class="col-span-2">Date d'Adhésion</div>
                    <div class="col-span-1">Statut</div>
                    <div class="col-span-1 text-center">Actions</div>
                </div>
            </div>

            <!-- Table Body -->
            <div class="divide-y divide-gray-200">
                @foreach ($previewMembres as $membre)
                    @php
                        $initiales = strtoupper(substr($membre->nom_complet, 0, 2));
                        $colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500', 'bg-yellow-500', 'bg-indigo-500', 'bg-pink-500'];
                        $color = $colors[$membre->id % count($colors)];
                    @endphp
                    <div class="membre-row grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition"
                        data-name="{{ $membre->nom_complet }}" data-email="{{ $membre->email }}"
                        data-status="{{ $membre->statut }}">
                        <!-- Nom -->
                        <div class="col-span-3 flex items-center gap-3">
                            <div
                                class="{{ $color }} w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ $initiales }}</div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $membre->nom_complet }}</p>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="col-span-3">
                            <p class="text-gray-900 text-sm">{{ $membre->email }}</p>
                            <p class="text-gray-500 text-sm mt-1">{{ $membre->telephone }}</p>
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
                                @if ($membre->statut === 'actif') bg-green-100 text-green-700 @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($membre->statut) }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="col-span-1 flex items-center justify-center gap-2">
                            <button onclick='openViewModal(@json($membre))'
                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Voir">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-4 text-right">
                <a href="{{ route('backoffice.membres-list') }}" class="text-sm text-indigo-600 hover:underline">Voir la liste
                    complète</a>
            </div>
        </div>
    @endisset

    <!-- Modal Voir Membre -->
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
                    <button type="button" onclick="closeViewModal()"
                        class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentMembre = null;

        function openViewModal(membre) {
            currentMembre = membre;

            // Remplir les informations
            document.getElementById('view-nom').textContent = membre.nom_complet || membre.nom || '';
            document.getElementById('view-email').textContent = membre.email || '';
            document.getElementById('view-telephone').textContent = membre.telephone || '';
            document.getElementById('view-ministere').textContent = membre.ministere || 'Non spécifié';
            document.getElementById('view-date-adhesion').textContent = membre.created_at ? new Date(membre.created_at).toLocaleDateString('fr-FR') : 'Non spécifié';
            document.getElementById('view-date-naissance').textContent = membre.date_naissance ? new Date(membre.date_naissance).toLocaleDateString('fr-FR') : 'Non spécifié';
            document.getElementById('view-adresse').textContent = membre.adresse || 'Non spécifié';

            // Avatar
            const avatar = document.getElementById('view-avatar');
            const initiales = membre.initiales || (membre.nom_complet || membre.nom || '?').substring(0, 2).toUpperCase();
            avatar.textContent = initiales;
            avatar.className = `w-20 h-20 rounded-full flex items-center justify-center text-white text-2xl font-bold flex-shrink-0 ${membre.color || 'bg-blue-500'}`;

            // Badge statut
            const statutBadge = document.getElementById('view-statut-badge');
            if (membre.statut === 'actif' || membre.statut === 'Actif') {
                statutBadge.textContent = 'Actif';
                statutBadge.className = 'px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium';
            } else {
                statutBadge.textContent = 'Inactif';
                statutBadge.className = 'px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium';
            }

            // Badge baptisé
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

        // Fermer le modal en cliquant en dehors
        document.getElementById('modal-voir-membre').addEventListener('click', function(e) {
            if (e.target === this) {
                closeViewModal();
            }
        });

        // Fermer avec la touche Échap
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeViewModal();
            }
        });
    </script>
@endsection
