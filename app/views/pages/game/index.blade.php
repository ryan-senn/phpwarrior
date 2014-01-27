@section('head')

@parent

{{ HTML::script('js/jquery.js') }}

{{ HTML::script('colorbox/colorbox.js') }}
{{ HTML::style('colorbox/style.css') }}

{{ HTML::script('ace/ace.js') }}
{{ HTML::script('ace/mode-php.js') }}

{{ HTML::style('css/editor.css') }}
{{ HTML::style('css/map.css') }}

@stop


@section('content')

{{ Form::open(['route' => 'game.submit', 'method' => 'post']) }}

<textarea name="code" style="display: none;"></textarea>

{{ Form::close() }}

<div id="editor">{{ $code }}</div>


<div id="instructions">

<div style="margin-bottom: 20px;">
<a href="#" id="go" class="button">Go Warrior!</a>
</div>

<div class="shadow-line" style="margin: 0px -20px"></div>

<h2>Available skills</h2>
<ul>
	@foreach($skills as $skill)
		<li>{{ $skill }}</li>
	@endforeach
</ul>

<h2>Helpers</h2>
<ul>
	<li>$this->position->getRelativeDirectionOfStairs();</li>
</ul>

<h2>Map</h2>

{{ View::make('pages.map', ['map' => $map]) }}

</div>

@stop


@section('js')

var editor = ace.edit("editor");
var PhpMode = require("ace/mode/php").Mode;
editor.getSession().setMode(new PhpMode());

(function($)
{
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