<!DOCTYPE html>
<html>
	<head>
		<title>M&eacute;xico 360 | {{$section}}</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/default.css')}}">
                <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.ico')}}"/>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			    </button>
			    <a class="navbar-brand" href="#">
			    	<img src="{{asset('img/logo.png')}}" alt="" style="margin: -15px">
			    </a>
			    <a class="navbar-brand" href="#">
			    	M&eacute;xico 360 | {{$section}}
			    </a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                                    <li>{{link_to('admin/listindustry/1', 'Industrias')}}</li>
                                    <li>{{link_to('admin/listindustry/2', 'Industries')}}</li>
                                    <li>{{link_to('admin/listargument/1', 'Argumentos')}}</li>
                                    <li>{{link_to('admin/listargument/2', 'Arguments')}}</li>
                                    <li>{{link_to('admin/user', 'Usuarios')}}</li>
                                    <li>{{link_to('apps/Mexico360P.apk', 'Android Test')}}</li>
                                </ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
                                                {{link_to('/admin/login/logout', 'Cerrar Sesión')}}
					</li>
				</ul>
			</div>
		</nav>

		<div class="container">
			@if(Session::has('message'))
				<div class="alert alert-{{Session::get('message')['type']}} alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get('message')['message']}}
				</div>
			@endif
			
			@yield('content')
		</div>

		<script src="{{asset('js/jquery.js')}}"></script>
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		@yield('scripts')
	</body>
</html>