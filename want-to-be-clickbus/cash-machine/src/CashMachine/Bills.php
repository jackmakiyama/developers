<?php
namespace CashMachine;

class Bills
{

    private $bills;

    public function getBills()
    {
        return $this->bills;
    }
    
    public function setBills($bills)
    {
        $bills = array_filter($bills, 'is_float');

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
