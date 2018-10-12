<?php 

namespace App\CustomClasses\ComptabiliteScolarite;

/**
 * 
 */
class BasicScolariteState
{
	/**
	 * Montant à payer normalement
	 * @var 
	 */
	public $cash;

	/**
	 * Montant payé
	 * @var int
	 */
	public $paid;

	/**
	 * Reste à payer
	 * @var int
	 */
	public $remaining;

	
	public function __construct() 
	{
		$this->setPaid(0);
		$this->setCash(0);
		$this->setRemaining(0);
	}

	

    /**
     * @return mixed
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * @param mixed $cash
     *
     * @return self
     */
    public function setCash($cash)
    {
        $this->cash = (int) $cash;
    }

    /**
     * @return int
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * @param int $paid
     *
     * @return self
     */
    public function setPaid($paid)
    {
        $this->paid = (int) $paid;
    }

    /**
     * @return int
     */
    public function getRemaining()
    {
        return $this->remaining;
    }

    /**
     * @param int $remaining
     *
     * @return self
     */
    private function setRemaining($remaining)
    {
        $this->remaining = (int) $remaining;
    }

    function finish()
    {
        $reste = $this->getCash() - $this->getPaid();
        $this->setRemaining($reste);
    }
}