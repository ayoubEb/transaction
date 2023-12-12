<?php

use App\Models\Fournisseur;
use App\Models\LigneAchat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatPaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achat_paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LigneAchat::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Fournisseur::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("type_paiement")->nullable();
            $table->double("payer")->nullable();
            $table->double("reste")->nullable();
            $table->date("date_paiement")->nullable();
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
        Schema::dropIfExists('achat_paiements');
    }
}
