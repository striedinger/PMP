@extends('layouts.app')

@section('title')
Inicio
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Inicio</div>

                <div class="panel-body">
                    <p>
                        @if(!Auth::user()->isAdmin())
                            @if(Auth::user()->expiration>=date('Y-m-d'))
                                <p><strong>{{ Auth::user()->name }}</strong>, tienes {{ ceil(abs(strtotime(Auth::user()->expiration) - strtotime(date('Y-m-d'))) / 86400) }} día(s) de acceso para disfrutar y practicar con tu simulador PMP. Si deseas ampliar tu suscripción puedes contactarnos a <a href="mailto:info@pmlsolutionsgroup.com">info@pmlsolutionsgroup.com</a></p>
                            @else 
                                <p><strong>{{ Auth::user()->name }}</strong>, no tienes una subscripción activa de acceso para disfrutar y practicar con tu simulador PMP. Para obtener tu suscripción puedes contactarnos a <a href="mailto:info@pmlsolutionsgroup.com">info@pmlsolutionsgroup.com</a></p>
                            @endif
                        @else 
                            <p><strong>{{ Auth::user()->name }}</strong>, desde aquí podrás configurar todo lo relacionado a los exámenes, preguntas y usuarios. Además, podrás ver los resultados en tiempo real de los usuarios.</p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->expiration>=date('Y-m-d'))
    <div class="row">
        @foreach($exams as $exam)
        <div class="col-xs-12 col-md-4">
            <div class="panel {{ ($exam->type=='Aleatorio')? 'panel-success' : (($exam->type=='Area')? 'panel-info' : 'panel-warning') }}">
                <div class="panel-heading">
                    {{ $exam->name }}
                </div>
                <div class="panel-body">
                    <div class="well">
                        {{ (isset($exam->description))? $exam->description : 'No hay descripcíon para este tipo de examen.'}}
                    </div>
                    <p><strong>Tipo de Examen: </strong>{{ $exam->type }}</p>
                    <p><strong>Numero de Preguntas: </strong> {{ $exam->questions }}</p>
                    <p><strong>Duracíon: </strong>{{ ($exam->duration!=0)? $exam->duration : 'Ilimitada' }}</p>
                    {!! Form::open(['action' => array('SessionController@create', $exam->id), 'method' => 'get', 'onsubmit' => 'return confirm("¿Estas seguro de querer  iniciar este examen?")']) !!}
                    @if($exam->type=='Area')
                    <div class="form-group">
                        <label>Area de Conocimiento:</label>
                        {{ Form::select('area_id', $areas, null, ['class' => 'form-control']) }}
                    </div>
                    @endif
                    @if($exam->type=='Proceso')
                    <div class="form-group">
                        <label>Grupo de Proceso:</label>
                        {{ Form::select('process_id', $processes, null, ['class' => 'form-control']) }}
                    </div>
                    @endif
                    <button class="btn btn-primary btn-block"><i class="fa fa-play"></i> Iniciar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
