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
			<form method="post" action>
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
						<label>Fecha de Expiración</label>
						<div class='input-group date' id='datetimepicker1'>
                    		<input type='text' class="form-control" name="expiration" value="{{ $user->expiration }}"/>
                    		<span class="input-group-addon">
                        		<span class="glyphicon glyphicon-calendar"></span>
                    		</span>
                		</div>
					</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i> Actualizar Usuario</button>
				</div>
			</form>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			Transacciones
		</div>
		<div class="panel-body">
			{!! Form::open(['action' => array('TransactionController@create', $user->id, 'method' => 'post')]) !!}
			<div class="form-group">
				<label>Agregar Plan</label>
				<div class="input-group">
					{{ Form::select('plan_id', $plans, null, ['class' => 'form-control']) }}
					<div class="input-group-btn">
						<button class="btn btn-primary" type="submit">Agregar</button>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
			@if(count($user->transactions)==0)
			<p class="text-center">El usuario no tiene transacciones</p>
			@else 
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<th>#</th>
						<th>Plan</th>
						<th>Días</th>
						<th>Fecha</th>
					</thead>
					<tbody>
						@foreach($user->transactions as $transaction)
						<tr>
							<td>{{ $transaction->id }}</td>
							<td>{{ $transaction->plan->name }}</td>
							<td>{{ $transaction->plan->duration }} días</td>
							<td>{{ $transaction->created_at }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function () {
    $('#datetimepicker1').datetimepicker({
        'format' : 'YYYY-MM-DD'
    });
});
</script>
@endsection