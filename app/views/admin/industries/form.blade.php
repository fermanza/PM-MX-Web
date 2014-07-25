@extends('admin.layout.master')

@section('content')

	{{Form::open( array('url' => '/admin/industries/'.$action, 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $industry->id)}}
	<fieldset>
		<legend>Nueva Industria</legend>

		<div class="form-group {{($errors->has('name') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6">
				{{Form::text('name', Input::old('name') ? Input::old('name') : $industry->name, array('class' => 'form-control') )}}
				@if($errors->has('name'))
				<span class="help-block">{{$errors->first('name')}}</span>
				@endif
			</div>
		</div>

		{{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
                {{link_to('/admin/industry/', 'Cancelar', array('class' => 'btn btn-primary'))}}


	</fieldset>

	{{Form::close()}}

@endsection