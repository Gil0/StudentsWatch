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
        font-size: 30px;
    }

</style>
<div class="container">
    
@if (Auth::user()->is_admin == true)
        @if (Auth::user()->is_profesor == true)                                                        
            @if (Auth::user()->is_tutor == true)                
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Profesor/MisAlumnos/'.encrypt(Auth::user()->id))}}">Mis Alumnos</a></li>                    
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li> 
                    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
                    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
                 </ul>
            </div>
            
            @else                
                <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>                                               
                    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
                    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
                  </ul>
            </div>
           
            @endif                                        
        @else            
        <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
                    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
                 </ul>
            </div>                                                
        @endif                                        
    @else
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
        @else            
            <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Usuario/Mimapa/'.encrypt(Auth::user()->id)) }}">Mi Mapa Curricular</a></li>
                    <li><a href="{{ url('/Usuario/Progreso/'.encrypt(Auth::user()->id)) }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/Usuario/Profesores') }}">Ver Profesores</a></li>
                    <li><a href="{{ url('/Usuario/Materias') }}">Ver materias</a></li>
                    <li><a href="{{ url('/Usuario/MiTutor/'.encrypt(Auth::user()->id)) }}">Mi Tutor</a></li>
                 </ul>
            </div>
                                                             
        @endif                                        
    @endif 
</div>


            <div class="col-sm-12">
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
                                    <th id="materiaCursada1">Agregar Materia en curso</th>
                                </tr>
                            </thread>
                            <tbody>
                            @foreach($materias as $materias)
                                <tr>
                                    <th scope="row">{{$materias->idMateria}}</th>
                                    <th>{{$materias->nombre}} </th>
        
                                   
                                    <th>
                                        <div class="panel-heading">

                                            <button class="btn btn-success" id="nuevaMateriaCursada" id1="{{$materias->nombre}}" style="width:95%;" value="{{$materias->idMateria}}">Materia aprobada</button>
                                        </div>
                                    </th>

                                    <th>
                                        <div class="panel-heading">

                                            <button class="btn btn-success" id="NuevaMatEnCurso" id1="{{$materias->nombre}}" style="width:60%;" value="{{$materias->idMateria}}">Materia en curso</button>
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
<!-- modal materia cursada -->
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

<!-- modal materia en curso -->
<div class="modal fade" id="MateriaEncurso" tabindex="-1" role="dialog" aria-labelledby="Agregar Materia en curso">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Agregar Materia En Curso </h4>
    </div>

    <form id="formMateriaEncurso" method="POST">


    {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
      <div class="modal-body">
         <p>hola {{Auth::user()->name}} estás seguro de que deseas agregar esta materia a tus materias que estás cursando? </p>
         
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

        $('button#NuevaMatEnCurso').click(function(){
            $('#MateriaEncurso').modal('show');
            $('form#formMateriaEncurso').attr('action', '/user/MateriaEncurso/crear/'+$(this).attr('value') + '/' +$(this).attr('id1')  );
          
        });

       
    });
</script>
@endsection
