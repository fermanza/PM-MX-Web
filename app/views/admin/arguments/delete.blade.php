@extends('admin.layout.master')

@section('content')

	{{Form::open( array('url' => '/admin/argument/delete', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
		{{Form::hidden('id', $argument->id)}}
		{{Form::hidden('industry_id', $industry->id)}}
	<fieldset>
		<legend>Eliminar Argumento</legend>

		<div class="form-group bottom-margin-industries">
                    <label for="" class="col-sm-2 control-label black">Argumento</label>
                    <div class="col-sm-7">
                        {{Form::text('name', Input::old('name') ? Input::old('name') : $argument->name, array('class' => 'form-control', 'disabled') )}}
                    </div>
		</div>

		<div class="form-group">
                    <label for="" class="col-sm-2 control-label">Ind Perteneciente</label>
                    <div class="col-sm-7">
                        {{Form::text('industry_name', Input::old('industry_name') ? Input::old('industry_name') : $industry->name, array('class' => 'form-control', 'disabled') )}}
                    </div>
		</div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Fuente</label>
                    <div class="col-sm-7">
                            {{Form::text('source', Input::old('source') ? Input::old('source') : $argument->source, array('class' => 'form-control', 'disabled') )}}
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Idioma</label>
                    <div class="col-sm-7">
                            {{Form::text('language', Input::old('language') ? Input::old('language') : $argument->language->name, array('class' => 'form-control', 'disabled') )}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Layout</label>
                    <div class="col-sm-7">
                            {{Form::text('layout', Input::old('layout') ? Input::old('layout') : $argument->layout, array('class' => 'form-control', 'disabled') )}}
                    </div>
                </div>
                
                <div id="layout_container" class="container_layout_show">
                    <image src="{{ URL::to('img/arguments') }}/{{$argument->img}}" width="210px" />
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