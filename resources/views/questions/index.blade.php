@extends('layouts.app')

@section('title')
Preguntas
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="active">Preguntas</li>
	</ol>
	@if(count($questions)==0)
	<div class="alert alert-warning text-center">
		<p>Aun no hay preguntas creadas.</p>
	</div>
	@endif
	@if(count($questions)>0)
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>#</th>
				<th>Pregunta</th>
				<th>Area</th>
				<th>Proceso</th>
				<th>¿Activa?</th>
				<th>Acciones</th>
			</thead>
			<tbody>
			@foreach($questions as $question)	
				<tr>
					<td>{{ $question->id }}</td>
					<td>{{ $question->question }}</td>
					<td>{{ $question->area->name }}</td>
					<td>{{ $question->process->name }}</td>
					<td>{{ $question->active? 'Sí' : 'No' }}</td>
					<td>
						<a href="{{ url('/questions/update') . '/' . $question->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>	
	</div>
	<div class="text-center">
		{!! $questions->render() !!}
	</div>
	@endif
</div>
@endsection