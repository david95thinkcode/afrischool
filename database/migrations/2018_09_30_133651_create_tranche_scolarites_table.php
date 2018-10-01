<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrancheScolaritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranche_scolarites', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->string('description');
            $table->tinyInteger('mois_debut')->comments('Numéro du mois représentant le début de la période de paiement de la tranche');
            $table->tinyInteger('mois_fin')->comments('Numéro du mois représentant la fin de la période de paiement de la tranche');
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
        Schema::dropIfExists('tranche_scolarites');
    }
}
