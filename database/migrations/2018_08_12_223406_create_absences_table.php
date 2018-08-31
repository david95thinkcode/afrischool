<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('justification')->nullable();
            $table->boolean('estJustifiee')->default(false);
            $table->unsignedInteger('horaire_id')->nullable();
            $table->unsignedInteger('inscription_id')->nullable()->comment("Identifiant de l'élève dans la table inscriptions");
            $table->timestamps();

            $table->foreign('horaire_id')
                ->references('id')
                ->on('horaires')
                ->onDelete('cascade');
            $table->foreign('inscription_id')
                ->references('id')
                ->on('inscriptions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
