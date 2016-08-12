@extends('layouts.app')

@section('title')
Crear Examen
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/exams') }}">Examenes</a></li>
		<li class="active">Crear Examen</li>
	</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			Crear Examen
		</div>
		<div class="panel-body">
			<form method="post" action>
				{{ csrf_field() }}
				<div class="form-group">
					<label>Nombre</label>
					<input type="email" class="form-control" name="name" value="{{ old('name') }}">
					@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Descripcion</label>
					<textarea class="form-control" name="description">{{ old('description') }}</textarea>
					@if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Duración (minutos)</label>
					<input type="text" class="form-control" name="duration" value="{{ old('duration') }}">
					@if ($errors->has('duration'))
                    <span class="help-block">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Numero de Preguntas</label>
					<input type="text" class="form-control" name="questions" value="{{ old('questions') }}">
					@if ($errors->has('questions'))
                    <span class="help-block">
                        <strong>{{ $errors->first('questions') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Tipo de Examen</label>
					<select class="form-control" name="type">
						<option value="Aleatorio">Aleatorio</option>
						<option value="Area">Area de Conocimiento</option>
						<option value="Proceso">Grupo de Proceso</option>
					</select>
					@if ($errors->has('type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Crear Examen</button>
				</div>
			</form>
		</div>
	</div>
	
</div>
@endsection