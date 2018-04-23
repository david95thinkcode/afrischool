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
            $table->integer('not_note');

            $table->unsignedInteger('evaluation_id')->nullable();
            $table->foreign('evaluation_id')
                    ->references('id')
                    ->on('evaluations')
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
