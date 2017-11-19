@extends('layouts.app')
@section('content')
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
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<div class="container">
@if (Auth::user()->is_profesor == true)
  @if (Auth::user()->is_tutor == true)                
  <div class="navar">
      <ul class="nav nav-pills"> 
          <li><a href="{{ url('/login') }}">Inicio</a></li>
          <li><a href="{{ url('/login') }}">Mis Alumnos</a></li>
          <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
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

            <div class="panel panel-success">
                <div class="panel-heading">Mis Alumnos</div>                    
                    <div class="panel-body">                    
                        <div class="panel panel-default">
                            <div class="panel-body">
                               <table class="table table-hover">
                                  <thread>
                                      <tr>                                      
                                          <th>Nombre</th>
                                          <th>Email</th>
                                          <th>Matricula</th>
                                          <th>Eliminar</th>                                                                              
                                      </tr>
                                  </thread>
                                  <tbody>                             
                                      @if($misAlumnos)
                                          @foreach($misAlumnos as $misAlumnos)
                                              <tr>                                                  
                                                  <th>{{$misAlumnos->name}} </th>
                                                  <th>{{$misAlumnos->email}} </th>
                                                  <th>{{$misAlumnos->matricula}} </th>
                                                  <th><center><i class="fa fa-trash fa-2x icondelete" id="EliminarAlumnoSolicitud" aria-hidden="true" value="{{$misAlumnos->idAlumno}}"></i><center></th>                                                  
                                              </tr>
                                          @endforeach
                                      @endif                            
                                  </tbody>
                              </table>                                                
                            </div>                                                         
                        </div>
                    </div>
            </div>
                           

            <div class="panel panel-info">
                <div class="panel-heading">Alumnos</div>                    
                    <div class="panel-body">                    
                        <div class="panel panel-default">
                            <div class="panel-body">
                              <table class="table table-hover">
                                  <thread>
                                      <tr>                                      
                                          <th>Nombre</th>
                                          <th>Email</th>
                                          <th>Matricula</th>
                                          <th>Rechazar Solicitud</th>
                                          <th>Aceptar Solicitud</th>                                    
                                      </tr>
                                  </thread>
                                  <tbody>                             
                                      @if($alumnos)
                                          @foreach($alumnos as $alumnos)
                                              <tr>                                                  
                                                  <th>{{$alumnos->name}} </th>
                                                  <th>{{$alumnos->email}} </th>
                                                  <th>{{$alumnos->matricula}} </th>
                                                  <th><center><i class="fa fa-trash fa-2x icondelete" id="EliminarAlumnoSolicitud" aria-hidden="true" value="{{$alumnos->idAlumno}}"></i><center></th>
                                                  <th><center><i class="fa fa-graduation-cap fa-2x" aria-hidden="true" id="{{$alumnos->idAlumno}}" value="{{$alumnos->statusMiTutor}}" name="{{$alumnos->user_id}}"></i></center></th>                                    
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
<!--Eliminar Solicitud Alumno-->
<div class="modal fade" id="eliminarSolicitudAlumnoModal" tabindex="-1" role="dialog" aria-labelledby="Eliminar Solicitud de Alumno">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar ésta Solicitud?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarSolicitudAlumno">
            {{ csrf_field() }}
            @if($alumnos)
              <input type="hidden" value="{{$alumnos->idAlumno}}" name="idAlumno">
              <input type="hidden" value="{{$alumnos->user_id}}" name="ID">
            @endif
            <button type="submit" class="btn btn-danger" style="width:100%;">SI</button>
        </form>
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){

         $('i#EliminarAlumnoSolicitud').click(function(){       
           $('#eliminarSolicitudAlumnoModal').modal('show');
           $('form#eliminarSolicitudAlumno').attr('action','/Profesor/MisAlumnos/'+$(this).attr('value')+'/eliminarSolicitud');
         });  

         $('i.fa-graduation-cap').each(function(){
            if($(this).attr('value') == "Revision"){
                $(this).css("color","black");    
             }
             else{
                 $(this).css("color","#ffcc66");
             }
         });

        $('i.fa-graduation-cap').click(function(){            
          if($(this).attr('value') == "Revision"){                 
            $(this).css("color","#ffcc66");
            $(this).attr('value',"Aceptado");                
          }
          else{                
            $(this).css("color","black")   
            $(this).attr('value',"Revision");                 
          }
             $.ajax({
                 url:'/Profesor/MisAlumnos/'+$(this).attr("id")+'/aceptarSolicitud',
                 type:'POST',
                 dataType:'json',
                 data:{                   
                    'idUsuario': $(this).attr('name'), 
                    'statusMiTutor': $(this).attr('value')                     
                 },beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                 success:function(response){
                     alert(response);
                    location.reload();
                }
             });
         });  
    });
</script>  
@endsection

