<?php
namespace CashMachine;

use CashMachine\Draw;

class DrawTest extends \PHPUnit_Framework_TestCase
{
	private $bills;

	/**
     * @cover CashMachine\Draw::__construct
     */
	public function testInstantiation()
	{
		$draw = new Draw($this->getBills());

		return $draw;
	}

	/**
	 * @depends testInstantiation
	 * @cover   CashMachine\Draw::draw
	 */
	public function testDrawWithoutValue($draw)
	{
		$this->assertEquals(null, $draw->draw(), 'Expected Null Value');
	}

	/**
	 * @depends                  testInstantiation
	 * @cover                    CashMachine\Draw::draw
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Invalid value
	 */
	public function testDrawInvalidValue($draw)
	{
		$draw->draw(-130);
	}

	/**
     * @depends                  testInstantiation
     * @cover                    CashMachine\Draw::draw
     * @expectedException        CashMachine\Exceptions\NoteUnavailableException
     * @expectedExceptionMessage Unavailable value
     */
    public function testDrawUnavailableValue()
    {
		$draw = new Draw($this->getBills());
        $draw->draw(125);
        return $draw;
    }
    

	/**
	 * @depends testInstantiation
	 * @cover   CashMachine\Draw::draw
	 */
	public function testDrawValidValue()
	{
		$draw = new Draw($this->getBills());

		$this->assertEquals(
			[20, 10],
			$draw->draw(30)
		);

		$this->assertEquals(
			[50, 20, 10],
			$draw->draw(80)
		);
		return $draw;
	}

	public function getBills()
	{
		if ($this->bills)
			return $this->bills;

		$this->bills = $this->getMockBuilder('CashMachine\Bills')
                            ->disableOriginalConstructor()
                            ->getMock();
		
		$this->bills
		     ->expects($this->any())
		     ->method('getSmallerBill')
		     ->will($this->returnValue(10));
		
		$this->bills
		     ->expects($this->any())
		     ->method('getBills')
		     ->will($this->returnValue([100, 50, 20, 10]));

		return $this->bills;
	}
	
}