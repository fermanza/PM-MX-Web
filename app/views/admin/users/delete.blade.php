@extends('admin.layout.master')

@section('content')

	{{Form::open( array('url' => '/admin/user/delete', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $user->id)}}
	<fieldset>
		<legend>Eliminar Argumento</legend>

		<div class="form-group bottom-margin-industries">
                    <label for="" class="col-sm-2 control-label black">Email</label>
                    <div class="col-sm-7">
                        {{Form::text('email', Input::old('email') ? Input::old('email') : $user->email, array('class' => 'form-control', 'disabled') )}}
                    </div>
		</div>

	</fieldset>

	<h3>¿Estás seguro de eliminar este Usuario?</h3>
	<p>Esta opción no se puede deshacer</p>
        
        <div>
	{{Form::submit('Eliminar', array('class' => 'btn btn-danger'))}}
	{{Form::close()}}
        {{link_to('/admin/user/', 'Cancelar', array('class' => 'btn btn-primary'))}}
        </div>
@endsection