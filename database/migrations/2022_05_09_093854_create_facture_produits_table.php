<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_produits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facture_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('designation')->nullable();
            $table->integer('quantite')->default(1);
            $table->double('prix_unitaire')->nullable();
            $table->double('remise')->nullable();
            $table->double('montant')->nullable();
            $table->foreign('facture_id')->references('id')->on('factures')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('facture_produits');
    }
}
