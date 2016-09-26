@extends('layouts.app')

@section('title')
Resultados
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="active">Resultados</li>
	</ol>
	@if(count($sessions)==0)
	<div class="alert alert-warning text-center">
		<p>Aun no hay resultados disponibles.</p>
	</div>
	@endif
	@if(count($sessions)>0)
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>#</th>
				<th>Examen</th>
				<th>Usuario</th>
				<th>Acciones</th>
			</thead>
			<tbody>
			@foreach($sessions as $session)	
				<tr>
					<td>{{ $session->id }}</td>
					<td>{{ $session->exam->name }}</td>
					<td>{{ $session->user->name }}</td>
					<td>
						@if($session->time!=0 && !$session->isComplete())
						<a href="{{ url('/sessions') . '/' . $session->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
						@endif
						<a href="{{ url('/results') . '/' . $session->id }}" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>	
	</div>
	<div class="text-center">
		{!! $sessions->render() !!}
	</div>
	@endif
</div>
@endsection