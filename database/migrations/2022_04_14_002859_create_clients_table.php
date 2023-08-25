<?php

use App\Models\Group;
use App\Models\TypeClient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Group::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('raison_sociale')->nullable();
            $table->string('responsable')->nullable();
            $table->string('adresse')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('ville')->nullable();
            $table->string("ice",16)->nullable();
            $table->string("if",16)->nullable();
            $table->string("rc",16)->nullable();
            $table->string('telephone')->nullable();
            $table->integer('code_postal')->nullable();
            $table->string('activite')->nullable();
            $table->foreignIdFor(TypeClient::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('clients');
    }
}
