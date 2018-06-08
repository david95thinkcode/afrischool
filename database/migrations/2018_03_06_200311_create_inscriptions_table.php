<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->double('montant_scolarite')->nullable();
            $table->double('montant_verse')->nullable();
            $table->double('reste')->nullable();
            $table->boolean('est_solder');
            $table->date('date_inscription')->nullable();
            $table->unsignedInteger('eleve_id');
            $table->foreign('eleve_id')
                    ->references('id')
                    ->on('eleves')
                    ->onDelete('cascade');
                  
            $table->unsignedInteger('classe_id');
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
        Schema::dropIfExists('inscriptions');
    }
}
