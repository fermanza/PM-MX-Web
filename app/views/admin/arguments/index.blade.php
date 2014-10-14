@extends('admin.layout.master')

@section('content')

	{{link_to('/admin/argument/create', 'Agregar', array('class' => 'btn btn-success pull-right'))}}
	<div class="clearfix"></div>

	<table class="table">
		<thead>
			<th>ID</th>
			<th>Nombre</th>
			<th></th>
		</thead>
		<tbody>
                        <?php $i= 0; ?>
			@foreach($arguments as $argument)
                        <?php $i++; ?>
			<tr>
				<td class="td-id">{{$i}}</td>
				<td class="td-arguments">{{$argument->name}}</td>
				<td>
					{{link_to('/admin/argument/details/'.$argument->id, 'Ver', array('class' => 'btn btn-info'))}}
					{{link_to('/admin/argument/update/'.$argument->id, 'Modificar', array('class' => 'btn btn-primary'))}}
					{{link_to('/admin/argument/delete/'.$argument->id, 'Eliminar', array('class' => 'btn btn-danger'))}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@endsection