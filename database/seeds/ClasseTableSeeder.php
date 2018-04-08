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
                'cla_intitule' => 'CE1',
            ],
            [
                'cla_intitule' => '3e D',
            ],
            [
                'cla_intitule' => '2nd G2',
            ],
            [
                'cla_intitule' => 'Terminale SE',
            ]
        ]);
    }
}
