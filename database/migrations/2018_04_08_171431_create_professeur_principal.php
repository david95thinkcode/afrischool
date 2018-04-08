<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesseurPrincipal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professeur_principal', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('professeur_id')->nullable();
            $table->foreign('professeur_id')
                    ->references('id')
                    ->on('professeurs')
                    ->onDelete('cascade');
            
            $table->unsignedInteger('classe_id')->nullable();
            $table->foreign('classe_id')
                    ->references('id')
                    ->on('classes')
                    ->onDelete('cascade');
            
            $table->unsignedInteger('annee_scolaire_id')->nullable();
            $table->foreign('annee_scolaire_id')
                    ->references('id')
                    ->on('annees_scolaires')
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
        Schema::dropIfExists('professeur_principal');
    }
}
