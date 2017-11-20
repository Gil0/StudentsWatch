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

    i.fa-trash{
      color: #d9534f;
    }
    i.fa-trash:hover{
        color:red;
    }
   
    i.fa-pencil-square{
      color: #2eb82e;
    }
    i.fa-pencil-square:hover{
        color:#145214;
    }
  
</style>

    <div class="container">
      <div class="navar">
        <ul class="nav nav-pills"> 
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
            <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
            <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
            <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
        </ul>
     </div>
     <div class="col-sm-12">
                <div align="center" >
                    <p class="profesor">Materias</p>
                </div>
                <div align="center">
                <div class="panel-heading">

                <button class="btn btn-success" id="nuevaMat" style="width:100%;" data-toggle="modal" data-target="#nuevaMateria">Nueva Materia</button>
               </div>
                </div>

                 <!-- Modal Agregar materia -->
                    <div class="modal fade" id="nuevaMateria" tabindex="-1" role="dialog" aria-labelledby="Nueva Materia">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Nueva Materia</h4>
                        </div>
                        <form action="/Admin/materia/crear/" method="POST">
                        {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
                            <div class="modal-body">
                                <input type="text" class="form-control" placeholder="materia" name="materia" required><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="crear">Guardar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>

                <div class="panelesp">
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thread class="thead-inverse">
                                <tr>
                                    <th> <div align="center"># </div></th>
                                  <th> <div align="center">Nombre </div> </th>
                                    <th> <div align="center">Editar</div> </th>
                                   <th><div align="center">Eliminar</div> </th>
                                </tr>
                            </thread>
                            <tbody>
                            @if($materias)
                            @foreach($materias as $materias)
                                <tr>
                                 <th scope="row"><div align="center"> {{$materias->idMateria}}</div></th>
                                 <th><div align="center"> {{$materias->nombre}}</div> </th>
                                  <th> <div align="center"> <i class="fa fa-pencil-square fa-2x iconpencil" aria-hidden="true" value="{{$materias->idMateria}}"></i></div></th>
                                <th> <div align="center"> <i class="fa fa-trash fa-2x icondelete" aria-hidden="true" value="{{$materias->idMateria}}"></i></div></th>
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


<!-- modal seguridad eliminar materia-->
<div class="modal fade" id="eliminarMateria" tabindex="-1" role="dialog" aria-labelledby="Eliminar Profesor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar ésta materia?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarMa">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" style="width:100%;">SI</button>
        </form>
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>

<!-- modal Editar materia -->
<div class="modal fade" id="editarMateria" tabindex="-1" role="dialog" aria-labelledby="Editar Materia">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Materia </h4>
      </div>
      <form id="formEditarMateria" action="" method="POST">
      {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
        <div class="modal-body">
        <input type="text" required placeholder="Nombre de la materia" class="form-control" id="nombre" name="nombre" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="crear">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
<script>
    $(document).ready(function(){               
        $('i.fa-trash').click(function(){
           $('#eliminarMateria').modal('show');
           $('form#eliminarMa').attr('action','/Admin/Materia/'+$(this).attr('value')+'/eliminar');
         });
         
       $('i.fa-pencil-square').click(function(){
            $('#editarMateria').modal('show'); 
            $('form#formEditarMateria').attr('action', '/Admin/Materia/'+$(this).attr('value')+'/editar' );
        });
      

    });
</script>

@endsection