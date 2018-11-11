<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professeurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prof_nom');
            $table->string('prof_prenoms');
            $table->string('prof_sexe');
            $table->string('prof_tel');
            $table->string('prof_email')->nullable();
            $table->date('prof_date_naissance')->nullable();
            $table->string('prof_nationalite')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professeurs');
    }
}
