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
                'id' => 1,
                'pays' => 'Bénin',
                'ville' => 'Cotonou',
                'quartier' => 'Gbegamey'
            ],
            [
                'id' => 2,
                'pays' => 'Togo',
                'ville' => 'Lomé',
                'quartier' => 'Kégué'
            ],
            [
                'id' => 3,
                'pays' => 'Côte d\'Ivoire',
                'ville' => 'Abidjan',
                'quartier' => 'Cocodi'
            ]
        ]);
    }
}
