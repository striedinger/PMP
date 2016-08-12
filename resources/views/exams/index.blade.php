@extends('layouts.app')

@section('title')
Examenes
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="active">Examenes</li>
	</ol>
	@if(count($exams)==0)
	<div class="alert alert-warning text-center">
		<p>Aun no hay examenes creados.</p>
	</div>
	@endif
	@if(count($exams)>0)
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>#</th>
				<th>Nombre</th>
				<th>No. de Preguntas</th>
				<th>Duracion (min)</th>
				<th>Tipo</th>
				<th>Acciones</th>
			</thead>
			<tbody>
			@foreach($exams as $exam)	
				<tr>
					<td>{{ $exam->id }}</td>
					<td>{{ $exam->name }}</td>
					<td>{{ $exam->questions }}</td>
					<td>{{ $exam->duration }}</td>
					<td>{{ $exam->type }}</td>
					<td>
						{!! Form::open(['action' => array('ExamController@delete', $exam->id), 'method' => 'post'])!!}
						{{ method_field('DELETE') }}
						<a href="{{ url('/exams/update') . '/' . $exam->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
						<button class="btn btn-danger btn-xs" onclick="return confirm('¿Esta seguro de querer borrar al examen?');">
  							<i class="fa fa-trash-o" title="Borrar" aria-hidden="true"></i>
  							<span class="sr-only">Borrar</span>
						</button>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>	
	</div>
	<div class="text-center">
		{!! $exams->render() !!}
	</div>
	@endif
</div>
@endsection