@section('content')

{{ Form::open(['route' => 'game.submit', 'method' => 'post']) }}

{{ Form::label('code', 'Your Code') }}
{{ Form::textarea('code', 'Your Code') }}

{{ Form::submit('Go Warrior!') }}

{{ Form::close() }}

@stop