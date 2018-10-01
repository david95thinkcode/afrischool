<?php

use Illuminate\Database\Seeder;

class TrancheScolariteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tranche_scolarites')->insert([
            [
                'id' => 1,
                'description' => 'Première tranche',
                'mois_debut' => 9,
                'mois_fin' => 12   
            ],
            [
                'id' => 2,
                'description' => 'Deuxième tranche',
                'mois_debut' => 1,
                'mois_fin' => 3
            ],
            [
                'id' => 3,
                'description' => 'Troisième tranche',
                'mois_debut' => 4,
                'mois_fin' => 6   
            ]
        ]);
    }
}
