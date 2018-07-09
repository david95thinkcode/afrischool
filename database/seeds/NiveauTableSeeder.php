<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NiveauTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('niveaux')->delete();

        DB::table('niveaux')->insert([
            [
                'id' => 1,
                'niv_libelle' => 'CE',
                'niv_description' => 'Cours Elémentaires',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'niv_libelle' => 'CP',
                'niv_description' => 'Cours Primaires',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
