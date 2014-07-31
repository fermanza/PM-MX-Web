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
	{{Form::open( array('url' => '/admin/arguments/'.$action, 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal' ) )}}
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


		{{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
                {{link_to('/admin/industry/', 'Cancelar', array('class' => 'btn btn-primary'))}}


	</fieldset>

	{{Form::close()}}

@endsection