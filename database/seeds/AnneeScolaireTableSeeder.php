<?php

use Illuminate\Database\Seeder;

class AnneeScolaireTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('annees_scolaires')->delete();

        DB::table('annees_scolaires')->insert([
            [
                'an_description' => '2018-2019',
                'an_date_debut' => '2018-06-25',
                'an_date_fin' => '2019-06-25',
                'an_ouverte' => true,
            ]
        ]);
    }
}
