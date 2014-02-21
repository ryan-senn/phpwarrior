@section('head')

@parent

{{ HTML::script('js/jquery.js') }}

{{ HTML::script('colorbox/colorbox.js') }}
{{ HTML::style('colorbox/style.css') }}

{{ HTML::script('ace/ace.js') }}
{{ HTML::script('ace/mode-php.js') }}

{{ HTML::style('css/map.css') }}

@stop


@section('content')

<div id="description">
	<div class="text">
		<h2>Level {{ $level }}</h2>
		<span>{{ $description }}</span>
	</div>
	<div class="map">{{ View::make('partials.map', ['map' => $map]) }}</div>
</div>

{{ Form::open(['route' => 'game.submit', 'method' => 'post']) }}

<textarea name="code" style="display: none;"></textarea>

{{ Form::close() }}

<div id="editor">{{ $code }}</div>


<div id="instructions">

	<div style="margin-bottom: 20px;">
		<a href="#" id="go" class="button">Go Warrior!</a>
		<a href="{{ URL::route('game.simulate') }}" id="go" class="button" style="margin-left: 10px;">simulate</a>
	</div>

	<div class="shadow-line" style="margin: 0px -20px"></div>


	{{ View::make('partials.skills', ['skills' => $skills]) }}

	@if(in_array('feel', $skills))
		{{ View::make('partials.space') }}
	@endif

	@if(in_array('drink', $skills))
		{{ View::make('partials.potion') }}
	@endif

</div>

@stop


@section('js')

var editor = ace.edit("editor");
var PhpMode = require("ace/mode/php").Mode;
editor.getSession().setMode(new PhpMode());

(function($) {
    $('a#go').click(function() {
	    $('textarea').val(editor.getValue());
	    $.post('/submit', $('form').serialize(), function(data) {
			$.colorbox({
				href: "/simulate",
				width: "800px",
				height: "600px"
			});
		});
	});
})(jQuery);

@stop