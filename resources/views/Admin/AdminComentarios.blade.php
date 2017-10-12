@extends('layouts.app')
@section('content')
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
    

    <div class="col-sm-9">
        <div>
          <p class="profesor">Profesores</p>
        </div>
       
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-hover">
              <thread>
                <tr>
                  <th class="head">Id</th>
                  <th class="head">Comentario</th>
                  <th class="head">Calificacion</th>
                  <th class="head text-center">Status</th>
                  <th class="head text-center">Eliminar</th>
                </tr>
              </thread>
              <tbody>
              @foreach($comentarios as $comentarios)
                <tr class="rowsTabla">
                  <th scope="row">{{$comentarios->idComentario}}</th>
                  <th id="comentario">{{$comentarios->comentario}}</th>
                  <th>{{$comentarios->calificacion}}</th>
                  <th class="text-center">
                  <!-- Single button -->
                  <div class="btn-group">
                    <button type="button" class="btn statusBtn" style="width:200%;" id="{{$comentarios->idComentario}}" value="{{$comentarios->status}}">
                      <i class="fa fa-bullseye" aria-hidden="true"></i>
                    </button>
                  </div>
                  </th>
                  <th> <div align="center"> <i class="fa fa-trash fa-2x icondelete" aria-hidden="true" value="{{$comentarios->idComentario}}"></i></div></th>
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

<!-- modal Nuevo Profesor-->
<div class="modal fade" id="nuevoProfesor" tabindex="-1" role="dialog" aria-labelledby="Nuevo Profesor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Profesor</h4>
      </div>
      <form action="/admin/profesor/crear" method="POST">
      {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
        <div class="modal-body">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" required><br>
            <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" required><br>
            <input type="text" class="form-control" placeholder="Cubiculo" name="cubiculo" required><br>
            <input type="email" class="form-control" placeholder="Correo Electronico" name="email" required><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="crearProfesor">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal informacion Profesor-->
<div class="modal fade" id="verEvento" tabindex="-1" role="dialog" aria-labelledby="Ver Profesor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="informacionProfesor">
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- modal seguridad eliminar evento-->
<div class="modal fade" id="eliminarComentario" tabindex="-1" role="dialog" aria-labelledby="Eliminar Profesor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar éste comentario?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarComentario">
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
           $('#eliminarComentario').modal('show');
           $('form#eliminarComentario').attr('action','/Admin/Comentarios/'+$(this).attr('value')+'/eliminar');
         });
    });
  
</script>

@endsection