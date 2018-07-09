<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'tev_libelle' => 'Devoir',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'tev_libelle' => 'Examen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
