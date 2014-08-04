<!DOCTYPE html>
<html>
	<head>
		<title>M&eacute;xico 360 | {{$section}}</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/default.css')}}">
                <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.ico')}}"/>
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>
        <body class="body-show" style="background-color: <?php echo $argument->industry->bg_color ?>">
            @yield('content')
        </body>
</html>