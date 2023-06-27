<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->string('image')->nullable();
            $table->string('reference')->unique()->nullable();
            $table->string('designation')->nullable();
            $table->string('description')->nullable();
            $table->double('prix_vente')->nullable();
            $table->double('prix_achat')->nullable();
            $table->double('prix_unitaire')->nullable();
            $table->integer('quantite')->default(1);
            $table->foreign('categorie_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('produits');
    }
}
