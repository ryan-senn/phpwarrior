<?php

use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Ooze;
use Services\Game\Units\Warrior;


class MapTest extends TestCase
{
	
	public function setup()
	{
		$this->map = new Map(5, 5);
	}


	public function teardown()
	{
		$this->map = null;
	}


	public function testGetUnitsWithPosition()
	{
		$position = new Position($this->map, 2, 2);
		$ooze = new Ooze($position);
		$this->map->addUnit($ooze);

		$this->assertEquals(1, count($this->map->getUnits()));
	}


	public function testGetUnitsWithNoPosition()
	{
		$position = new Position($this->map, 2, 2);
		$ooze = new Ooze($position);
		$this->map->addUnit($ooze);

		$ooze->setPosition(null);

		$this->assertEquals(0, count($this->map->getUnits()));
	}


	public function testGetOtherUnits()
	{
		$position = new Position($this->map, 2, 2);
		$ooze = new Ooze($position);
		$this->map->addUnit($ooze);

		$position = new Position($this->map, 3, 3);
		$warrior = new Warrior($position);
		$this->map->addUnit($warrior);

		$this->assertEquals(1, count($this->map->getOtherUnits()));
	}


	public function testGetWarrior()
	{
		$position = new Position($this->map, 2, 2);
		$ooze = new Ooze($position);
		$this->map->addUnit($ooze);

		$position = new Position($this->map, 3, 3);
		$warrior = new Warrior($position);
		$this->map->addUnit($warrior);

		$this->assertInstanceOf('Services\Game\Units\Warrior', $this->map->getWarrior());
	}


	public function testCoordsAreOutOfTheMap()
	{
		$this->assertTrue($this->map->isOut(0, 5));
		$this->assertTrue($this->map->isOut(0, -1));
		$this->assertTrue($this->map->isOut(-1, 0));
		$this->assertTrue($this->map->isOut(5, 0));
	}


	public function testCoordsAreNotOutOfTheMap()
	{
		$this->assertFalse($this->map->isOut(0, 0));
		$this->assertFalse($this->map->isOut(2, 4));
		$this->assertFalse($this->map->isOut(4, 4));
	}


	public function testPlaceAndRetrieveStairsLocation()
	{
		$this->map->placeStairs(3, 1);

		$this->assertEquals($this->map->getStairsLocation(), ['x' => 3, 'y' => 1]);
	}


	public function testRetrieveStairsSpace()
	{
		$this->map->placeStairs(2, 2);

		$this->assertEquals($this->map->getStairsSpace()->getX(), 2);
		$this->assertEquals($this->map->getStairsSpace()->getY(), 2);
	}
}