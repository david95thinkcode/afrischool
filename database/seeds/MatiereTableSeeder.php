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
            // Matières du primaire
            [   'intitule' => 'Lecture'   ],
            [   'intitule' => 'Expression Orale'   ],
            [   'intitule' => 'Dictée'   ],
            [   'intitule' => 'ES'   ],
            [   'intitule' => 'EST'   ],
            [   'intitule' => 'Dessin'   ],
            [   'intitule' => 'Poésie/Chant/Conte'   ],
            [   'intitule' => 'Education Physique et Sportive (EPS)'   ],
            [   'intitule' => 'Anglais'   ],
            [   'intitule' => 'Communication Orale'   ],

            // Matières du college
            [   'intitule' => 'Science Physique Chimie et Technologies (SPCT)'   ],
            [   'intitule' => 'Science de la Vie et de la terre (SVT)'   ],
            [   'intitule' => 'Informatique'   ],
            [   'intitule' => 'Fongbé'   ],
        ]);
    }
}
