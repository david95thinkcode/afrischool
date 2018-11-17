<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbattementFamillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abattement_familles', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('enfants')->comments("Nombre d'enfants");
            $table->increments('taux')->comments('Taux sur 100');
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
        Schema::dropIfExists('abattement_familles');
    }
}
