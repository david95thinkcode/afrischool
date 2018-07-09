<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depenses extends Model
{
    protected $table = "depenses";
    protected $fillable = ['libelle', 'montant'];
    public $timestamps = true;
}
