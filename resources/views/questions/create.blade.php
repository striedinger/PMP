@extends('layouts.app')

@section('title')
Crear Pregunta
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/questions') }}">Preguntas</a></li>
		<li class="active">Crear Pregunta</li>
	</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			Crear Pregunta
		</div>
		<div class="panel-body">
			<form method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Pregunta</label>
					<textarea class="form-control" name="question">{{ old('question') }}</textarea>
					@if ($errors->has('question'))
                    <span class="help-block">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Descripción</label>
					<textarea class="form-control" name="description">{{ old('description') }}</textarea>
					@if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion A</label>
					<textarea class="form-control" name="optionA">{{ old('optionA') }}</textarea>
					@if ($errors->has('optionA'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionA') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion Bº</label>
					<textarea class="form-control" name="optionB">{{ old('optionB') }}</textarea>
					@if ($errors->has('optionB'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionB') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion C</label>
					<textarea class="form-control" name="optionC">{{ old('optionC') }}</textarea>
					@if ($errors->has('optionC'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionC') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion D</label>
					<textarea class="form-control" name="optionD">{{ old('optionD') }}</textarea>
					@if ($errors->has('optionD'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionD') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Respuesta</label>
					<select class="form-control" name="answer">
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
					</select>
					@if ($errors->has('answer'))
                    <span class="help-block">
                        <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Area de Conocimiento</label>
					{{ Form::select('area_id', $areas, null, ['class' => 'form-control']) }}
					@if ($errors->has('area_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('area_id') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Grupo de Proceso</label>
					{{ Form::select('process_id', $processes, null, ['class' => 'form-control']) }}
					@if ($errors->has('process_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('process_id') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="active"> <strong>¿Activa?</strong>
						</label>
					</div>
					@if ($errors->has('active'))
                    <span class="help-block">
                        <strong>{{ $errors->first('active') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Crear Pregunta</button>
				</div>
			</form>
		</div>
	</div>
	
</div>
@endsection