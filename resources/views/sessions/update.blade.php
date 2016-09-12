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
					<div class="col-xs-8">
						Examen
					</div>
					<div class="stop-timer"  >
							<div class="btn-group" >
								<button class="btn btn-warning " ng-click="stopTimer()" ng-show="pmp.timerRunning"><i class="fa fa-pencil"></i> Parar</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-warning " ng-click="startTimer()" ng-show="!pmp.timerRunning"><i class="fa fa-pencil"></i> Continuar</button>
							</div>
					</div>
				</div>
				<div class="panel-body">
					<uib-progressbar max="pmp.qTotal" value="pmp.qTotalAnswered"><span style="color:white; white-space:nowrap;">@{{pmp.qTotalAnswered}} / @{{pmp.qTotal}}</span></uib-progressbar>
					<p>Pregunta @{{pmp.qIndex}} de @{{pmp.qTotal}}</p>
					<p>Tiempo dedicado: 
					<timer ng-if="!infinito" interval="1000" countdown="1000">@{{hhours}}:@{{mminutes}}:@{{sseconds}}</timer>
					<timer ng-if="infinito"  interval="1000" start-time="init_time" >@{{ddays}}:@{{hhours}}:@{{mminutes}}:@{{sseconds}}</timer>
					</p>
					<p><a href="">Ver resultados</a></p>
					<p>
						<a href="#marked" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="marked">Preguntas marcadas <span class="badge">@{{pmp.marked.size()}}</span></a>
						<div class="collapse" id="marked">
							
						</div>
						<ul>
								<li ng-repeat="marked in pmp.qMarked" ng-click="changeQuestion(marked.number)">@{{marked.number}}</li>
								 
							</ul>
					</p>
				</div>
			</div>
		</div>
 
 
		
		<question  question="pmp.qCurrent"  ng-if="pmp.dataHasLoaded"  > </question>
 
		 
 
	</div>
</div>
@endsection