<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->double('not_note')->default(0);

            $table->unsignedInteger('types_evaluation_id')->nullable();
            $table->foreign('types_evaluation_id')
                    ->references('id')
                    ->on('types_evaluation')
                    ->onDelete('cascade');

            $table->unsignedInteger('trimestre_id')->nullable();
            $table->foreign('trimestre_id')
                    ->references('id')
                    ->on('trimestres')
                    ->onDelete('cascade');

            $table->unsignedInteger('classe_id')->nullable();
            $table->foreign('classe_id')
                    ->references('id')
                    ->on('classes')
                    ->onDelete('cascade');

            $table->unsignedInteger('matiere_id')->nullable();
            $table->foreign('matiere_id')
                    ->references('id')
                    ->on('matieres')
                    ->onDelete('cascade');
            
            $table->unsignedInteger('eleve_id');
            $table->foreign('eleve_id')
                    ->references('id')
                    ->on('eleves')
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
        Schema::dropIfExists('notes');
    }
}
