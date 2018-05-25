<?php

use Illuminate\Database\Seeder;

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
                'intitule' => 'Science Physique Chimie et Technologies (SPCT)'
            ],
            [
                'intitule' => 'Mathématiques'
            ],
            [
                'intitule' => 'Informatique'
            ],
            [
                'intitule' => 'Science de la Vie et de la terre (SVT)'
            ],
            [
                'intitule' => 'Anglais'
            ],
            [
                'intitule' => 'Fongbé'
            ],
            [
                'intitule' => 'Education Physique et Sportive'
            ],
        ]);
    }
}
