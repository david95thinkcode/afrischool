<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('raison_sociale');
            $table->string('directeur')->nullabe();
            $table->string('tel', 20);
            $table->string('email')->nullable();
            
            $table->unsignedInteger('adresse_id')->nullable();
            $table->foreign('adresse_id')
                    ->references('id')
                    ->on('adresses')
                    ->onDelete('cascade');
            
            $table->unsignedInteger('categorie_ets_id')->nullable();
            $table->foreign('categorie_ets_id')
                    ->references('id')
                    ->on('categorie_ets')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('etablissements');
    }
}
