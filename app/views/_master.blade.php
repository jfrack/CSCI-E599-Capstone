<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<title>SBOT New Hire Portal</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="keywords" content="SBOT new hire portal">
	<meta name="description" content="SBOT New Hire Portal">
	<!-- Get jquery from CDN -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/humanity/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<!-- Get Bootstrap from CDN -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<!-- Get Bootswatch theme from CDN -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/readable/bootstrap.min.css">
	<!-- Get local CSS -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">

	@yield('head')

</head>
<body>
	@if(Session::get('flash_message_success'))
		<div class='flash-message-success'>{{ Session::get('flash_message_success') }}</div>
	@elseif(Session::get('flash_message_error'))
		<div class='flash-message-error'>{{ Session::get('flash_message_error') }}</div>
	@endif

	<a href='/'><img class='logo' src='/img/logo-sbot.gif' alt='SBOT logo'></a>
	<h1>New Hire Portal</h1><br><br>

	@yield('nav')

	@yield('content')

	@yield('/body')

	<!-- Include custom scripts -->
	{{ HTML::script('js/NHPscripts.js') }}

</body>
</html>