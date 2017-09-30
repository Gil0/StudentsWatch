@extends('layouts.app')

@section('content')
<div class="container">
@if(Auth::guest())
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Bienvenido</div>
                <div class="panel-body">
                    Hola Usuario no registrado.
                </div>
            </div>
        </div>
    </div>
</div>      
@else
    @if (Auth::user()->is_admin == true)
        @if (Auth::user()->is_profesor == true)
            <div class="navar">
                <ul class="nav nav-pills">                                            
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                </ul>
            </div>
        @else
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                 </ul>
            </div>
        @endif       
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Bienvenido</div>
                        <div class="panel-body">
                            Hola Administrador.
                        </div>
                    </div>
                </div>
            </div>
        </div>                                 
    @else
        @if (Auth::user()->is_profesor == true)
            @if (Auth::user()->is_tutor == true)
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mis alumnos</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/login') }}">Mi Información</a></li>
                    <li><a href="{{ url('/login') }}">Ver Comentarios</a></li>
                 </ul>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bienvenido</div>
                            <div class="panel-body">
                                Hola Tutor.
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            @else
            <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/login') }}">Ver Comentarios</a></li>                                                
                  </ul>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bienvenido</div>
                            <div class="panel-body">
                                Hola is_profesor.
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            @endif
        @else
            <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mi Mapa Curricular</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/login') }}">Ver Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Ver Comentarios</a></li>
                 </ul>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bienvenido</div>
                            <div class="panel-body">
                                Hola Alumno.
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        @endif                                        
    @endif  
@endif       
@endsection
