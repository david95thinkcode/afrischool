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
                'mt_scolarite' => 150000,
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CP',
                'mt_scolarite' => 150000,
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CE1',
                'mt_scolarite' => 150000,
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CE2',
                'mt_scolarite' => 150000,
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CM1',
                'mt_scolarite' => 150000,
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'CM2',
                'mt_scolarite' => 150000,
                'estPrimaire' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Classes du college
        DB::table('classes')->insert([
            [
                'cla_intitule' => '6e',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '5e',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '4e',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '3e',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Quelques classes du college avec série spécifiée
            [
                'cla_intitule' => '2nd A1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e A1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale A1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd A2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'cla_intitule' => '1e A2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale A2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd D',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'cla_intitule' => '1e D',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale D',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd C',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e C',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale C',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd G1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e G1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale G1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd G2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e G2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale G2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd G3',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e G3',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale G3',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd F1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e F1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale F1',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd F2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e F2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale F2',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '2nd F3',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => '1e F3',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cla_intitule' => 'Terminale F3',
                'mt_scolarite' => 185000,
                'estCollege' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
