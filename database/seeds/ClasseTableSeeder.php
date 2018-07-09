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
            [
                'id' => 1,
                'cla_intitule' => 'CE1',
                'niveau_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'cla_intitule' => '3e D',
                'niveau_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'cla_intitule' => '2nd G2',
                'niveau_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'cla_intitule' => 'Terminale SE',
                'niveau_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
