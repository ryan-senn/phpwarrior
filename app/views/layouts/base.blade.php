<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Warrior</title>
	@section('head')
		{{ HTML::style('css/master.css') }}	
	@show
</head>
<body>

<div id="header">
	<div class="content">
		<h1>PHP Manual</h1>
	</div>
</div>

<div id="content">
	<div class="content">
		@yield('content')
	</div>
</div>

<div id="footer">
	<div class="shadow-line"></div>
</div>

<script>
	@yield('js')
</script>

</body>
</html>