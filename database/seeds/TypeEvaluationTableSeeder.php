<?php

use Illuminate\Database\Seeder;

class TypeEvaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_evaluation')->delete();

        DB::table('types_evaluation')->insert([
            [
                'id' => 1,
                'tev_libelle' => 'Interrogation',
            ],
            [
                'id' => 2,
                'tev_libelle' => 'Devoir',
            ],
            [
                'id' => 3,
                'tev_libelle' => 'Examen',
            ]
        ]);
    }
}
