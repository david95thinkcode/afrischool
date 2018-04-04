<?php

use Illuminate\Database\Seeder;

class EtablissementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etablissements')->delete();

        DB::table('etablissements')->insert([
            [
                'raison_sociale' => 'Institut CERCO',
                'sigle' => 'CERCO',
                'directeur' => 'KOUTOUMA Sawal',
                'tel' => '+229 558 6321 78',
                'email' => 'koutoumat@sawal.com',
                'site_web' => 'www.afrischool.com',
                'categorie_ets_id' => '1',
                'adresse_id' => '2'
            ],
            [
                'raison_sociale' => 'Ecole Supérieure de Gestion d\'Informatique et des Sciences',
                'sigle' => 'ESGIS',
                'directeur' => 'AKAKPO Matthieu',
                'tel'=> '00 32 52 14 888 90',
                'email' => 'www.esgis.bj',
                'site_web' => 'www.afrischool.com',
                'categorie_ets_id' => '2',
                'adresse_id' => '1'
            ],
        ]);
    }
}
