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
        $this->call(TrimestreTableSeeder::class);
        $this->call(CategorieEtsTableSeeder::class);
        $this->call(TypeEvaluationTableSeeder::class);
        $this->call(NiveauTableSeeder::class);
        $this->call(JourTableSeeder::class);
        $this->call(AdresseTableSeeder::class);
        $this->call(EtablissementTableSeeder::class);
        $this->call(ProfesseurTableSeeder::class);
        $this->call(ClasseTableSeeder::class);
        $this->call(MatiereTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersRolesSeeder::class);
        $this->call(EvaluationTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RolesPermissionsTableSeeder::class);
        //$this->call();
        
    }
}
