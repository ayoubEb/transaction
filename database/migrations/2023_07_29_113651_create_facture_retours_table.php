<?php


use App\Models\FactureProduit;
use App\Models\LigneFactureRetour;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureRetoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_retours', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LigneFactureRetour::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(FactureProduit::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("qte_retour")->nullable();
            $table->integer("qte_actuel")->nullable();
            $table->double("montant")->nullable();
            $table->double("montant_actuel")->nullable();
            $table->string("paiement_retour")->nullable();
            $table->string("problem")->nullable();
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
        Schema::dropIfExists('facture_retours');
    }
}
