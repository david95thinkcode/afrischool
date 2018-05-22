<?php

use Illuminate\Database\Seeder;

class JourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jours')->insert([
            ['nom' => 'Lundi'],
            ['nom' => 'Mardi'],
            ['nom' => 'Mercredi'],
            ['nom' => 'Jeudi'],
            ['nom' => 'Vendredi'],
            ['nom' => 'Samedi'],
            ['nom' => 'Dimanche']
        ]);
    }
}
