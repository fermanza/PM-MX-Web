@extends('errors.master')
@section('subtitle')
{{$subtitle}}
@endsection
@section('content')
<div style="text-align: center;margin-top: 100px;">
	<a href="{{URL::to('/')}}"><img src="{{asset('img/logo.png')}}" alt="" style="margin: -15px"></a>
	<h1 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">{{$message}}</h1>
</div>
@endsection