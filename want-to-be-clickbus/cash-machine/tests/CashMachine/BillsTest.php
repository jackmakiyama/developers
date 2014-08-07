<?php
namespace CashMachine;

use CashMachine\Bills;

class BillsTest extends \PHPUnit_Framework_TestCase
{
    private $cash;

    private $bills;

    protected function setUp()
    {
        $this->cash  = [10.00, 100.00, 50.00, 20.00];

        $this->bills = new Bills($this->cash);
        $this->bills->setBills($this->cash);
    }

    /**
     * @cover   CashManager\Bills::getBills
     */
    public function testGetBills()
    {
        $this->assertEquals(
            [100.00, 50.00, 20.00, 10.00],
            $this->bills->getBills()
        );
    }

    /**
     * @cover   CashManager\Bills::getSmallerBill
     */
    public function testGetSmallerBill()
    {
        $this->assertEquals(
            10.00,
            $this->bills->getSmallerBill()
        );
    }

}
