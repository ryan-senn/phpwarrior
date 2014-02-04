<?php

use Services\Game\Position;
use Services\Game\Units\Ooze;
use Services\Game\Units\Unit;
use Services\Game\Map;
use Services\Game\Events;
use Services\Game\Event;
use Services\Game\Maps\map_1;
use Services\Game\Maps\map_2;
use Services\Game\Maps\map_3;


class GameController extends BaseController
{

	protected $layout = 'layouts.base';


	public function index()
	{
		$map = map_3::get();

		$this->layout->content = View::make('pages.game.index', [
			'code' => htmlspecialchars(file_get_contents(storage_path() .'/Player.php')),
			'map' => $map,
			'skills' => map_3::getSkills(),
			'helpers' => map_3::getHelpers(),
		]);
	}


	public function submit()
	{
		$code = Input::get('code');

		file_put_contents(storage_path() .'/Player.php', $code);
	}


	public function simulate()
	{
		$map = map_3::get();
		$warrior = $map->getWarrior();
		
		$maps[] = clone $map;

		for($turn = 0; $turn < 100; $turn++)
		{
			// warrior died, game is lost!
			if(!$warrior->isAlive())
			{
				$event = new Event;
				$event->setUnit($warrior);
				$event->setMessage('lost the game');

				Events::add($event);
				break;
			}

			// warrior reached the stairs, we won!
			if($warrior->getPosition()->isAt($map->getStairsLocation()['x'], $map->getStairsLocation()['y']))
			{
				$event = new Event;
				$event->setUnit($warrior);
				$event->setMessage('won the game');

				Events::add($event);
				break;
			}

			foreach($map->getUnits() as $unit)
			{
				// play this units turn if it's not dead
				if(!is_null($unit->getPosition()))
				{
					$unit->playTurn();
					$unit->endTurn();
				}
			}

			// save current state of the map
			$maps[] = clone $map;

			// register end of the turn
			Events::endTurn();
		}

		$this->layout = View::make('layouts.colorbox');
		$this->layout->content = View::make('pages.game.simulate', [
			'maps' => $maps,
			'events' => Events::all(),
			'skills' => map_3::getSkills(),
			'helpers' => map_3::getHelpers(),
		]);
	}
}