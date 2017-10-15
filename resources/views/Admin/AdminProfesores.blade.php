@extends('layouts.app')
@section('content')
<style>
    i.fa-info-circle{
      color: green;
    }
    i.fa-info-circle:hover{
        color:orange;
    }
    i.fa-commenting{
      color: #0080ff;
    }
    i.fa-commenting:hover{
        color:#735CD1;
    }
    i.fa-trash{
      color: #d9534f;
    }
    i.fa-trash:hover{
        color:red;
    }
    .head{
      background-color: #5cb85c;
      color: white; 
    } 
</style>
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
</style>
<div class="container">
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
                <div class="panel-heading">Funciones Administrador Profesores</div>
                <div class="panel-body">
                    Aqui se llevan a cabo las funciones del administrador sobre los profesores.                    

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thread>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Matricula</th>
                                        <th>Ver Información</th>
                                        <th>Ver Comentarios</th>
                                        <th>Eliminar</th>
                                        <th>Convertir en Tutor</th>
                                    </tr>
                                </thread>
                                <tbody>
                                    @foreach($profesores as $profesores)
                                    <tr>
                                        <th>{{$profesores->name}}</th>
                                        <th>{{$profesores->matricula}}</th>
                                        <th><i class="fa fa-info-circle fa-2x" aria-hidden="true" value="{{$profesores->id}}"></i></th>
                                        <th><i class="fa fa-commenting fa-2x" aria-hidden="true" value="{{$profesores->id}}"></i></th>
                                        <th><i class="fa fa-trash fa-2x fa-align-center" aria-hidden="true" value="{{$profesores->id}}"></i></th>
                                        <th><i class="fa fa-graduation-cap fa-2x" aria-hidden="true" value="{{$profesores->id}}"></i></th>
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

<!-- modal seguridad eliminar evento-->
<div class="modal fade" id="eliminarProfesor" tabindex="-1" role="dialog" aria-labelledby="Eliminar Profesor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar éste profesor?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarProfesor">
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

      $('.rowsTabla > th > div > button').each(function(){
             if($(this).attr('value') == 0){
                 $(this).addClass("btn-danger");
             }
             else{
                 $(this).addClass("btn-success");
             }
         });

         $('.rowsTabla > th > div > button').click(function(){
             //alert($(this).attr('id'));
             if($(this).attr('value') == 0)
             {
                 $(this).removeClass('btn-danger');
                 $(this).addClass('btn-success');
                 $(this).attr('value',1);
             }
             else{
                 $(this).removeClass('btn-success');
                 $(this).addClass('btn-danger');
                 $(this).attr('value',0);
             }
             $.ajax({
                 url:'/Admin/Comentarios/'+$(this).attr("id")+'/cambiarStatus',
                 type:'POST',
                 dataType:'json',
                 data:{
                     'status': $(this).attr('value')
                 },beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                 success:function(response){
                     alert(response);
                 }
             });
         });

         $('i.fa-trash').click(function(){
           $('#eliminarProfesor').modal('show');
           $('form#eliminarProfesor').attr('action','/Admin/Profesor/'+$(this).attr('value')+'/eliminar');
         });
    });
  
</script>

@endsection