<?php

use Illuminate\Database\Seeder;

class EvaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evaluations')->delete();

        DB::table('evaluations')->insert([
            [
                'id' => 1,
                'eva_intitule' => '1er devoir',
                'eva_appreciation' => '',
                'type_evaluation_id' => 1,
            ],
            [
                'id' => 2,
                'eva_intitule' => '1er examen',
                'eva_appreciation' => '',
                'type_evaluation_id' => 3,
            ],
        ]);
    }
}
