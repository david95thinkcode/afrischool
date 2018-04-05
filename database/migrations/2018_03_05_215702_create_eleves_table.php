<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 255);
            $table->string('prenoms', 255);
            $table->string('sexe');
            $table->date('date_naissance');
            
            $table->boolean('ancien')->default(false)->nullable();
            $table->boolean('redoublant')->default(false)->nullable();
            $table->string('ecole_provenance')->nullable();

            $table->string('person_a_contacter_nom');
            $table->string('person_a_contacter_tel');
            $table->string('person_a_contacter_lien');

            $table->unsignedInteger('parent_id');
            $table->foreign('parent_id')
                    ->references('id')
                    ->on('parents')
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
        Schema::dropIfExists('eleves');
    }
}
