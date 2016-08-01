@extends('layouts.app')

@section('title')
Usuarios
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="active">Usuarios</li>
	</ol>
	@if(count($users)==0)
	<div class="alert alert-warning text-center">
		<p>Aun no hay usuarios registrados.</p>
	</div>
	@endif
	@if(count($users)>0)
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>#</th>
				<th>Nombre</th>
				<th>E-mail</th>
				<th>Telefono</th>
				<th>Limite Subscripción</th>
				<th>Acciones</th>
			</thead>
			<tbody>
			@foreach($users as $user)	
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ $user->expiration }}</td>
					<td>
						<a href="{{ url('/users/update') . '/' . $user->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>	
	</div>
	<div class="text-center">
		{!! $users->render() !!}
	</div>
	@endif
</div>
@endsection