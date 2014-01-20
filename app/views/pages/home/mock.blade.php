@section('head')

{{ HTML::style('css/mock.css') }}

@stop


@section('content')

@foreach($maps as $key => $map)

	<h1>{{ $key }}</h1>
	<div class="map">
		@foreach($map->getElements() as $x)
		<div class="column">
			@foreach(array_reverse($x) as $element)
				<div class="cell">
					<div class="coords">{{ $element->getPosition()->getX() }}/{{ $element->getPosition()->getY() }}</div>
					<div class="element">{{ $element }}</div>
				</div>
			@endforeach
		</div>
		@endforeach
	</div>

@endforeach

<br />

{{ $logs }}

@stop