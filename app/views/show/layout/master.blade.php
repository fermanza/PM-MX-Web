<!DOCTYPE html>
<html>
	<head>
		<title>M&eacute;xico 360</title>
                <meta charset="UTF-8">
                
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/default.css')}}">
                <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.ico')}}"/>
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!--                
                <meta name="title" content="Mexico 360" />
                <meta name="description" content="<?php echo $argument->name ?>" />-->
                
	</head>
        <body class="body-show" style="background-color: <?php echo $argument->industry->bg_color ?>">
            <!--<img src="<?php echo asset('img/cards/'.$argument->img) ?>" />-->
            <!--<img class="img-attr" src="http://findit.vanillasys.com/images/lapichur.jpg">-->
            @yield('content')
        </body>
</html>