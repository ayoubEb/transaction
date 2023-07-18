<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableWeekAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('week_amounts', function (Blueprint $table) {
            $table->double("montant_autre")->nullable();
            $table->string("file_autre")->nullable();
            $table->text("remarque")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('week_amount', function (Blueprint $table) {
            // $table->dropColumn("deleted_at");
        });
    }
}
