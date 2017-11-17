@extends('layouts.app')

@section('content')
<!--<meta name="csrf_token" content="{{ csrf_token() }}" /> <!Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
    @import url('http://fonts.googleapis.com/css?family=Julius+Sans+One');
    @import url('https://fonts.googleapis.com/css?family=Anton'); 
    /*----- Banner -----*/
    .profesor{
        color: #3385ff;
        font-family: 'Anton', sans-serif;
        font-size: 30px;
    }
    .fa-plus-circle{
        color:#005ce6;
    }
    i.fa-plus-circle:hover{
        color:#66a3ff
    }

    i.fa-pencil-square{
      color: #ffcc00;
    }
    i.fa-pencil-square:hover{
        color:#ffe066
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
                    <li><a href="{{ url('/Usuario/Mimapa/'.encrypt(Auth::user()->id)) }}">Mi Mapa Curricular</a></li>
                    <li><a href="{{ url('/Usuario/Progreso/'.encrypt(Auth::user()->id)) }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/Usuario/Profesores') }}">Ver Profesores</a></li>
                    <li><a href="{{ url('/Usuario/Materias') }}">Ver materias</a></li>
                 </ul>
            </div>
                                                             
        @endif                                        
    @endif 

            <div class="col-sm-12">
                <div align="center" >
                    <p class="profesor">Profesores</p>
                </div>
                <div class="container">
                <div class="row">
                 <div class="col-md-10 col-md-offset-1">
                   <div class="panel panel-default">
                     <table class="table table-striped">
                       <thread>
                         <tr>
                           <th class="head">#</th>
                           <th class="head">nombre</th>
                           <th class="head">E-mail</th> 
                           <th class="head">ver mas</th> 
                           <th class="head">Escribir comentario</th> 
                           <th class="head">ver comentarios</th> 
                         </tr>
                       </thread>
                       <tbody>
                       @foreach($profesores as $profesor)
                         <tr class="rowsTabla">
                         <th scope="row">{{$profesor->idProfesor}}</th>
                         <th>{{$profesor->name}} </th>
                            <th>{{$profesor->email}} </th>
                           <th><i class="fa fa-plus-circle fa-2x" aria-hidden="true" value="{{$profesor->idProfesor}}"></i></th>
                                 <th>
                                <div class="panel-heading">
                                   <button class="btn btn-success" id="nuevoCom" style="width:100%;" value="{{$profesor->idProfesor}}">Agregar Comentario</button>
                               </div>
                             </th>
                              <th><i class="fa fa-pencil-square fa-2x iconpencil" aria-hidden="true" value="{{$profesor->idProfesor}}"></i></th>
                         </tr>
                         @endforeach
                       </tbody>
                     </table>
                    <div align="center"> {!! $profesores -> render() !!}</div>
                   </div>
                 </div>
               </div>
             </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nuevoComentario" tabindex="-1" role="dialog" aria-labelledby="Nuevo comentario">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Comentario</h4>
      </div>

      <form id="formComentario" method="POST">


      {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
        <div class="modal-body">
            <input type="text" class="form-control" placeholder="comentario" name="comentario" required><br>
            <input type="number" max=10 min=1 class="form-control" placeholder="calificacion" name="calificacion" required><br>
            <input type="hidden" name="user" value="{{Auth::user()->id}}">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="crearProfesor">Guardar</button>
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
        $('button#nuevoCom').click(function(){
            $('#nuevoComentario').modal('show');
            $('form#formComentario').attr('action', '/user/comentario/crear/'+$(this).attr('value') );
        });

    });
</script>
@endsection
