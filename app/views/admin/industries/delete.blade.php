@extends('admin.layout.master')

@section('content')

	{{Form::open( array('url' => '/admin/industry/delete', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $industry->id)}}
	<fieldset>
		<legend>Eliminar Industria</legend>

		<div class="form-group bottom-margin-industries">
			<label for="" class="col-sm-2 control-label black">Nombre</label>
			<div class="col-sm-10">
				{{Form::text('name', Input::old('name') ? Input::old('name') : $industry->name, array('class' => 'form-control black', 'disabled') )}}
			</div>
		</div>
                <?php $i = 0; ?>
                @foreach($industry->arguments as $argument)
                <?php $i++; ?>
		<div class="form-group">
			<label for="" class="col-sm-2 control-label">Argumento {{$i}}</label>
			<div class="col-sm-10">
				{{Form::text('patern_name', Input::old('patern_name') ? Input::old('patern_name') : $argument->name, array('class' => 'form-control', 'disabled') )}}
			</div>
		</div>
                @endforeach
	</fieldset>

	<h3>¿Estás seguro de eliminar a esta Industria?</h3>
	<p>Esta opción no se puede deshacer</p>

        <div>
	{{Form::submit('Eliminar', array('class' => 'btn btn-danger'))}}
	{{Form::close()}}
        {{link_to('/admin/industry/', 'Cancelar', array('class' => 'btn btn-primary'))}}
        </div>

@endsection