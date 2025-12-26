<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MembreController extends Controller
{
    /**
     * Afficher la liste des membres
     */
    public function index()
    {
        $membres = Membre::all();

        // Calcul des statistiques
        $stats = [
            'total' => $membres->count(),
            'actifs' => $membres->where('statut', 'actif')->count(),
            'baptises' => $membres->where('baptise', true)->count(),
            'nouveaux' => Membre::whereYear('created_at', now()->year)->count(),
        ];

        return view('backoffice.gestion-membre.membres-list', compact('membres', 'stats'));
    }

    /**
     * Afficher le formulaire de création d'un nouveau membre
     */
    public function create()
    {
        $ministeres = [
            'Louange',
            'Intercession',
            'Jeunesse',
            'Enseignement',
            'Média',
            'Accueil'
        ];

        return view('backoffice.gestion-membre.create', compact('ministeres'));
    }

    /**
     * Enregistrer un nouveau membre
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:membres,email',
            'telephone' => 'required|string|max:20',
            'date_naissance' => 'nullable|date',
            'ministere' => 'nullable|string|max:100',
            'statut' => 'required|in:actif,inactif',
            'adresse' => 'nullable|string',
            'baptise' => 'boolean',
            'mot_de_passe' => 'nullable|string|min:6',
            'role' => 'required|in:superadmin,admin,pasteur,secretaire,membre',
        ]);

        $validated['uuid'] = (string) Str::uuid();
        $validated['baptise'] = $request->has('baptise');
        
        if (!empty($validated['mot_de_passe'])) {
            $validated['mot_de_passe'] = Hash::make($validated['mot_de_passe']);
        } else {
            unset($validated['mot_de_passe']);
        }

        Membre::create($validated);

        return redirect()->route('backoffice.membres-list')
            ->with('success', 'Membre ajouté avec succès !');
    }

    /**
     * Afficher les détails d'un membre
     */
    public function show($id)
    {
        $membre = Membre::findOrFail($id);
        return view('backoffice.gestion-membre.show', compact('membre'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $membre = Membre::findOrFail($id);
        
        $ministeres = [
            'Louange',
            'Intercession',
            'Jeunesse',
            'Enseignement',
            'Média',
            'Accueil'
        ];

        return view('backoffice.gestion-membre.edit', compact('membre', 'ministeres'));
    }

    /**
     * Mettre à jour un membre
     */
    public function update(Request $request, $id)
    {
        $membre = Membre::findOrFail($id);

        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:membres,email,' . $id,
            'telephone' => 'required|string|max:20',
            'date_naissance' => 'nullable|date',
            'ministere' => 'nullable|string|max:100',
            'statut' => 'required|in:actif,inactif',
            'adresse' => 'nullable|string',
            'baptise' => 'boolean',
            'mot_de_passe' => 'nullable|string|min:6',
            'role' => 'required|in:superadmin,admin,pasteur,secretaire,membre',
        ]);

        $validated['baptise'] = $request->has('baptise');
        
        if (!empty($validated['mot_de_passe'])) {
            $validated['mot_de_passe'] = Hash::make($validated['mot_de_passe']);
        } else {
            unset($validated['mot_de_passe']);
        }

        $membre->update($validated);

        return redirect()->route('backoffice.membres-list')
            ->with('success', 'Membre modifié avec succès !');
    }

    /**
     * Supprimer un membre (soft delete)
     */
    public function destroy($id)
    {
        $membre = Membre::findOrFail($id);
        $membre->delete();

        return redirect()->route('backoffice.membres-list')
            ->with('success', 'Membre supprimé avec succès !');
    }

    /**
     * Aperçu du dashboard : retourne quelques membres récents
     */
    public function dashboard()
    {
        $previewMembres = Membre::latest()->take(3)->get();
        
        $stats = [
            'total' => Membre::count(),
            'actifs' => Membre::where('statut', 'actif')->count(),
            'baptises' => Membre::where('baptise', true)->count(),
            'nouveaux' => Membre::whereYear('created_at', now()->year)->count(),
        ];

        return view('backoffice.gestion-membre.dashboard', compact('previewMembres', 'stats'));
    }
}
