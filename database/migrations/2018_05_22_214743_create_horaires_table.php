<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horaires', function (Blueprint $table) {
            $table->increments('id');
            $table->time('debut');
            $table->time('fin');

            $table->unsignedInteger('jour_id');
            $table->foreign('jour_id')
                ->references('id')
                ->on('jours')
                ->onDelete('cascade');

            $table->unsignedInteger('enseigner_id');
            $table->foreign('enseigner_id')
                ->references('id')
                ->on('enseigner')
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
        Schema::dropIfExists('horaires');
    }
}
