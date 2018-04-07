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
            [
                'cla_intitule' => '3e D',
                'professeur_id' => '2',
            ],
            [
                'cla_intitule' => '2nd G2',
                'professeur_id' => '1',
            ],
            [
                'cla_intitule' => 'Terminale SE',
                'professeur_id' => '3',
            ]
        ]);
    }
}
