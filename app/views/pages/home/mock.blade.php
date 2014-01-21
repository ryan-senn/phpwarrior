@section('head')

{{ HTML::style('css/mock.css') }}

@stop


@section('content')

@foreach($maps as $key => $map)

	<p>{{ $key }}</p>
	<div class="map">
		@for($x = 0; $x < $map->getWidth(); $x++)
		<div class="column">
			@for($y = $map->getHeight() -1; $y >= 0; $y--)
				<div class="cell">
					<div class="coords">{{ $x }}/{{ $y }}</div>
					<div class="element">{{ $map->getUnit($x, $y) }}</div>
				</div>
			@endfor
		</div>
		@endfor
	</div>

@endforeach

<br />

<ul>
@foreach($logs as $log)

	<li>{{ $log }}</li>

@endforeach
</ul>

@stop