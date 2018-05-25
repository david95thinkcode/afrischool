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
                'prof_nom' => 'AMOUSSOE',
                'prof_prenoms' => 'Paul',
                'prof_sexe' => 'Masculin',
                'prof_tel' => '0000025525578',
                'prof_email' => 'POlo@mail.io',
                'prof_date_naissance' => '1968-03-29',
                'prof_nationalite' => 'Congo'

            ],
            [
                'id' => 2,
                'prof_nom' => 'CALEY',
                'prof_prenoms' => 'Francine',
                'prof_sexe' => "Féminin",
                'prof_tel' => '0000025525578',
                'prof_email' => 'test@mail.io',
                'prof_date_naissance' => '1950-09-09',
                'prof_nationalite' => 'Burkina-Faso'
            ],
            [
                'id' => 3,
                'prof_nom' => 'KOUASSI',
                'prof_prenoms' => 'Guy',
                'prof_sexe' => "Masculin",
                'prof_tel' => '0000025525578',
                'prof_email' => 'test@mail.io',
                'prof_date_naissance' => '1990-02-19',
                'prof_nationalite' => 'Bénin'
            ],
            [
                'id' => 4,
                'prof_nom' => 'DOSSA',
                'prof_prenoms' => 'Christian',
                'prof_sexe' => "Masculin",
                'prof_tel' => '002596521684',
                'prof_email' => 'doss@ecolemail.com',
                'prof_date_naissance' => '1990-02-19',
                'prof_nationalite' => 'Bénin'
            ]
        ]);
    }
}
