<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string("raison_sociale")->nullable();
            $table->string("adresse")->nullable();
            $table->string("ville")->nullable();
            $table->string("rc")->nullable()->unique();
            $table->string("ice")->nullable()->unique();
            $table->integer("code_postal")->nullable();
            $table->string("phone")->nullable();
            $table->string("fix")->nullable();
            $table->string("pays")->nullable();
            $table->string("email")->nullable()->unique();
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
        Schema::dropIfExists('fournisseurs');
    }
}
