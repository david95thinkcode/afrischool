<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CP',
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CE1',
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CE2',
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CM1',
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CM2',
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Classes du college
        DB::table('classes')->insert([
            [
                'cla_intitule' => '6e',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '5e',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '4e',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '3e',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Quelques classes du college avec série spécifiée
            [
                'cla_intitule' => '2nd A1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e A1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale A1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd A2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'cla_intitule' => '1e A2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale A2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd D',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'cla_intitule' => '1e D',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale D',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd C',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e C',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale C',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd G1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e G1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale G1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd G2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e G2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale G2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd G3',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e G3',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale G3',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd F1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e F1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale F1',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd F2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e F2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale F2',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd F3',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e F3',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale F3',
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
