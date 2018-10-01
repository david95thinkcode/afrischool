<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementScolaritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_scolarites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('montant')->comments('Montant payé');
            $table->unsignedInteger('inscription_id');
            $table->unsignedTinyInteger('tranche_scolarite_id');
            $table->unsignedInteger('user_id')->comments("Utilisateur ayant enregistré l'opération");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('inscription_id')
                ->references('id')
                ->on('inscriptions')
                ->onDelete('cascade');

            $table->foreign('tranche_scolarite_id')
                ->references('id')
                ->on('tranche_scolarites')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('paiement_scolarites');
    }
}
