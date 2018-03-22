<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieEts extends Model
{
    protected $table = 'categorie_ets';

    public $timestamps = true;

    /**
     * Une catégorie est utilisée par plusieurs établissements
     */
    public function etablissements()
    {
        return $this->hasMany("App\Models\Etablissement");
    }
}
