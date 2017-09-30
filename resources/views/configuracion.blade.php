@extends('layouts.app')

@section('content')
<style>
IMG.imagenUsuario{
  display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 50%;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading labelmenu">Información Personal</div>
                  <div class="panel-body">
                   @if($info->imagen!=null)
                      <img class="imagenUsuario" src="{{ url('../storage/app/public/$info->imagen') }}" alt="Imagen Usuario" style="width:256px;height:256px;margin-top:5px;margin-bottom:20px;">  
                    @else
                      <img class="imagenUsuario" src="../assets/img/default_user.png" alt="Imagen Usuario" style="width:256px;height:256px;margin-top:5px;margin-bottom:20px;">
                    @endif  
                    <!--
                    <form id="editarInformacion" class="form-horizontal" action="/configuracion/{{$info->id}}/guardarCambios" method="POST">   
                    -->
                    <form id="editarInformacion" class="form-horizontal" action="{{ url('/configuracion/'.encrypt($info->id).'/guardarCambios') }}" method="POST">                                                           
                    {{ csrf_field() }}
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" value="{{$info->name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Matricula</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="matricula" name="matricula" value="{{$info->matricula}}" readonly>
                        </div>
                      </div>        
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Correo Electronico</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" value="{{$info->email}}" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Imagen de Perfil</label>
                        <div class="col-sm-10">                        
                        <input type="file" class="form-control" id="imagen" name="imagen" value="{{$info->imagen}}">
                        </div>
                    </div>              
                      <input type="hidden" value="{{$info->id}}" name="id">        
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <div class="col-sm-10 col-md-offset-2">
                          <button id="guardarCambios" type="submit" class="btn btn-primary form-control" >Guardar Cambios</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
