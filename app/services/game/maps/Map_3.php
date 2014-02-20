<?php namespace Services\Game\Maps;

use Services\Game\Maps\Base as BaseMap;
use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Ooze;


class Map_3 extends BaseMap
{

	protected $description = 'We\'re not alone! There seems to be some kind of creatures in the room.<br /><br />Use <code>$this->feel()</code> to return a Space object. Only walk if the space is empty, and swing your sword if an Ooze is in your way!';

	protected $skills = ['feel', 'walk', 'attack'];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(4, 3);

		$position = new Position($map, 0, 1);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$map->addUnit($warrior);

		$position = new Position($map, 3, 2);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		$position = new Position($map, 1, 4);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		return $map;
	}
}