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
					<p>Pregunta @{{qIndex}} de @{{qTotal}}</p>
					<p>Tiempo dedicado: <timer start-time="1469768002932">@{{hhours}}:@{{mminutes}}:@{{sseconds}}</timer></p>
					<p><a href="">Ver resultados</a></p>
					<p>
						<a href="#marked" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="marked">Preguntas marcadas <span class="badge">2</span></a>
						<div class="collapse" id="marked">
							<ul>
								<li ng-repeat="(mKey, mValue) in marked">hello</li>
								<li>world</li>
							</ul>
						</div>
					</p>
				</div>
			</div>
		</div>
 
		<question question="qCurrent"> </question>
		 
 
	</div>
</div>
@endsection