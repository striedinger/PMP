@extends('layouts.app')

@section('title')
Editar Usuario
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/users') }}">Usuarios</a></li>
		<li class="active">{{ $user->name }}</li>
	</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			Editar Usuario
		</div>
		<div class="panel-body">
			<form method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Nombre</label>
					<input type="email" class="form-control" name="name" value="{{ $user->name }}">
					@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>E-mail</label>
					<input type="email" class="form-control" name="email" value="{{ $user->email }}">
					@if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<label>Telefono</label>
					<input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
					@if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i> Actualizar Usuario</button>
				</div>
			</form>
		</div>
	</div>
	
</div>
@endsection