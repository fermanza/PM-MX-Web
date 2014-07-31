<!DOCTYPE>
<html>
	<head>
		<title>FindIT | @yield('subtitle')</title>
		<link rel="icon" href="{{asset('images/favicon.ico')}}">
                <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.ico')}}"/>
	</head>
	<body style="background-color:#f1f1f1;">
		<div class="error_content">
			@yield('content')
		</div>
	</body>
</html>