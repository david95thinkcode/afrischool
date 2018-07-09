<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'id' => 1,
                'libelle' => 'prive',
                'description' => 'Categorie des établissements privés',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'libelle' => 'public',
                'description' => 'Categorie des établissements publics ou étatiques',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'libelle' => 'international',
                'description' => 'Etablissements financé par des organisations internationales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
