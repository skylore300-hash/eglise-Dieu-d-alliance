<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Membre extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'membres';

    /**
     * Attributs modifiables en masse.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'uuid',
        'nom_complet',
        'email',
        'telephone',
        'date_naissance',
        'ministere',
        'statut',
        'adresse',
        'baptise',
        'mot_de_passe',
        'role',
    ];

    /**
     * Attributs à cacher lors de la sérialisation.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    /**
     * Castings d'attributs.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'date_naissance' => 'date',
        'baptise' => 'boolean',
    ];

    /**
     * Retourne le mot de passe utilisé pour l'authentification.
     * Nécessaire car la colonne se nomme `mot_de_passe`.
     *
     * @return string|null
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

}
