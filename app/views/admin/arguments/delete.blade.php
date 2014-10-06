@extends('admin.layout.master')

@section('content')

	{{Form::open( array('url' => '/admin/argument/delete', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $argument->id)}}
		{{Form::hidden('industry_id', $industry->id)}}
	<fieldset>
		<legend>Eliminar Argumento</legend>

		<div class="form-group bottom-margin-industries">
			<label for="" class="col-sm-2 control-label black">Argumento</label>
			<div class="col-sm-10">
				{{Form::text('name', Input::old('name') ? Input::old('name') : $argument->name, array('class' => 'form-control black', 'disabled') )}}
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-2 control-label">Industria Perteneciente</label>
			<div class="col-sm-10">
				{{Form::text('patern_name', Input::old('patern_name') ? Input::old('patern_name') : $industry->name, array('class' => 'form-control', 'disabled') )}}
			</div>
		</div>

	</fieldset>

	<h3>¿Estás seguro de eliminar a este Argumento?</h3>
	<p>Esta opción no se puede deshacer</p>
        
        <div>
	{{Form::submit('Eliminar', array('class' => 'btn btn-danger'))}}
	{{Form::close()}}
        {{link_to('/admin/argument/', 'Cancelar', array('class' => 'btn btn-primary'))}}
        </div>
@endsection