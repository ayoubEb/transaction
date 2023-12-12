<?php

use App\Models\Entreprise;
use App\Models\Fournisseur;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_achats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fournisseur::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Entreprise::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('num_achat')->unique()->nullable();
            $table->string('statut')->nullable();
            $table->double('prix_ht')->nullable();
            $table->double('prix_ttc')->nullable();
            $table->integer('taux_tva')->nullable();
            $table->string('etat_paiement')->nullable();
            $table->string('etat_livraison')->nullable();
            $table->integer('nombre_achats')->nullable();
            $table->date('date')->nullable();
            $table->double('payer')->nullable();
            $table->double('reste')->nullable();
            $table->datetime("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_achats');
    }
}
