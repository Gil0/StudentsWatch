@extends('layouts.app')
@section('content')
<style>
    i.fa-info-circle{
      color: green;
    }
    i.fa-info-circle:hover{
        color:#47d147;
    }
    i.fa-commenting{
      color: #0080ff;
    }
    i.fa-commenting:hover{
        color:#0039e6;
    }
    i.fa-trash{
      color: #d9534f;
    }
    i.fa-trash:hover{
        color:red;
    }
    
</style>
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

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
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default logindiv3">
                <div class="panel-heading letra2">Funciones Administrador Profesores</div>
                <div class="panel-body">
                    Aqui se llevan a cabo las funciones del administrador sobre los profesores.                    

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thread>
                                    <tr class="rowsTabla">
                              <!--          <th>id</th> -->
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
                                    <!--   <th><center>{{$profesores->idProfesor}}</center></th> -->
                                        <th><center>{{$profesores->name}}</center></th>
                                        <th><center>{{$profesores->matricula}}</center></th>
                                        <th><center><i class="fa fa-info-circle fa-2x" aria-hidden="true" value="{{$profesores->idProfesor}}"></i></center></th>
                                        <th><center><i class="fa fa-commenting fa-2x" aria-hidden="true" value="{{$profesores->idProfesor}}"></i></center></th>
                                        <th><center> <i class="fa fa-trash fa-2x fa-align-center" aria-hidden="true" value="{{$profesores->id}}"></i> </center></th>
                                        <th><center><i class="fa fa-graduation-cap fa-2x" aria-hidden="true" id="{{$profesores->id}}" value="{{$profesores->is_tutor}}"></i></center></th>
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

      $('i.fa-graduation-cap').each(function(){
             if($(this).attr('value') == 0){
                $(this).css("color","black");    
             }
             else{
                 $(this).css("color","#ffcc66");
             }
         });

         $('i.fa-graduation-cap').click(function(){
            
             if($(this).attr('value') == 0)
             {
                 
                 $(this).css("color","#ffcc66");
                 $(this).attr('value',1);
                
             }
             else{
                
                $(this).css("color","black")   
                 $(this).attr('value',0);
                 
             }
             $.ajax({
                 url:'/Admin/Profesores/'+$(this).attr("id")+'/hacerTutor',
                 type:'POST',
                 dataType:'json',
                 data:{
                     'is_tutor': $(this).attr('value')
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
  

                   
        $('i.fa-info-circle').click(function(){
            window.location.href = '/Admin/Profesores/'+$(this).attr('value')+'/Ver';
         } );
         
        $('i.fa-commenting').click(function(){
           window.location.href = '/Admin/Comentarios/'+$(this).attr('value')+'/ver';
        });
</script>

@endsection