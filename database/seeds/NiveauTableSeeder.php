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
                'niv_libelle' => 'collège',
                'niv_description' => 'Le collège',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'niv_libelle' => 'primaire',
                'niv_description' => 'Le primaire',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'niv_libelle' => 'lycée',
                'niv_description' => 'Le lycée',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
