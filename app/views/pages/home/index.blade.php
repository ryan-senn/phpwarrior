@section('head')

@parent

{{ HTML::style('css/home.css') }}	

@stop


@section('content')

<div class="steps">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2>You're a warrior!</h2>
				<p>Sadly, to much beer the day before left you with no memories at all. You even forgot how to walk!</p>
				<img src="/images/warrior_big.jpg" />
			</div>
			<div class="col-md-4">
				<img src="/images/map.jpg" />
				<h2>Where am I?</h2>
				<p>You seem to be lost in... a dungeon? It's very dark, but you can glance light comming down some stairs. If only you knew how to walk, you could escape this scary place!</p>
			</div>
			<div class="col-md-4">
				<h2>Thou shalt walk!</h2>
				<p>Luckily for you, a close friend of yours noticed your absence and is trying to get you out of there. All hail, the great PHP-Wizzard!</p>
				<img src="/images/editor.png" />
			</div>
		</div>
	</div>
</div>
<div class="shadow-line" style="margin: 0px -20px"></div>

<div class="explanation">
	<div class="container">
		<p>This is a game designed to teach the PHP language and artificial intelligence in a fun, interactive way.</p>
		<p>You play as a warrior trying to escape a creature infested dungeon. On each new level, you'll have to write PHP code to instruct your warrior how to fight ennemies in order to reach the stairs.</p>
		<a class="btn btn-default btn-lg active" role="button" href="{{ URL::route('game.index', [1]) }}">Got'cha, let's do this!</a>
		<p class="inspired">The game was inspired by <a href="https://github.com/ryanb/ruby-warrior">Ruby Warrior</a>.</p>
	</div>
</div>

@stop