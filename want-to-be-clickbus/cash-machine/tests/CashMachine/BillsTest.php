<?php
namespace CashMachine;

use CashMachine\Bills;

class BillsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @cover CashMachine\Bills::__construct
     */
	public function testInstantiation()
    {
        $cash = [10, 100, 50, 20];

        $this->assertInstanceOf(
            'CashMachine\Bills',
            new Bills($cash)
        );

        return $cash;
    }

    /**
     * @depends testInstantiation
     * @cover CashManager\Bills::setBills
     */
    public function testSetBills($cash)
    {
        $bills = new Bills($cash);

        return $bills;
    }

    /**
     * @depends           testSetBills
     * @cover             CashManager\Bills::setBills
     * 
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetBillsWithoutArrayCash()
    {
        $bills = new Bills;
    }

    /**
     * @depends testSetBills
     * @cover   CashManager\Bills::getBills
     */
    public function testGetBills($bills)
    {
        $this->assertEquals(
            [100, 50, 20, 10],
            $bills->getBills()
        );
    }

    /**
     * @depends testSetBills
     * @cover   CashManager\Bills::getSmallerBill
     */
    public function testGetSmallerBill($bills)
    {
        $this->assertEquals(
            10,
            $bills->getSmallerBill()
        );
    }

}
