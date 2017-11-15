@extends('layouts.app')

@section('content')
<!--<meta name="csrf_token" content="{{ csrf_token() }}" /> <!Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
    @import url('http://fonts.googleapis.com/css?family=Julius+Sans+One');
    @import url('https://fonts.googleapis.com/css?family=Anton');
  
    .profesor{
        color: #3385ff;
        font-family: 'Anton', sans-serif;
        letter-spacing: 2px;
        font-size: 50px;
    }

    }
</style>

    @if (Auth::user()->is_admin == true)
        @if (Auth::user()->is_profesor == true)                                                        
            @if (Auth::user()->is_tutor == true)                
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mis alumnos</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/login') }}">Mi Información</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                 </ul>
            </div>
            
            @else                
                <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>                                                
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores/') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                  </ul>
            </div>
           
            @endif                                        
        @else            
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                 </ul>
            </div>
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
        @endif                                        
    @else
        @if (Auth::user()->is_profesor == true)
            @if (Auth::user()->is_tutor == true)                
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mis Alumnos</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/login') }}">Mi Información</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>
                 </ul>
            </div>
                                                       
            @else            
            <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>                                                
                  </ul>
            </div>
                                          
            @endif
        @else            
            <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mi Mapa Curricular</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/Usuario/Profesores') }}">Ver Profesores</a></li>
                    <li><a href="{{ url('/Usuario/Materias') }}">Ver Materias</a></li>
                 </ul>
            </div>
                                                             
        @endif                                        
    @endif 

            <div class="col-sm-9">
                <div align="center" >
                    <p class="profesor">Materias</p>
                </div>
                <div class="panelesp">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thread>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th id="materiaCursada">Agregar Materia Cursada</th>
                                    <th>Agregar Materia en curso</th>
                                </tr>
                            </thread>
                            <tbody>
                            @foreach($materias as $materias)
                                <tr>
                                    <th scope="row">{{$materias->idMateria}}</th>
                                    <th>{{$materias->nombre}} </th>
        
                                   
                                    <th>
                                        <div class="panel-heading">

                                            <button class="btn btn-success" id="nuevaMateriaCursada" id1="{{$materias->nombre}}" style="width:100%;" value="{{$materias->idMateria}}">Agregar Materia aprobada</button>
                                        </div>
                                    </th>

                                    <th>
                                        <div class="panel-heading">

                                            <button class="btn btn-success materiaEnCurso" id="{{$materias->nombre}}" style="width:100%;" value="{{$materias->idMateria}}">Agregar materia en curso</button>
                                        </div>
                                    </th>

                                   
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="MateriaCursada" tabindex="-1" role="dialog" aria-labelledby="Agregar Materia Cursada">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Materia Cursada </h4>
      </div>

      <form id="formMateriaCursada" method="POST">


      {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
        <div class="modal-body">
           <p>hola {{Auth::user()->name}} estás seguro de que deseas agregar esta materia a tus materias cursadas </p>
           
            <input type="hidden" name="user" value="{{Auth::user()->id}}">
          
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="crearMateriaCursada">Agregar Materia</button>
            <button type="button" readonly class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){               
        $('i.fa-plus-circle').click(function(){
            window.location.href = '/Usuario/Profesores/'+$(this).attr('value')+'/Ver';
         } );
         
        $('i.fa-pencil-square').click(function(){
           window.location.href = '/Usuario/Comentarios/'+$(this).attr('value')+'/ver';
        });
        $('button#nuevaMateriaCursada').click(function(){
            $('#MateriaCursada').modal('show');
            $('form#formMateriaCursada').attr('action', '/user/MateriaCursada/crear/'+$(this).attr('value') + '/' +$(this).attr('id1')  );
        });

        $('button#materiaEnCurso').click(function(){
            $('#MateriaCursada').modal('show');
            $('form#formMateriaCursada').attr('action', '/user/MateriaCursada/crear/'+$(this).attr('value')+ '/' +$(this).attr('id1') );
        });

        $("#cancelar").click(function(){
            $('nuevaMateriaCursada').show();

        });
    });
</script>
@endsection
