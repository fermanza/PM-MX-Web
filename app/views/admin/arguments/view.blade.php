@extends('admin.layout.master')

@section('content')

	{{Form::open( array('url' => '/admin/arguments/', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $argument->id)}}
	<fieldset>
		<legend>Ver Argumento</legend>

		<div class="form-group bottom-margin-industries">
			<label for="" class="col-sm-2 control-label black">Argumento</label>
			<div class="col-sm-10">
				{{Form::text('name', Input::old('name') ? Input::old('name') : $argument->name, array('class' => 'form-control', 'disabled') )}}
			</div>
		</div>

		<div class="form-group">
			<label for="" class="col-sm-2 control-label">Industria Perteneciente</label>
			<div class="col-sm-10">
				{{Form::text('industry_name', Input::old('industry_name') ? Input::old('industry_name') : $industry->name, array('class' => 'form-control', 'disabled') )}}
			</div>
		</div>

	</fieldset>
        <div>
            {{link_to('/admin/argument/', 'Regresar', array('class' => 'btn btn-primary'))}}
        </div>

@endsection