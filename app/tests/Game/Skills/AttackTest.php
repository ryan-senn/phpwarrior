<?php

use Services\Game\Position;
use Services\Game\Units\Ooze;

require('Skill.php');


class WalkTest extends Skill
{

	public function testDoesNotHaveSkill()
	{
		$this->setExpectedException('Services\Game\Skills\InvalidSkillException');

		$this->warrior->walk('forward');
	}


	public function testDoesMove()
	{
		$this->warrior->setSkills(['walk']);
		$this->warrior->walk();

		$this->assertEquals(3, $this->warrior->getPosition()->getY());
	}


	public function testBumpsIntoWall()
	{
		$position = new Position($this->map, 4, 0);
		$this->warrior->setPosition($position);
		$this->warrior->setSkills(['walk']);

		$this->warrior->walk('right');

		// assert that warrior stays at x:4
		$this->assertEquals(4, $this->warrior->getPosition()->getX());
	}


	public function testBumpsIntoUnit()
	{
		$position = new Position($this->map, 0, 2);
		$ooze = new Ooze($position);
		$this->map->addUnit($ooze);

		$this->warrior->setSkills(['walk']);
		$this->warrior->walk('left');

		// assert that warrior stays at x:1
		$this->assertEquals(1, $this->warrior->getPosition()->getX());
	}
}