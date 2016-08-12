@extends('layouts.app')

@section('title')
Examen
@endsection

@section('content')
<div class="container" ng-controller="SessionController">
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Examen
				</div>
				<div class="panel-body">
					<p>Pregunta 1 de 100</p>
					<p>Tiempo dedicado: <timer start-time="1469768002932">@{{hhours}}:@{{mminutes}}:@{{sseconds}}</timer></p>
					<p><a href="">Ver resultados</a></p>
					<p>
						<a href="#marked" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="marked">Preguntas marcadas <span class="badge">2</span></a>
						<div class="collapse" id="marked">
							<ul>
								<li>hello</li>
								<li>world</li>
							</ul>
						</div>
					</p>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-8">
			<p><strong>Pregunta:</strong></p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<p><small>Seleccione la respuesta que considere es correcta, si está seguro presione CONFIRMAR. Si desea revisarla luego, presione MARCAR</small></p>
			<div class="question question-success">
				<p><strong>A. </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
			<div class="question question-info">
				<p><strong>B. </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
			<div class="question question-danger">
				<p><strong>C. </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
			<div class="question question-warning">
				<p><strong>D. </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
			<div class="form-group btn-group btn-group-justified" role="group">
				<div class="btn-group">
					<button class="btn btn-warning"><i class="fa fa-pencil"></i> Marcar</button>
				</div>
				<div class="btn-group">
					<button class="btn btn-success"><i class="fa fa-check"></i> Confirmar</button>
				</div>
			</div>
			<div class="well">
				<p><strong>Explicación:</strong></p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>
	</div>
</div>
@endsection