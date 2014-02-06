<?php

use Services\Game\Position;
use Services\Game\Units\Ooze;


class WalkTest extends SkillTest
{

	public function testDoesMove()
	{
		$this->warrior->setSkills(['walk']);

		$this->warrior->walk();
		$this->assertEquals(3, $this->warrior->getPosition()->getY());
	}


	public function testBumpsIntoWall()
	{
		$this->warrior->setSkills(['walk']);

		$position = new Position($this->map, 4, 0);
		$this->warrior->setPosition($position);
		$this->warrior->walk('right');

		// assert that warrior stays at x:4
		$this->assertEquals(4, $this->warrior->getPosition()->getX());
	}


	public function testBumpsIntoUnit()
	{
		$this->warrior->setSkills(['walk']);
		
		$position = new Position($this->map, 0, 2);
		$ooze = new Ooze($position);
		$this->map->addUnit($ooze);

		$this->warrior->walk('left');

		// assert that warrior stays at x:1
		$this->assertEquals(1, $this->warrior->getPosition()->getX());
	}
}