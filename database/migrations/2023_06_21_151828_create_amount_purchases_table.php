<?php

use App\Models\WeekAmount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmountPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amount_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WeekAmount::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("title")->nullable();
            $table->string("jour")->nullable();
            $table->date("date_purchase")->nullable();
            $table->double("montant")->nullable();
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
        Schema::dropIfExists('amount_purchases');
    }
}
