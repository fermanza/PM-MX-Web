@extends('admin.layout.master')

@section('content')

<link href="{{asset('css/colorpicker.css')}}" rel="stylesheet">
<link rel="stylesheet" media="screen" type="text/css" href="{{asset('css/layout.css')}}" />

<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/colorpicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/txtcolorpicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/eye.js')}}"></script>
<script type="text/javascript" src="{{asset('js/utils.js')}}"></script>
<script type="text/javascript" src="{{asset('js/layout.js?ver=1.0.2')}}"></script>


	{{Form::open( array('url' => '/admin/industries/'.$action, 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $industry->id)}}
	<fieldset>
		<legend>Nueva Industria</legend>
    <div class="wrapper">
		<div class="form-group {{($errors->has('name') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6">
                            {{Form::text('name', Input::old('name') ? Input::old('name') : $industry->name, array('class' => 'form-control') )}}
                            @if($errors->has('name'))
                            <span class="help-block">{{$errors->first('name')}}</span>
                            @endif
			</div>
		</div>
                
		<div class="form-group {{($errors->has('bg_color') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Color de Fondo</label>
			<div class="col-sm-6">
                            {{Form::text('bg_color', Input::old('bg_color') ? Input::old('bg_color') : $industry->bg_color, array('class' => 'form-control-color', 'id' => 'bg_color', 'disabled') )}}
                            <div id="colorSelector"><div style="<?php if ($industry->bg_color != ""){ echo "background-color: ".$industry->bg_color; } else { echo 'background-color: #0000ff'; } ?>"></div></div>
                            @if($errors->has('bg_color'))
                            <span class="help-block">{{$errors->first('bg_color')}}</span>
                            @endif
			</div>
		</div>
                
		<div class="form-group {{($errors->has('txt_color') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Color de Texto</label>
			<div class="col-sm-6">
                            {{Form::text('bg_color', Input::old('txt_color') ? Input::old('txt_color') : $industry->txt_color, array('class' => 'form-control-color', 'id' => 'txt_color', 'disabled') )}}
                            <div id="colorSelector2"><div style="<?php if ($industry->txt_color != ""){ echo "background-color: ".$industry->txt_color; } else { echo 'background-color: #0000ff'; } ?>"></div></div>
                            @if($errors->has('txt_color'))
                            <span class="help-block">{{$errors->first('txt_color')}}</span>
                            @endif
			</div>
		</div>

		{{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
                {{link_to('/admin/industry/', 'Cancelar', array('class' => 'btn btn-primary'))}}


	</fieldset>
</div>
	{{Form::close()}}
        
@endsection