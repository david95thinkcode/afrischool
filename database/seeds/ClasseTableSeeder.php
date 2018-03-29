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
                'intitule' => '3e D',
            ],
            [
                'intitule' => '2nd G2',
            ],
            [
                'intitule' => 'Terminale SE',
            ]
        ]);
    }
}
