<?php

use App\Models\Client;
use App\Models\Entreprise;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Entreprise::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('num_facture')->unique()->nullable();
            $table->string('statut')->nullable();
            $table->double('prix_ht')->nullable();
            $table->double('prix_ttc')->nullable();
            $table->double('taux_tva')->nullable();
            $table->double('remise')->nullable();
            $table->string('etat_paiement')->nullable();
            $table->date('date')->nullable();
            $table->double('payer')->nullable();
            $table->double('reste')->nullable();
            $table->string("retour")->nullable();
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
        Schema::dropIfExists('factures');
    }
}
