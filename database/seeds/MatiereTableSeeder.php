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
                'intitule' => 'Anglais'
            ],
            [
                'intitule' => 'Fongbé'
            ],
            [
                'intitule' => 'Eléctricité'
            ]
        ]);
    }
}
