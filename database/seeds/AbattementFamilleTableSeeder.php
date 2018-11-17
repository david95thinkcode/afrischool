<?php

use Illuminate\Database\Seeder;

class AbattementFamilleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abattement_familles')->insert([
            // ['nom' => 'Lundi'],
            // ['nom' => 'Mardi'],
            // ['nom' => 'Mercredi'],
            // ['nom' => 'Jeudi'],
            // ['nom' => 'Vendredi'],
            // ['nom' => 'Samedi'],
            // ['nom' => 'Dimanche']
        ]);
    }
}
