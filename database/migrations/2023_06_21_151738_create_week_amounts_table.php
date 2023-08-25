<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_amounts', function (Blueprint $table) {
            $table->id();
            $table->date("date_debut")->nullable();
            $table->date("date_fin")->nullable();
            $table->double("total_vente")->nullable();
            $table->double("total_achat")->nullable();
            $table->double("montant_amana")->nullable();
            $table->double("montant_ghazala")->nullable();
            $table->double("reste_verser")->nullable();
            $table->double("montant_cheque")->nullable();
            $table->string("file_ghazala")->nullable();
            $table->string("file_amana")->nullable();
            $table->string("file_cheque")->nullable();
            $table->string("file_verse")->nullable();
            $table->double("montant_online")->nullable();
            $table->double("reste_final")->nullable();
            $table->double("reste")->nullable();
            $table->double("montant_autre")->nullable();
            $table->string("file_autre")->nullable();
            $table->text("remarque")->nullable();
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
        Schema::dropIfExists('week_amounts');
    }
}
