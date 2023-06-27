<?php

use App\Models\Client;
use App\Models\Facture;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Facture::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Client::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("type_paiement")->nullable();
            $table->double("payer")->nullable();
            $table->double("reste")->nullable();
            $table->date("date_paiement")->nullable();
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
        Schema::dropIfExists('facture_paiements');
    }
}
