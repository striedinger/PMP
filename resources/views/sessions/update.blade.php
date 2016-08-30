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
					<uib-progressbar max="pmp.qTotal" value="pmp.qTotalAnswered"><span style="color:white; white-space:nowrap;">@{{pmp.qTotalAnswered}} / @{{pmp.qTotal}}</span></uib-progressbar>
					<p>Pregunta @{{pmp.qIndex}} de @{{pmp.qTotal}}</p>
					<p>Tiempo dedicado: <timer interval="1000" countdown="100">@{{hhours}}:@{{mminutes}}:@{{sseconds}}</timer></p>
					<p><a href="">Ver resultados</a></p>
					<p>
						<a href="#marked" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="marked">Preguntas marcadas <span class="badge">@{{pmp.marked.size()}}</span></a>
						<div class="collapse" id="marked">
							<ul>
								<li ng-repeat="marked in pmp.qMarked" ng-click="changeQuestion(marked.number)">@{{marked.number}}</li>
								 
							</ul>
						</div>
					</p>
				</div>
			</div>
		</div>
		
		<question  question="pmp.qCurrent"  ng-if="pmp.dataHasLoaded"  > </question>
		 
	</div>
</div>
@endsection