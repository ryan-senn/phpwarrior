@section('head')

@parent

{{ HTML::style('css/map.css') }}
{{ HTML::style('css/simulation.css') }}

{{ HTML::script('js/jquery.js') }}

@stop


@section('content')

@foreach($maps as $key => $map)

<div id="turn_{{ $key }}" class="turn">
	<p>Turn {{ $key }}</p>

	<ul>
	@foreach(Services\Game\Events::getTurn($key) as $event)
		<li>{{ $event }}</li>
	@endforeach
	</ul>

	{{ View::make('pages.map', ['map' => $map]) }}
</div>

@endforeach

@stop


@section('js')

(function($)
{
    $('div.turn').show();

    $('div.turn').each(function(i) {
    	$(this).delay(2000).show();
	});
})(jQuery);

@stop