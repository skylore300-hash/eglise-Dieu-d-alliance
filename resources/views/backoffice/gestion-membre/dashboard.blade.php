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
                    <div class="membre-row grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition"
                        data-name="{{ $membre['nom'] }}" data-email="{{ $membre['email'] }}"
                        data-status="{{ $membre['statut'] }}">
                        <!-- Nom -->
                        <div class="col-span-3 flex items-center gap-3">
                            <div
                                class="{{ $membre['color'] }} w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ $membre['initiales'] }}</div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $membre['nom'] }}</p>
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
                                @if ($membre['ministere'] === 'Louange') bg-blue-100 text-blue-700
                                @elseif($membre['ministere'] === 'Intercession') bg-purple-100 text-purple-700
                                @elseif($membre['ministere'] === 'Jeunesse') bg-green-100 text-green-700
                                @elseif($membre['ministere'] === 'Enseignement') bg-orange-100 text-orange-700 @endif">
                                {{ $membre['ministere'] }}
                            </span>
                        </div>

                        <!-- Date d'Adhésion -->
                        <div class="col-span-2">
                            <p class="text-gray-900 text-sm">{{ $membre['date_adhesion'] }}</p>
                        </div>

                        <!-- Statut -->
                        <div class="col-span-1">
                            <span
                                class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                                @if ($membre['statut'] === 'Actif') bg-green-100 text-green-700 @else bg-gray-100 text-gray-700 @endif">
                                {{ $membre['statut'] }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="col-span-1 flex items-center justify-center gap-2">
                            <a href="{{ route('membres.show', $membre['id']) }}"
                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Voir">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
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
@endsection
