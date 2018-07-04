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
            $table->boolean('estPrimaire')->default(false);
            $table->boolean('estCollege')->default(false);
            $table->boolean('estUniversite')->default(false);
            $table->unsignedInteger('niveau_id')->nullable();
            $table->foreign('niveau_id')
                    ->references('id')
                    ->on('niveaux')
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
        Schema::dropIfExists('classes');
    }
}
