<?php 

namespace App\CustomClasses\ComptabiliteScolarite;

/**
  * Représente l'état de la scolarite pour 
  * toute l'école
  * 
  */
 class SchoolScolariteState extends BasicScolariteState
 {
 	public $classes = [];
 	
 	function __construct()
 	{
 		parent::__construct();
 	}
 
    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     *
     * @return self
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }

    public function pushToClasses(ClasseScolariteState $classeState)
    {
    	array_push($this->classes, $classeState);
    }
}
