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
			<form method="post">
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
					<div class="checkbox">
						<label>
							<input type="checkbox" name="byArea"> <strong>¿Por Area de Conocimiento?</strong>
						</label>
					</div>
					@if ($errors->has('byArea'))
                    <span class="help-block">
                        <strong>{{ $errors->first('byArea') }}</strong>
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