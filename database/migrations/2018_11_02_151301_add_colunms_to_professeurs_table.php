<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColunmsToProfesseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professeurs', function ($table) {
            $table->string('prof_type')->default('titulaire')->after('prof_nationalite');
            $table->string('prof_matrimonial')->default('celibataire')->after('prof_nationalite');
            $table->string('prof_enfant')->nullable(0)->after('prof_nationalite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professeurs', function($table) {
            $table->dropColumn('prof_type');
            $table->dropColumn('prof_matrimonial');
            $table->dropColumn('prof_enfant');
        });
    }
}
