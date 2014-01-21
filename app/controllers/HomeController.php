<?php

use Services\Game\Position;
use Services\Game\Unit\Ooze;
use Services\Game\Map;


class HomeController extends BaseController
{

	protected $layout = 'layouts.base';


	public function index()
	{
		$this->layout->content = View::make('pages.home.index');
	}


	public function mock()
	{
		require(storage_path() .'/Warrior.php');

		$map = new Map(5, 5);

		$maps[] = clone $map;

		$position = new Position($map, 1, 0);
		$warrior = new Warrior($position);
		$map->addUnit($warrior);

		$position = new Position($map, 1, 4);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);
		
		$maps[] = clone $map;

		for($turn = 0; $turn < 7; $turn++)
		{
			foreach($map->getUnits() as $unit)
			{
				$unit->playTurn();
			}

			$maps[] = clone $map;
		}

		$this->layout->content = View::make('pages.home.mock', [
			'maps' => $maps,
			'logs' => $warrior->getLogs(),
		]);
	}


	public function submit()
	{
		$code = Input::get('code');

		file_put_contents(storage_path() .'/Player.php', $code);
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);

		$position = new Position($map, 1, 2);
		$warrior = new Warrior($position);

		$map->setElement($warrior);

		$player = new Player($warrior);

		for($i = 0; $i < 10; $i++)
		{
			$player->play_turn();
		}

		return Response::json(json_encode($warrior->getLog()));
	}
}