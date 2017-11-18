@extends('layouts.app')
@section('content')
<style>
    i.fa-trash{
      color: #d9534f;
    }
    i.fa-trash:hover{
        color:red;
    }
</style>
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
</style>
<div class="container">
<div class="navar">
<ul class="nav nav-pills logindiv7 navbar-brand"> 
    <li><a href="{{ url('/') }}">Inicio</a></li>
    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
</ul>
</div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                    <div class="panel-body logindiv1">
                <center>  <p class=letra2> Alumnos registrados en el sistema</p> </center>

                    <div class="panel panel-default">
                        <div class="panel-body">
                        <table class="table">
                        <thread class="thead-inverse">
                            <tr>
                                <th> <div align="center"># </div></th>
                              <th> <div align="center">Nombre </div> </th>
                              <th> <div align="center">matricula </div> </th>
                              <th> <div align="center">email </div> </th>
                               <th><div align="center">Eliminar</div> </th>
                            </tr>
                        </thread>
                        <tbody>
                        @foreach($users as $users)
                            <tr>
                             <th scope="row"><div align="center"> {{$users->id}}</div></th>
                             <th><div align="center"> {{$users->name}}</div> </th>
                             <th><div align="center"> {{$users->matricula}}</div> </th>
                             <th><div align="center"> {{$users->email}}</div> </th>
                            <th> <div align="center"> <i class="fa fa-trash fa-2x icondelete" aria-hidden="true" value="{{$users->id}}"></i></div></th>
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
</div>

<div class="modal fade" id="eliminarAlumno" tabindex="-1" role="dialog" aria-labelledby="Eliminar Profesor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar éste Alumno?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarAlumno">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" style="width:100%;">SI</button>
        </form>
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){  
         $('i.fa-trash').click(function(){
           $('#eliminarAlumno').modal('show');
           $('form#eliminarAlumno').attr('action','/Admin/Alumno/'+$(this).attr('value')+'/eliminar');
         });
    });
</script>


@endsection