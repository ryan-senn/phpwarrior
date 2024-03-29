@section('head')

@parent

{{ HTML::script('js/jquery.js') }}

{{ HTML::script('colorbox/colorbox.js') }}
{{ HTML::style('colorbox/style.css') }}

{{ HTML::script('ace/ace.js') }}
{{ HTML::script('ace/mode-php.js') }}

{{ HTML::style('css/game.css') }}
{{ HTML::style('css/map.css') }}

@stop


@section('content')

<div class="level">
	<div class="container">
		<div class="box">
			<div class="col-md-10">
				<h2>Level {{ $level }}</h2>
				<div class="description">{{ $description }}</div>
				<div class="instruction">{{ $instruction }}</div>
			</div>
			<div class="col-md-2 small-map">
				{{ View::make('partials.map', ['map' => $map, 'size' => 31]) }}
			</div>
		</div>
	</div>
</div>

{{ Form::open(['route' => 'game.submit', 'method' => 'post']) }}
<textarea name="code" style="display: none;"></textarea>
{{ Form::close() }}

<div class="container">
	<div class="box">
		<div class="col-md-7" id="editor">{{ $code }}</div>
		<div class="col-md-5">
			<div class="actions">
				<a href="#" id="go" class="btn btn-success"><span class="glyphicon glyphicon-play"></span> Go Warrior!</a> <a href="{{ URL::route('game.simulate') }}" id="go" class="btn btn-default">debug</a>
			</div>
			<div class="api">
				{{ View::make('partials.skills', ['skills' => $skills]) }}

				@if(in_array('feel', $skills))
					{{ View::make('partials.space') }}
				@endif
				
				@if(in_array('drink', $skills))
					{{ View::make('partials.potion') }}
				@endif
			</div>
		</div>
	</div>
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