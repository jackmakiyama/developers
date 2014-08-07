<?php
namespace CashMachine;

use CashMachine\Draw;

class DrawTest extends \PHPUnit_Framework_TestCase
{
    private $bills;

    private $draw;

    protected function setUp()
    {
        $this->bills = $this->getMockBuilder('CashMachine\Bills')
                            ->disableOriginalConstructor()
                            ->getMock();

        $this->bills
             ->expects($this->any())
             ->method('getSmallerBill')
             ->will($this->returnValue(10.00));

        $this->bills
             ->expects($this->any())
             ->method('getBills')
             ->will($this->returnValue([100.00, 50.00, 20.00, 10.00]));

        $this->draw = new Draw($this->bills);
    }

    /**
     * @cover   CashMachine\Draw::draw
     */
    public function testDrawWithoutValue()
    {
        $this->assertEquals(null, $this->draw->draw(), 'Expected Null Value');
    }

    /**
     * @cover                    CashMachine\Draw::draw
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Invalid value
     */
    public function testDrawInvalidValue()
    {
        $this->draw->draw(-130);
    }

    /**
     * @cover                    CashMachine\Draw::draw
     * @expectedException        CashMachine\Exceptions\NoteUnavailableException
     * @expectedExceptionMessage Unavailable value
     */
    public function testDrawUnavailableValue()
    {
        $this->draw->draw(125);
    }
    

    /**
     * @cover   CashMachine\Draw::draw
     */
    public function testDrawValidValue()
    {
        $this->assertEquals(
            [20, 10],
            $this->draw->draw(30)
        );

        $this->assertEquals(
            [50, 20, 10],
            $this->draw->draw(80)
        );
    }
    
}
