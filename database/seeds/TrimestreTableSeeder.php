<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TrimestreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trimestres')->delete();

        DB::table('trimestres')->insert([
            [
                'id' => 1,
                'tri_numero' => 1,
                'tri_debut' => '2018-04-23',
                'tri_fin' => '2018-04-25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'tri_numero' => 2,
                'tri_debut' => '2018-04-29',
                'tri_fin' => '2018-07-25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'tri_numero' => 3,
                'tri_debut' => '2018-07-30',
                'tri_fin' => '2018-12-25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
