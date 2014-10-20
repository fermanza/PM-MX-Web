@extends('admin.layout.master')

@section('content')

<link href="{{asset('js/jquery-ui/ui.colorpicker.css')}}" rel="stylesheet">

<script src="{{asset('js/jquery-ui/external/jquery/jquery.js')}}" language="JavaScript"></script>
<script src="{{asset('js/jquery-ui/jq.color.js')}}" language="JavaScript"></script>
<script src="{{asset('js/jquery.js')}}" language="JavaScript"></script>

{{Form::open( array('url' => '/admin/user/'.$action, 'method' => 'POST', 
'role' => 'form', 'class' => 'form-horizontal', 'files'=> true) )}}
{{Form::hidden('id', $user->id)}}
<fieldset>
    <legend>{{ $section }}</legend>

    <div class="form-group {{($errors->has('email') ? 'has-error' : '')}} ">
        <label for="" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-6">
            {{Form::text('email', Input::old('email') ? Input::old('email') : $user->email, array('class' => 'form-control') )}}
            @if($errors->has('email'))
            <span class="help-block">{{$errors->first('email')}}</span>
            @endif
        </div>
    </div>
    
    <div class="form-group {{($errors->has('password') ? 'has-error' : '')}} ">
        <label for="" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-6">
            {{Form::text('password', Input::old('password') ? Input::old('password') : '', array('class' => 'form-control') )}}
            @if($errors->has('password'))
            <span class="help-block">{{$errors->first('password')}}</span>
            @endif
        </div>
    </div>

    <div id="layout_container" class="container_layout"></div>
    {{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
    {{link_to('/admin/user/', 'Cancelar', array('class' => 'btn btn-primary'))}}


</fieldset>

{{Form::close()}}

@endsection