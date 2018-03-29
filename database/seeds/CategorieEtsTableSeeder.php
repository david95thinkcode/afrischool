<?php

use Illuminate\Database\Seeder;

class CategorieEtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorie_ets')->delete();

        DB::table('categorie_ets')->insert([
            [
                'id' => 'PU',
                'libelle' => 'prive',
                'description' => 'Categorie des établissements privés',
            ],
            [
                'id' => 'PR',
                'libelle' => 'public',
                'description' => 'Categorie des établissements publics ou étatiques'
            ],
            [
                'id' => 'IN',
                'libelle' => 'internationale',
                'description' => 'Etablissements financé par des organisation internationales'
            ]
        ]);
    }
}
