<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrimestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimestres', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tri_numero')->nullable();
            $table->date('tri_debut')->nullable();
            $table->date('tri_fin')->nullable();
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
        Schema::dropIfExists('trimestres');
    }
}
