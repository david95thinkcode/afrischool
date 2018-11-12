<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professeur extends Model
{
    use SoftDeletes;

    protected $table = "professeurs";
    protected $fillable = [
        'prof_nom', 'prof_prenoms', 'prof_date_naissance',
        'prof_sexe', 'prof_tel', 'prof_email', 'prof_matrimonial', 'prof_enfant',
        'prof_type', 'prof_nationalite'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    /**
     * Age accessor
     */
    public function getAgeAttribute()
    {
        return date('Y') - date('Y', strtotime($this->attributes['prof_date_naissance'])) . ' ans ';
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['prof_prenoms'] . ' ' . $this->attributes['prof_nom'];
    }

    /**
     * Un professeur enseigne plusieurs matières
     */
    public function enseigner()
    {
        return $this->hasMany(Enseigner::class);
    }

    /*
    * Un professeur a des diplomes
    */
    public function diplomes()
    {
        return $this->hasMany(Diplome::class, 'professeur_id');
    }

    /**
     * Un professeur peut être désigné comme principal plusieurs fois
     */
    public function professeursprincipal()
    {
        return $this->hasMany('App\Models\ProfesseurPrincipal');
    }
}
