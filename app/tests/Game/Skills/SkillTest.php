<?php

use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Warrior;


class SkillTest extends TestCase
{

	public function setup()
	{
		$this->map = new Map(5, 5);
		$this->position = new Position($this->map, 1, 2);
		$this->warrior = new Warrior($this->position);
	}


	public function teardown()
	{
		$this->map = null;
		$this->position = null;
		$this->warrior = null;
	}


	public function testDoesNotHaveWalkSkill()
	{
		$this->setExpectedException('Services\Game\Skills\InvalidSkillException');

		$this->warrior->walk();
	}


	public function testDoesNotHaveAttackSkill()
	{
		$this->setExpectedException('Services\Game\Skills\InvalidSkillException');

		$this->warrior->attack();
	}
}