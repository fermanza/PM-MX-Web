@extends('admin.layout.master')

@section('content')

	{{link_to('/admin/industry/create', 'Agregar', array('class' => 'btn btn-success pull-right'))}}
	<div class="clearfix"></div>

	<table class="table">
		<thead>
			<th>ID</th>
			<th>Industria</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($industries as $industry)
			<tr>
				<td class="td-id">{{$industry->id}}</td>
				<td class="td-arguments">{{$industry->name}}</td>
				<td>
					{{link_to('/admin/industry/details/'.$industry->id, 'Ver', array('class' => 'btn btn-info'))}}
					{{link_to('/admin/industry/update/'.$industry->id, 'Modificar', array('class' => 'btn btn-primary'))}}
					{{link_to('/admin/industry/delete/'.$industry->id, 'Eliminar', array('class' => 'btn btn-danger'))}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@endsection