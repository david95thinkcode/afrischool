<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MatiereTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matieres')->delete();

        DB::table('matieres')->insert([
            [
                'id' => 1,
                'intitule' => 'Science Physique Chimie et Technologies (SPCT)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'intitule' => 'Mathématiques',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'intitule' => 'Informatique',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'intitule' => 'Science de la Vie et de la terre (SVT)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'intitule' => 'Anglais',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'intitule' => 'Fongbé',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'intitule' => 'Education Physique et Sportive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
