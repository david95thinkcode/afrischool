<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiplomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dip_intitule');
            $table->string('dip_ecole');
            $table->string('dip_specialite');
            $table->string('dip_niveau')->nullable();
            $table->date('dip_date_obtention')->nullable();

            $table->unsignedInteger('professeur_id');
            $table->foreign('professeur_id')
                  ->references('id')
                  ->on('professeurs')
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
        Schema::dropIfExists('diplomes');
    }
}
