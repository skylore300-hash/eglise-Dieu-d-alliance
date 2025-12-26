<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembreController extends Controller
{
    /**
     * Afficher la liste des membres
     */
    public function index()
    {
        $membres = $this->membresData();

        // Calcul des statistiques affichées dans la vue
        $total = count($membres);
        $actifs = collect($membres)->where('statut', 'Actif')->count();
        $baptises = collect($membres)->where('baptise', true)->count();
        $currentYear = now()->year;
        $nouveaux = collect($membres)->filter(function ($m) use ($currentYear) {
            if (empty($m['date_adhesion'])) {
                return false;
            }
            $parts = explode('/', $m['date_adhesion']);
            $year = end($parts);
            return (int) $year === (int) $currentYear;
        })->count();

        $stats = [
            'total' => $total,
            'actifs' => $actifs,
            'baptises' => $baptises,
            'nouveaux' => $nouveaux,
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

        return view('backoffice.gestion-membre.membres.create', compact('ministeres'));
    }

    /**
     * Afficher les détails d'un membre
     */
    public function show($id)
    {

        $membres = $this->membresData();

        // Trouver le membre par ID
        $membre = collect($membres)->firstWhere('id', (int)$id);

        if (!$membre) {
            abort(404, 'Membre non trouvé');
        }

        return view('backoffice.gestion-membre.show', compact('membre'));
    }

    /**
     * Aperçu du dashboard : retourne quelques membres récents
     */
    public function dashboard()
    {
        $membres = $this->membresData();
        // prendre les 3 premiers comme aperçu
        $previewMembres = array_slice($membres, 0, 3);
        // Calcul des statistiques affichées dans la vue
        $total = count($membres);
        $actifs = collect($membres)->where('statut', 'Actif')->count();
        $baptises = collect($membres)->where('baptise', true)->count();
        $currentYear = now()->year;
        $nouveaux = collect($membres)->filter(function ($m) use ($currentYear) {
            if (empty($m['date_adhesion'])) {
                return false;
            }
            $parts = explode('/', $m['date_adhesion']);
            $year = end($parts);
            return (int) $year === (int) $currentYear;
        })->count();

        $stats = [
            'total' => $total,
            'actifs' => $actifs,
            'baptises' => $baptises,
            'nouveaux' => $nouveaux,
        ];


        return view('backoffice.gestion-membre.dashboard', compact('previewMembres', 'stats'));
    }

    /**
     * Données fictives centralisées pour les membres
     */
    protected function membresData()
    {
        return [
            [
                'id' => 1,
                'nom' => 'Kaluba Sierra',
                'email' => 'mustafabinamin@jiad.com',
                'telephone' => '+242 06 1234 5678',
                'ministere' => 'Louange',
                'date_adhesion' => '15/01/2020',
                'date_naissance' => '15/03/1985',
                'statut' => 'Actif',
                'baptise' => true,
                'initiales' => 'KS',
                'color' => 'bg-blue-600',
                'adresse' => '12 Rue de la Paix, 75001 Paris'
            ],
            [
                'id' => 2,
                'nom' => 'Keran Koskunoblu',
                'email' => 'woobie@woobie.com',
                'telephone' => '+243 06 8765 4321',
                'ministere' => 'Intercession',
                'date_adhesion' => '20/06/2019',
                'date_naissance' => '22/08/1990',
                'statut' => 'Actif',
                'baptise' => true,
                'initiales' => 'KK',
                'color' => 'bg-purple-600',
                'adresse' => '45 Avenue des Champs, 75008 Paris'
            ],
            [
                'id' => 3,
                'nom' => 'Buddah',
                'email' => 'Buddah@god.com',
                'telephone' => '+243 06 1122 3344',
                'ministere' => 'Jeunesse',
                'date_adhesion' => '10/03/2021',
                'date_naissance' => '05/12/1995',
                'statut' => 'Actif',
                'baptise' => true,
                'initiales' => 'B',
                'color' => 'bg-pink-600',
                'adresse' => '78 Boulevard Saint-Michel, 75006 Paris'
            ],
            [
                'id' => 4,
                'nom' => 'Scpice',
                'email' => 'ice@scpice.com',
                'telephone' => '+243 06 4433 2211',
                'ministere' => 'Enseignement',
                'date_adhesion' => '05/11/2018',
                'date_naissance' => '18/07/1988',
                'statut' => 'Inactif',
                'baptise' => true,
                'initiales' => 'S',
                'color' => 'bg-red-600',
                'adresse' => '23 Rue de Rivoli, 75004 Paris'
            ],
            [
                'id' => 5,
                'nom' => 'Latto',
                'email' => 'latto@oppai.com',
                'telephone' => '+243 06 5566 7788',
                'ministere' => 'Louange',
                'date_adhesion' => '12/09/2022',
                'date_naissance' => '30/01/1992',
                'statut' => 'Actif',
                'baptise' => true,
                'initiales' => 'L',
                'color' => 'bg-orange-600',
                'adresse' => '56 Rue de la République, 69002 Lyon'
            ],
        ];
    }
}
