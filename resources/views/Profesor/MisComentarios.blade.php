@extends('layouts.app')
@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
IMG.calificacionProfesor{
  display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 50%;
  width:100px;
  height:100px;
  margin-top:5px;
  margin-bottom:20px;
}
svg {
  width: 100px;
  display: block;
  margin: 40px auto 0;
}
.path {
  stroke-dasharray: 1000;
  stroke-dashoffset: 0;
  &.circle {
    -webkit-animation: dash .9s ease-in-out;
    animation: dash .9s ease-in-out;
  }
  &.line {
    stroke-dashoffset: 1000;
    -webkit-animation: dash .9s .35s ease-in-out forwards;
    animation: dash .9s .35s ease-in-out forwards;
  }
  &.check {
    stroke-dashoffset: -100;
    -webkit-animation: dash-check .9s .35s ease-in-out forwards;````````11111111111111111111111111111111111111
    animation: dash-check .9s .35s ease-in-out forwards;
  }
}
p {
  text-align: center;
  font-size: 1.25em;
  &.success {
    color: #73AF55;
  }
  &.error {
    color: #D06079;
  }
}

@-webkit-keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@-webkit-keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}

@keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}
</style>
<div class="container">
@if (Auth::user()->is_profesor == true)
@if (Auth::user()->is_tutor == true)                
<div class="navar">
    <ul class="nav nav-pills"> 
        <li><a href="{{ url('/login') }}">Inicio</a></li>
        <li><a href="{{ url('/Profesor/MisAlumnos/'.encrypt(Auth::user()->id))}}">Mis Alumnos</a></li>                            
        <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
<li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>  
     </ul>
</div>
                                                  
@else            
<div class="navar">
    <ul class="nav nav-pills">
        <li><a href="{{ url('/login') }}">Inicio</a></li>
        <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
        <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>                                                
      </ul>
</div>
                                              
@endif
@endif
    <div class="row">
        <div class="col-12 col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">Mis Comentarios</div>                    
                    <div class="panel-body">                    
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thread>
                                    <tr>                                        
                                        <th>Comentario</th>
                                        <th>Calificacion</th>
                                        <th>Fecha</th>                                                                              
                                    </tr>
                                    </thread>
                                    <tbody>
                                    <tbody>
                                    @if($comentarios)
                                        @foreach($comentarios as $comentarios)
                                            <tr>                                                
                                                <th>{{$comentarios->comentario}}</th>
                                                <th>{{$comentarios->calificacion}}</th>
                                                <th>{{$comentarios->fecha}}</th>                                                                                            
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>                                                           
                            </div>                                                         
                        </div>
                    </div>
                </div>
            </div>               
    </div>
</div> 
@endsection

