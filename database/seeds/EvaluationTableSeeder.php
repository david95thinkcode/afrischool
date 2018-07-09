<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'eva_intitule' => '1er examen',
                'eva_appreciation' => '',
                'type_evaluation_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
