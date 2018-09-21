<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cla_intitule');
            $table->string('cla_description')->nullable();
            $table->integer('mt_scolarite')->default(0)->comments('Montant de la scolarité');
            $table->boolean('estPrimaire')->default(false);
            $table->boolean('estCollege')->default(false);
            $table->boolean('estUniversite')->default(false);
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
        Schema::dropIfExists('classes');
    }
}
