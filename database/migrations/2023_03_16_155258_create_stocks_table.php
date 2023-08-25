<?php

use App\Models\Produit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Produit::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("num")->nullable()->unique();
            $table->integer("entre")->nullable();
            $table->integer("sortie")->nullable();
            $table->integer("reste")->nullable();
            $table->date("date_stock")->nullable();
            $table->integer("min")->nullable();
            $table->integer("initial")->nullable();
            $table->integer("reserverValider")->nullable();
            $table->integer("reserverAttente")->nullable();
            $table->integer("reserverRetour")->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
