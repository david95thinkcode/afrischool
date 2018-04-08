<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnneesScolairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annees_scolaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('an_description'); // Ex: 2012-2013
            $table->date('an_date_debut')->nullablel();
            $table->date('an_date_fin')->nullablel();
            $table->boolean('an_ouverte')->default(false);
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
        Schema::dropIfExists('annees_scolaires');
    }
}
