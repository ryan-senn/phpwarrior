<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Warrior</title>
	@section('head')
		{{ HTML::style('css/colorbox.css') }}	
	@show
</head>
<body>

@yield('content')

<script>
	@yield('js')
</script>

</body>
</html>