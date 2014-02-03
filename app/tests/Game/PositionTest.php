<?php

use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Warrior;


class PositionTest extends TestCase
{
	
	public function setup()
	{
		$this->map = new Map(5, 5);
		$this->position = new Position($this->map, 1, 2, 'north');
	}


	public function teardown()
	{
		$this->map = null;
		$this->position = null;
	}


	public function testX()
	{
		$this->assertEquals('1', $this->position->getX());
	}


	public function testY()
	{
		$this->assertEquals('1', $this->position->getX());
	}


	public function testIsAt()
	{
		$this->assertTrue($this->position->isAt(1, 2));
		$this->assertFalse($this->position->isAt(2, 3));
	}


	public function testDirection()
	{
		$this->assertEquals('north', $this->position->getDirection());
	}


	public function testMoveBackward()
	{
		$this->position->move('backward');

		$this->assertEquals('south', $this->position->getDirection());
		$this->assertEquals(1, $this->position->getY());
	}


	public function testMoveRight()
	{
		$this->position->move('right');

		$this->assertEquals('east', $this->position->getDirection());
		$this->assertEquals(2, $this->position->getX());
	}


	public function testMoveForward()
	{
		$this->position->move('forward');

		$this->assertEquals('north', $this->position->getDirection());
		$this->assertEquals(3, $this->position->getY());
	}


	public function testMoveLeft()
	{
		$this->position->move('left');

		$this->assertEquals('west', $this->position->getDirection());
		$this->assertEquals(0, $this->position->getX());
	}
}