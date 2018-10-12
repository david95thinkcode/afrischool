<?php 

namespace App\CustomClasses\ComptabiliteScolarite;

/**
 * 
 */
class EleveScolariteState extends BasicScolariteState
{
	/**
	 * Object Inscription représentant l'élève
	 * @var App\Models\Inscription
	 */
	public $eleve;
	
	/**
	 * Crée un objet EleveScolarite basé
	 * sur l'élève reçu en paramètre
	 * 
	 * @param App\Models\Inscription $eleve [description]
	 */
	function __construct(\App\Models\Inscription $eleve)
	{
		parent::__construct();

		$this->eleve = $eleve;
		$this->setCash($eleve->montant_scolarite);
	}

	function setPaid($paid)
	{
		parent::setPaid($paid);
		$this->finish();
	}


    /**
     * @return App\Models\Inscription
     */
    public function getEleve()
    {
        return $this->eleve;
    }
}