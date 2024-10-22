<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'id' => 1,
                'an_description' => '2018-2019',
                'an_date_debut' => '2018-06-25',
                'an_date_fin' => '2019-06-25',
                'an_ouverte' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
