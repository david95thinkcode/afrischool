<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaiementScolarite extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;

    public function tranche()
    {
        return $this->belongsTo(TrancheScolarite::class);
    }

    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }
}
