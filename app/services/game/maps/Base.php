<?php namespace Services\Game\Maps;


abstract class Base
{
	
	protected $description = 'no description';
	protected $instruction = 'no instructions';
	protected $skills = [];


	public function getSkills()
	{
		return $this->skills;
	}


	public function getDescription()
	{
		return $this->description;
	}


	public function getInstruction()
	{
		return $this->instruction;
	}
}