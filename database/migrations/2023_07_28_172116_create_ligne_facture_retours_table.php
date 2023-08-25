<?php

use App\Models\Facture;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneFactureRetoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_facture_retours', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Facture::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("reference")->nullable();
            $table->integer("total_qte")->nullable();
            $table->integer("total_QteActuel")->nullable();
            $table->double("montant_actuel")->nullable();
            $table->double("montant_ht")->nullable();
            $table->double("montant_ttc")->nullable();
            $table->date("date_retour")->nullable();
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
        Schema::dropIfExists('ligne_facture_retours');
    }
}
