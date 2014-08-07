<?php
namespace CashMachine;

class Bills
{

	private $bills;

	public function __construct(Array $bills)
	{
		$this->setBills($bills);
	}

	public function getBills()
	{
	    return $this->bills;
	}
	
	public function setBills($bills)
	{
		$bills = array_filter($bills, 'is_int');

		arsort($bills);
		$bills = array_values($bills);

	    $this->bills = $bills;
	    
	    return $this;
	}

	public function getSmallerBill()
	{
		return min($this->bills);
	}
}
