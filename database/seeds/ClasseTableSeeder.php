<?php

use Illuminate\Database\Seeder;

class ClasseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->delete();

        DB::table('classes')->insert([
            // Classes du primaire 
            [
                'cla_intitule' => 'CI',
                'estPrimaire' => true,
            ],
            [
                'cla_intitule' => 'CP',
                'estPrimaire' => true,
            ],
            [
                'cla_intitule' => 'CE1',
                'estPrimaire' => true,
            ],
            [
                'cla_intitule' => 'CE2',
                'estPrimaire' => true,
            ],
            [
                'cla_intitule' => 'CM1',
                'estPrimaire' => true,
            ],
            [
                'cla_intitule' => 'CM2',
                'estPrimaire' => true,
            ],
        ]);

        // Classes du college
        DB::table('classes')->insert([
            [
                'cla_intitule' => '6e',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => '5e',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => '4e',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => '3e',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => '2nd',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => '1e',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => 'Terminale',
                'estCollege' => true,
            ],

            // Quelques classes du college avec série spécifiée
            // TODO: A compléter
            [
                'cla_intitule' => '3e D',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => '2nd G2',
                'estCollege' => true,
            ],
            [
                'cla_intitule' => 'Terminale SE',
                'estCollege' => true,
            ]
        ]);
    }
}
