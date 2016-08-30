@extends('layouts.app')

@section('title')
Ver Resultado
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/results') }}">Resultados</a></li>
		<li class="active">Ver Resultado</li>
	</ol>
	<ul class="nav nav-tabs nav-justified" role="tablist">
		<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Resultado General</a></li>
		<li role="presentation" ><a href="#questions" aria-controls="questions" role="tab" data-toggle="tab">Preguntas</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active has-padding fade in" id="general">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div id="circle">
						<strong></strong>
					</div>	
				</div>
				<div class="col-xs-12 col-md-6">
					<ul class="nav nav-pills">
						<li class="active"><a href="#areas" data-toggle="tab">Areas de Conocimiento</a></li>
						<li><a href="#processes" data-toggle="tab">Grupos de Procesos</a></li>
					</ul>
					<div class="tab-content" style="margin-top:20px">
						<div class="tab-pane active" id="areas">
							<strong>Area 1</strong><span class="pull-right">40%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 40%;"></div>
							</div>
							<strong>Area 2</strong><span class="pull-right">70%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 70%;"></div>
							</div>
						</div>
						<div class="tab-pane" id="processes">
							Hello world
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane has-padding fade" id="questions">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="alert alert-success">
						<p>Preguntas respondidas <strong>correctamente</strong> <span class="badge pull-right">{{ count($correct) }}</span></p>
					</div>
					@foreach($correct as $c)
					<div>
						<div data-toggle="collapse" data-parent="#correct" href="#collapse-{{ $c->number }}" style="cursor:pointer">
							<div class="row">
								<div class="col-xs-8 truncate">
									<strong>{{ $c->number }}.</strong> {{ $c->question->question }}
								</div>
								<div class="col-xs-4" align="right">
									<ul class="list-inline">
										<li>
											<span class="label {{ ($c->answer=='A')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'A')? 'label-success' : 'label-default') }}">A</span>
										</li>
										<li>
											<span class="label {{ ($c->answer=='B')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'B')? 'label-success' : 'label-default') }}">B</span>
										</li>
										<li>
											<span class="label {{ ($c->answer=='C')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'C')? 'label-success' : 'label-default') }}">C</span>
										</li>
										<li>
											<span class="label {{ ($c->answer=='D')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'D')? 'label-success' : 'label-default') }}">D</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="collapse well" id="collapse-{{ $c->number }}" aria-expanded="false">
							<p>{{ $c->question->question }}</p>
							<div class="question {{ ($c->answer=='A')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'A')? 'question-success' : 'question-info') }}">
								<p><strong>A. </strong> {{ $c->question->optionA }}</p>
							</div>
							<div class="question {{ ($c->answer=='B')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'B')? 'question-success' : 'question-info') }}">
								<p><strong>B. </strong> {{ $c->question->optionB }}</p>
							</div>
							<div class="question {{ ($c->answer=='C')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'C')? 'question-success' : 'question-info') }}">
								<p><strong>C. </strong> {{ $c->question->optionC }}</p>
							</div>
							<div class="question {{ ($c->answer=='D')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'D')? 'question-success' : 'question-info') }}">
								<p><strong>D. </strong> {{ $c->question->optionD }}</p>
							</div>
							<div>
								<p><strong>Explicación:</strong></p>
								<p>{{ $c->question->description }}</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="alert alert-danger">
						<p>Preguntas respondidas <strong>erroneamente</strong> <span class="badge pull-right">{{ count($wrong) }}</span></p>
					</div>
					@foreach($wrong as $c)
					<div>
						<div data-toggle="collapse" data-parent="#correct" href="#collapse-{{ $c->number }}" style="cursor:pointer">
							<div class="row">
								<div class="col-xs-8 truncate">
									<strong>{{ $c->number }}.</strong> {{ $c->question->question }}
								</div>
								<div class="col-xs-4" align="right">
									<ul class="list-inline">
										<li>
											<span class="label {{ ($c->answer=='A')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'A')? 'label-success' : 'label-default') }}">A</span>
										</li>
										<li>
											<span class="label {{ ($c->answer=='B')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'B')? 'label-success' : 'label-default') }}">B</span>
										</li>
										<li>
											<span class="label {{ ($c->answer=='C')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'C')? 'label-success' : 'label-default') }}">C</span>
										</li>
										<li>
											<span class="label {{ ($c->answer=='D')? (($c->answer==$c->question->answer)? 'label-success' : 'label-danger'): (($c->question->answer == 'D')? 'label-success' : 'label-default') }}">D</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="collapse well" id="collapse-{{ $c->number }}" aria-expanded="false">
							<p>{{ $c->question->question }}</p>
							<div class="question {{ ($c->answer=='A')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'A')? 'question-success' : 'question-info') }}">
								<p><strong>A. </strong> {{ $c->question->optionA }}</p>
							</div>
							<div class="question {{ ($c->answer=='B')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'B')? 'question-success' : 'question-info') }}">
								<p><strong>B. </strong> {{ $c->question->optionB }}</p>
							</div>
							<div class="question {{ ($c->answer=='C')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'C')? 'question-success' : 'question-info') }}">
								<p><strong>C. </strong> {{ $c->question->optionC }}</p>
							</div>
							<div class="question {{ ($c->answer=='D')? (($c->answer==$c->question->answer)? 'question-success' : 'question-danger'): (($c->question->answer == 'D')? 'question-success' : 'question-info') }}">
								<p><strong>D. </strong> {{ $c->question->optionD }}</p>
							</div>
							<div>
								<p><strong>Explicación:</strong></p>
								<p>{{ $c->question->description }}</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$(".nav-tabs a").click(function(){
			$(this).tab('show');
		});
		$('#circle').circleProgress({
			value: {{ count($correct)/$session->exam->questions }},
		}).on('circle-animation-progress', function(event, progress, stepValue) {
			$(this).find('strong').html(parseInt(100 * stepValue.toFixed(2).substr(1)) + '<i>%</i>');
		});
	});
</script>
@endsection