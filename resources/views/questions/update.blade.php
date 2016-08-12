@extends('layouts.app')

@section('title')
Editar Pregunta
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/questions') }}">Preguntas</a></li>
		<li class="active">Editar Pregunta</li>
	</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			Editar Pregunta
		</div>
		<div class="panel-body">
			<form method="post" action>
				{{ csrf_field() }}
				<div class="form-group">
					<label>Pregunta</label>
					<textarea class="form-control" name="question">{{ $question->question }}</textarea>
					@if ($errors->has('question'))
                    <span class="help-block">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Descripción</label>
					<textarea class="form-control" name="description">{{ $question->description }}</textarea>
					@if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion A</label>
					<textarea class="form-control" name="optionA">{{ $question->optionA }}</textarea>
					@if ($errors->has('optionA'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionA') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion Bº</label>
					<textarea class="form-control" name="optionB">{{ $question->optionB }}</textarea>
					@if ($errors->has('optionB'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionB') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion C</label>
					<textarea class="form-control" name="optionC">{{ $question->optionC }}</textarea>
					@if ($errors->has('optionC'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionC') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Opcion D</label>
					<textarea class="form-control" name="optionD">{{ $question->optionD }}</textarea>
					@if ($errors->has('optionD'))
                    <span class="help-block">
                        <strong>{{ $errors->first('optionD') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Respuesta</label>
					<select class="form-control" name="answer">
						<option value="A" @if($question->answer=='A') echo selected @endif>A</option>
						<option value="B" @if($question->answer=='B') echo selected @endif>B</option>
						<option value="C" @if($question->answer=='C') echo selected @endif>C</option>
						<option value="D" @if($question->answer=='D') echo selected @endif>D</option>
					</select>
					@if ($errors->has('answer'))
                    <span class="help-block">
                        <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Area de Conocimiento</label>
					{{ Form::select('area_id', $areas, $question->area_id, ['class' => 'form-control']) }}
					@if ($errors->has('area_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('area_id') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Grupo de Proceso</label>
					{{ Form::select('process_id', $processes, $question->process_id, ['class' => 'form-control']) }}
					@if ($errors->has('process_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('process_id') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="active" @if($question->active) echo checked @endif> <strong>¿Activa?</strong>
						</label>
					</div>
					@if ($errors->has('active'))
                    <span class="help-block">
                        <strong>{{ $errors->first('active') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i> Actualizar Pregunta</button>
				</div>
			</form>
		</div>
	</div>
	
</div>
@endsection