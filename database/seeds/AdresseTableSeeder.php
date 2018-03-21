<?php

use Illuminate\Database\Seeder;

class AdresseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adresses')->delete();

        DB::table('adresses')->insert([
            [
                'pays' => 'Bénin',
                'ville' => 'Cotonou',
                'quartier' => 'Gbegamey'
            ],
            [
                'pays' => 'Togo',
                'ville' => 'Lomé',
                'quartier' => 'Kégué'
            ],
            [
                'pays' => 'Côte d\'Ivoire',
                'ville' => 'Abidjan',
                'quartier' => 'Cocodi'
            ]
        ]);
    }
}
