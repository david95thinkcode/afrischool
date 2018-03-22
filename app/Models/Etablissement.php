<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $table = 'etablissements';

    public $timestamps = true;
    
    /**
     * Un établissement appartient a une catégorie
     */
    public function categorie()
    {
        return $this->belongsTo("App\Models\CategorieEts");
    }

    /**
     * Un établissement a une adresse
     */
    public function adresse()
    {
        return $this->belongsTo("App\Models\Adresse");
    }
}
