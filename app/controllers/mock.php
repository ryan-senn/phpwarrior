<?php


class Map
{
    def initialize
      @width = 0
      @height = 0
      @units = []
      @stairs_location = [-1, -1]
    end
}


class Position
{
    def initialize(floor, x, y, direction = nil)
      @floor = floor
      @x = x
      @y = y
      @direction_index = DIRECTIONS.index(direction || :north)
    end
}


class Space
{
	def initialize(floor, x, y)
      @floor = floor, 
      @x = x, 
      @y = y,
  end
}


<?php

class Player
{

    protected $warrior;


    public function __construct($warrior)
    {
        $this->warrior = $warrior;
    }
  

    public function play_turn()
    {
        if($this->warrior->feel()->isEmpty())
        {
            $this->warrior->walk();
        }
    }
}