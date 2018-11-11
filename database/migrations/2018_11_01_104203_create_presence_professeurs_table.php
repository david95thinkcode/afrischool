<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresenceProfesseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presence_professeurs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('horaire_id');
            $table->date('date');
            $table->smallInteger('duree')->comments('Durée de sa presence en minutes');
            $table->unsignedInteger('real_professeur_id')->comments('Représente le réel professeur dont la presence est marquée même si celui trouvé grace à enseigner_id de horaire_id a changé avec le temps');
            $table->unsignedInteger('marked_by')->comments("L'utilisateur ayant marqué la presence du professeur");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('real_professeur_id')
                ->references('id')
                ->on('professeurs')
                ->onDelete('cascade');
            $table->foreign('horaire_id')
                ->references('id')
                ->on('horaires')
                ->onDelete('cascade');
            $table->foreign('marked_by')
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
        Schema::dropIfExists('presence_professeurs');
    }
}
