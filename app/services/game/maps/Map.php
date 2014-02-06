<?php namespace Services\Game\Maps;


abstract class Map
{
	
	protected $skills = [];
	protected $helpers = [];


	public function getSkills()
	{
		return $this->skills;
	}


	public function getHelpers()
	{
		return $this->helpers;
	}
}