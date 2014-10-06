@extends('admin.layout.master')

@section('content')

<link href="{{asset('js/jquery-ui/ui.colorpicker.css')}}" rel="stylesheet">

<script src="{{asset('js/jquery-ui/external/jquery/jquery.js')}}" language="JavaScript"></script>
<script src="{{asset('js/jquery-ui/jq.color.js')}}" language="JavaScript"></script>
<script language="JavaScript">

$(document).ready(function() {

        var hideit = function(e, ui) {
            $(this).val('#' + ui.hex);
            $('.ui-colorpicker').css('display', 'none');
        };
        $('#bg #colorpicker').colorpicker({hide: hideit, submit: hideit});

        $('#dochange').click(function() {

            $('body').css('background-color', $('#colorpicker').val());

            return false;
        });

    });

</script>
	{{Form::open( array('url' => '/admin/argument/'.$action, 'method' => 'POST', 
        'role' => 'form', 'class' => 'form-horizontal',
        'files'=> true) )}}
		{{Form::hidden('id', $argument->id)}}
	<fieldset>
		<legend>{{ $section }}</legend>
                
		<div class="form-group {{($errors->has('name') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6">
				{{Form::text('name', Input::old('name') ? Input::old('name') : $argument->name, array('class' => 'form-control') )}}
				@if($errors->has('name'))
				<span class="help-block">{{$errors->first('name')}}</span>
				@endif
			</div>
		</div>
                
		<div class="form-group {{($errors->has('name') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Industria perteneciente</label>
			<div class="col-sm-6">
                            <select name="industry_id" id="industry_id" class="form-control">
                                <?php 
                                foreach($industries as $industry){
                                ?>
                                    <option value="<?= $industry->id ?>" <?php if($argument->industry->id == $industry->id) { ?> selected = "selected" <?php } ?>><?= $industry->name ?></option>
                                <?php
                                }
                                ?>
                            </select>
			</div>
		</div>
                
		<div class="form-group {{($errors->has('name') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Imagen del Argumento</label>
			<div class="col-sm-6">
                            <input type="file" name="argumet_image" id="argument_image">
			</div>
		</div>

		<div class="form-group {{($errors->has('name') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Lenguaje</label>
			<div class="col-sm-6">
                <select name="language_id" class="form-control">
                	@foreach($languages as $language)
                		<option value="{{$language->id}}" <?php if($argument->language_id == $language->id) { ?> selected="selected" <?php } ?>>{{$language->name}}</option>
                	@endforeach
                </select>
			</div>
		</div>
        <div class="form-group {{($errors->has('name') ? 'has-error' : '')}} ">
			<label for="" class="col-sm-2 control-label">Layout</label>
			<div class="col-sm-6">
                <select name="layout" class="form-control">
					<option value="1" <?php if($argument->layout == 1) { ?> selected="selected" <?php } ?>>1</option>
					<option value="2" <?php if($argument->layout == 2) { ?> selected="selected" <?php } ?>>2</option>
					<option value="3" <?php if($argument->layout == 3) { ?> selected="selected" <?php } ?>>3</option>
					<option value="4" <?php if($argument->layout == 4) { ?> selected="selected" <?php } ?>>4</option>
                </select>
			</div>
		</div>        
		{{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
                {{link_to('/admin/industry/', 'Cancelar', array('class' => 'btn btn-primary'))}}


	</fieldset>

	{{Form::close()}}

@endsection