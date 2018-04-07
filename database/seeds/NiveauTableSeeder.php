<?php

use Illuminate\Database\Seeder;

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
            ],
            [
                'id' => 2,
                'niv_libelle' => 'CP',
                'niv_description' => 'Cours Primaires',
            ]
        ]);
    }
}
