<?php
namespace CashMachine;

use CashMachine\Bills;
use CashMachine\Exceptions\NoteUnavailableException;

class Draw
{
    private $bills;

    public function __construct(Bills $bills)
    {
        $this->bills = $bills;
    }

    public function draw($value = null)
    {
        if (!$value) {
            return null;
        }

        $bills       = $this->bills->getBills();
        $smallerBill = $this->bills->getSmallerBill();
        
        $i = 0;
        while ($value) {

            if ($value < 0) {
                throw new \InvalidArgumentException("Invalid value");
                
            }
            
            if ($value < $smallerBill) {
                throw new NoteUnavailableException("Unavailable value");
            }

            if ($value >= $bills[$i]) {
                $value -= $bills[$i];
                $reserveBills[] = $bills[$i];
            }

            if ($value < $bills[$i]) {
                $i++;
            }
        }

        return $reserveBills;
    }
}
