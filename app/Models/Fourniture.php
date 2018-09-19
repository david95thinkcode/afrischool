<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fourniture extends Model
{
    protected $table = "fournitures";

    protected $fillable = ['libelle', 'classe_id'];

    public $timestamps = true;

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

}
