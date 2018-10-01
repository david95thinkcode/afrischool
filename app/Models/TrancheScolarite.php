<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrancheScolarite extends Model
{
    public $timestamps = true;

    public function paiements()
    {
        return $this->hasMany(PaiementScolarite::class);
    }
}
