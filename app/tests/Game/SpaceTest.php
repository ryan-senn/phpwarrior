<?php

use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Ooze;
use Services\Game\Units\Warrior;


class SpaceTest extends TestCase
{
	
	public function setup()
	{
		$this->map = new Map(5, 5);
	}


	public function teardown()
	{
		$this->map = null;
	}


	public function testIsStairs()
	{
		$this->map->placeStairs(2, 3);
		$space = $this->map->getSpace(2, 3);

		$this->assertTrue($space->isStairs());
	}


	public function testIsNotStairs()
	{
		$this->map->placeStairs(2, 3);
		$space = $this->map->getSpace(1, 1);

		$this->assertFalse($space->isStairs());
	}


	public function testIsNotWall()
	{
		$space = $this->map->getSpace(0, 1);

		$this->assertFalse($space->isStairs());
	}


	public function testIsWall()
	{
		$space = $this->map->getSpace(5, 5);

		$this->assertTrue($space->isWall());
	}


	public function testIsEmpty()
	{
		$space = $this->map->getSpace(2, 2);

		$this->assertTrue($space->isEmpty());
	}


	public function testStairsIsEmpty()
	{
		$this->map->placeStairs(2, 2);
		$space = $this->map->getSpace(2, 2);

		$this->assertTrue($space->isEmpty());
	}


	public function testIsWarrior()
	{
		$position = new Position($this->map, 2, 2);
		$warrior = new Warrior($position);
		$this->map->addUnit($warrior);

		$space = $this->map->getSpace(2, 2);

		$this->assertTrue($space->isWarrior());
	}


	public function testIsEnnemy()
	{
		$position = new Position($this->map, 2, 2);
		$ooze = new Ooze($position);
		$this->map->addUnit($ooze);

		$space = $this->map->getSpace(2, 2);

		$this->assertTrue($space->isEnnemy());
	}
}