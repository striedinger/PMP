@extends('layouts.app')

@section('title')
Inicio
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($exams as $exam)
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-primary">
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
                    <a href="{{ url('/sessions/create') . '/' . $exam->id }}" class="btn btn-primary btn-block"><i class="fa fa-play"></i> Iniciar</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
