<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     * @return void
     */
    public function up(): void
    {
        Schema::create('membres', function (Blueprint $table) {
            // Identifiant auto-incrémenté
            $table->id();

            // UUID lisible et unique
            $table->uuid('uuid')->unique();

            // Informations personnelles
            $table->string('nom_complet');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->date('date_naissance')->nullable();

            // Ministère et statut
            $table->string('ministere')->nullable()->index();
            $table->enum('statut', ['actif', 'inactif'])->default('actif');

            // Adresse et état de bapteme(je sais pas pourquoi c'est ici d'ailleurs)
            $table->text('adresse')->nullable();
            $table->boolean('baptise')->default(false);

            // Authentification
            $table->string('mot_de_passe')->nullable();
            $table->enum('role', ['superadmin', 'admin', 'pasteur', 'secretaire', 'membre'])
                ->default('membre')
                ->index();


            $table->rememberToken();


            $table->softDeletes();
            $table->timestamps();


            $table->index('telephone');
        });
    }

    /**
     * Annule les migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
