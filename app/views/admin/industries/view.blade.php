@extends('admin.layout.master')

@section('content')

	{{Form::open( array('url' => '/admin/industrys/', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $industry->id)}}
	<fieldset>
		<legend>Industrias</legend>

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

        <div>
           {{link_to('/admin/industry/', 'Regresar', array('class' => 'btn btn-primary'))}}
        </div>
                
	{{Form::close()}}

@endsection