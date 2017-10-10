@extends('layouts.app')

@section('content')
<style>
IMG.imagenUsuario{
  display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 50%;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  width:256px;
  height:256px;
  margin-top:5px;
  margin-bottom:20px;
}
</style>
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading labelmenu">Imagen de Perfil</div>
                <div class="panel-body">              
                    <form id="editarImagen" class="form-horizontal" action="{{ url('/configuracion/'.encrypt($info->id).'/guardarImagen') }}" method="POST" enctype="multipart/form-data">                                                                           
                    {{ csrf_field() }}
                        <div class="form-group">
                            @if($info->imagen!=null)
                                <img class="imagenUsuario" src="{{ asset( 'uploads/'.$info->imagen)}}" alt="Imagen Usuario">                    
                            @else
                                <img class="imagenUsuario" src="../assets/img/default_user.png" alt="Imagen Usuario">
                            @endif 
                        </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Imagen de Perfil</label>
                    <div class="col-lg-10 col-sm-10 col-10">
                      <div class="input-group">
                        <label class="input-group-btn">
                          <span class="btn btn-primary">
                            Seleccionar Archivo&hellip; 
                            <input type="file" style="display: none;" name="imagen" accept="image/*" required>
                          </span>
                        </label>
                        <input type="text" class="form-control" value="{{$info->imagen}}" readonly>                        
                      </div>    
                       
            
                          
                      
                      <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
                       @if ($errors->has('imagen'))
                       <div class="col-sm-10">
                          <span class="help-block">
                            <strong>{{ $errors->first('imagen') }}</strong>
                          </span>
                        </div>
                        @endif
                      </div>
                      <!--
                        <span class="help-block">
                          Try selecting one or more files and watch the feedback
                        </span>
                      -->
                    </div>
                  </div>
                  <!--
                    <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Imagen de Perfil</label>
                          <div class="col-sm-10">                        
                            <input type="file" class="form-control" name="imagen" accept="image/*" required>
                              @if ($errors->has('imagen'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('imagen') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>
                    </div> 
                    -->
                      <div class="form-group">
                        <div class="col-sm-10 col-md-offset-2">
                          <button id="guardarImagen" type="submit" class="btn btn-primary form-control" >Cambiar Imagen</button>
                        </div>
                      </div>                                              
                    </form>
                </div>
            </div>
        </div>
    </div>                 
          <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading labelmenu">Información de Cuenta</div>
                  <div class="panel-body">                    
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
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">Cambiar Contraseña</div>
                    
            
                    <div class="panel-body">
                     <form  class="form-horizontal" method="post"  action="{{ url('/configuracion/'.encrypt($info->id).'/updatepassword') }}">
                            {{csrf_field()}}
                       
                            <div class="form-group">
                                <label for="mypassword" class="col-sm-2 control-label">Contraseña Actual</label>
                             <div class="col-sm-10">
                                 <input type="password"  name="mypassword" class="form-control" >
                             </div>
                             @if (Session::has('message'))
                        <div class="text-danger">
                            {{Session::get('message')}}
                        </div>
                    @endif
                              <div class="text-danger" align="center">{{$errors->first('mypassword')}}</div>
                            </div>
                            
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Nueva Contraseña</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" name="password">
                            </div>
                            <div class="text-danger" align="center">{{$errors->first('password')}}</div>
                        </div>

                        <div class="form-group">
                            <label for="mypassword" class="col-sm-2 control-label">Repetir Contraseña</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div> 
                     
                        <div class="form-group">
                        <div class="col-sm-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary form-control">Cambiar mi contraseña</button>
                          </form>
                          @if (Session::has('status'))
                          <div class="alert alert-success">
                            <strong>{{Session::get('status')}}</strong>
                        </div>
                        </div>      
                        
                    @endif
                        

                    </div> 
                </div>         
            </div>
         
        </div>
    </div>
    </div>
</div>


</div>
<script>
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
});
</script>
@endsection
