<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseigner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coefficient')->nullable();

            $table->unsignedInteger('classe_id');
            $table->foreign('classe_id')
                ->references('id')
                ->on('classes')
                ->onDelete('cascade');

            $table->unsignedInteger('matiere_id');
            $table->foreign('matiere_id')
                ->references('id')
                ->on('matieres')
                ->onDelete('cascade');

            $table->unsignedInteger('professeur_id')->nullable();
            $table->foreign('professeur_id')
                ->references('id')
                ->on('professeurs')
                ->onDelete('cascade');

            $table->unsignedInteger('annee_scolaire_id')->nullable();
            $table->foreign('annee_scolaire_id')
                ->references('id')
                ->on('annees_scolaires')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseigner');
    }
}
