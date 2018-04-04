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
                'libelle' => 'prive',
                'description' => 'Categorie des établissements privés',
            ],
            [
                'libelle' => 'public',
                'description' => 'Categorie des établissements publics ou étatiques'
            ],
            [
                'libelle' => 'international',
                'description' => 'Etablissements financé par des organisations internationales'
            ]
        ]);
    }
}
