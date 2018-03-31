<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorieEtsTableSeeder::class);
        $this->call(AdresseTableSeeder::class);
        $this->call(EtablissementTableSeeder::class);
        $this->call(ProfesseurTableSeeder::class);
        $this->call(ClasseTableSeeder::class);
        $this->call(MatiereTableSeeder::class);
        //$this->call();
        
    }
}
