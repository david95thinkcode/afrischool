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
            // Matières du primaire
            [   'intitule' => 'Lecture',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Expression Orale',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Dictée',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'ES',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'EST',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Dessin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Poésie/Chant/Conte',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Education Physique et Sportive (EPS)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Anglais',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Communication Orale',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Matières du college
            [   'intitule' => 'Science Physique Chimie et Technologies (SPCT)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Science de la Vie et de la terre (SVT)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Informatique',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   'intitule' => 'Fongbé',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
