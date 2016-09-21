@extends('layouts.app')

@section('title')
Importar Preguntas
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/questions') }}">Preguntas</a></li>
		<li class="active">Importar Preguntas</li>
	</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			Importar Preguntas
		</div>
		<div class="panel-body">
			<form method="post" action enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Archivo XLS</label>
					<input type="file" name="file">
					@if ($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Importar</button>
				</div>
			</form>
		</div>
	</div>
	
</div>
@endsection