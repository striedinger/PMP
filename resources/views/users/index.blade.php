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
						{!! Form::open(['action' => array('UserController@delete', $user->id), 'method' => 'post'])!!}
						{{ method_field('DELETE') }}
						<a href="{{ url('/users/update') . '/' . $user->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
						@if($user->id != Auth::user()->id)
						<button class="btn btn-danger btn-xs" onclick="return confirm('¿Esta seguro de querer borrar al usuario?');">
  							<i class="fa fa-trash-o" title="Borrar" aria-hidden="true"></i>
  							<span class="sr-only">Borrar</span>
						</button>
						@endif
						{!! Form::close() !!}
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