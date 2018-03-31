<?php

use Illuminate\Database\Seeder;

class ProfesseurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professeurs')->delete();

        DB::table('professeurs')->insert([
            [
                'id' => 1,
                'nom' => 'AMOUSSOE',
                'prenoms' => 'Paul',
                'tel' => '0000025525578',
                'email' => 'test@mail.io'
            ],
            [
                'id' => 2,
                'nom' => 'CALEY',
                'prenoms' => 'Franck',
                'tel' => '0000025525578',
                'email' => 'test@mail.io'
            ],
            [
                'id' => 3,
                'nom' => 'KOUASSI',
                'prenoms' => 'Guy',
                'tel' => '0000025525578',
                'email' => 'test@mail.io'
            ]
        ]);
    }
}
