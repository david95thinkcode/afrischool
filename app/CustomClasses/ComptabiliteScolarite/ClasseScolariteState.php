<?php 

namespace App\CustomClasses\ComptabiliteScolarite;

/**
 * Représente l'état de la scolarité pour une classe
 * 
 */
class ClasseScolariteState extends BasicScolariteState
{
	/**
	 * Classe concernée pour laquelle l'état des scolarité
	 * est représentée par cet objet
	 * @var [type]
	 */
	public $classe;
	
	
	function __construct(\App\Models\Classe $classe)
	{
		parent::__construct();
		$this->classe = $classe;
	}

	
    /**
     * @return App\Models\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }
}