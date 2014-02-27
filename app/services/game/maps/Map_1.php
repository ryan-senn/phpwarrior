<?php namespace Services\Game\Maps;

use Services\Game\Maps\Base as BaseMap;
use Services\Game\Map;
use Services\Game\Position;


class Map_1 extends BaseMap
{

	protected $description = 'Beside of the stairs in front of you, the room seems empty. Let\'s go crazy and try to walk!';
	protected $instruction = 'You can find the skills available to you on the right of the editor. In this case, <code>$this->walk()</code> seems to be a reasonable choice.';

	protected $skills = ['walk'];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(2, 4);

		$position = new Position($map, 2, 0);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$map->addUnit($warrior);

		return $map;
	}
}