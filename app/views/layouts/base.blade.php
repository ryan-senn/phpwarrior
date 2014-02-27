<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Warrior</title>
	@section('head')
		{{ HTML::style('bootstrap-3.1.1/css/bootstrap.min.css') }}	
		{{ HTML::style('css/master.css') }}	
	@show
</head>
<body>

<div id="header">
	<div class="container">
		<h1><a href="{{ URL::route('home.index') }}">PHP Manual</a></h1>
	</div>
</div>
<div class="shadow-line" style="margin: 0px -20px"></div>

<div id="content">
	@yield('content')
</div>

<div id="footer">
	<div class="shadow-line"></div>
</div>

<script>
	@yield('js')
</script>

</body>
</html>