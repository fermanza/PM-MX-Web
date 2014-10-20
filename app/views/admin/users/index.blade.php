@extends('admin.layout.master')

@section('content')

	{{link_to('/admin/user/create', 'Agregar', array('class' => 'btn btn-success pull-right'))}}
	<div class="clearfix"></div>

	<table class="table">
		<thead>
			<th>ID</th>
			<th>Email</th>
			<th></th>
		</thead>
		<tbody>
                        <?php $i= 0; ?>
			@foreach($users as $user)
                        <?php $i++; ?>
			<tr>
				<td class="td-id">{{$i}}</td>
				<td class="td-arguments">{{$user->email}}</td>
				<td>
					{{link_to('/admin/user/update/'.$user->id, 'Modificar', array('class' => 'btn btn-primary'))}}
					{{link_to('/admin/user/delete/'.$user->id, 'Eliminar', array('class' => 'btn btn-danger'))}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@endsection