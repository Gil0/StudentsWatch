@extends('layouts.app')
@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
IMG.calificacionProfesor{
  display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 50%;
  width:100px;
  height:100px;
  margin-top:5px;
  margin-bottom:20px;
}
svg {
  width: 100px;
  display: block;
  margin: 40px auto 0;
}
.path {
  stroke-dasharray: 1000;
  stroke-dashoffset: 0;
  &.circle {
    -webkit-animation: dash .9s ease-in-out;
    animation: dash .9s ease-in-out;
  }
  &.line {
    stroke-dashoffset: 1000;
    -webkit-animation: dash .9s .35s ease-in-out forwards;
    animation: dash .9s .35s ease-in-out forwards;
  }
  &.check {
    stroke-dashoffset: -100;
    -webkit-animation: dash-check .9s .35s ease-in-out forwards;````````11111111111111111111111111111111111111
    animation: dash-check .9s .35s ease-in-out forwards;
  }
}
p {
  text-align: center;
  font-size: 1.25em;
  &.success {
    color: #73AF55;
  }
  &.error {
    color: #D06079;
  }
}

@-webkit-keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@-webkit-keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}

@keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}
</style>
<div class="container">
@if (Auth::user()->is_profesor == true)
@if (Auth::user()->is_tutor == true)                
<div class="navar">
    <ul class="nav nav-pills"> 
        <li><a href="{{ url('/login') }}">Inicio</a></li>
        <li><a href="{{ url('/login') }}">Mis Alumnos</a></li>
        <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
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
@endif
    <div class="row">
        <div class="col-12 col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">Información Personal</div>
                    
                    <div class="panel-body">             
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form id="editarInformacionPersonal" class="form-horizontal" action="{{ url('/Profesor/Informacion/'.encrypt($informacionProfesor->user_id).'/guardarInformacionPersonal') }}" method="POST">                                    
                                    @if($informacionProfesor->descripcion==null)
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descripción</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Escribe una breve descripción sobre ti..." maxlength="300"></textarea>
                                            </div>
                                        </div>                       
                                    @else
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Descripción</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="300">{{$informacionProfesor->descripcion}}</textarea>
                                            </div>
                                        </div>  
                                    @endif

                                    @if($informacionProfesor->cubiculo==null)
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Cubículo</label>
                                            <div class="col-sm-10">                                                                                                                                                                        
                                                <input type="text" class="form-control" id="cubiculo" name="cubiculo" value="{{$informacionProfesor->cubiculo}}" placeholder="Ingrese su Cubículo...">                                                
                                            </div>
                                        </div>                       
                                    @else
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Cubículo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="cubiculo" name="cubiculo" value="{{$informacionProfesor->cubiculo}}">
                                            </div>
                                        </div>  
                                    @endif
                                    
                                    @if($informacionProfesor->hobbies==null)
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Hobbies</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="hobbies" name="hobbies" rows="3" placeholder="Escribe cuales son tus pasatiempos..." maxlength="150"></textarea>
                                            </div>
                                        </div>                       
                                    @else
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Hobbies</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="hobbies" name="hobbies" rows="3" maxlength="150">{{$informacionProfesor->hobbies}}</textarea>
                                            </div>
                                        </div>  
                                    @endif
                                    <!--[if lte IE 9]>
                                    <style>
                                        .path {stroke-dasharray: 0 !important;}
                                    </style>
                                    <![endif]-->                               
                                    @if($informacionProfesor->calificacion<=0.0)
                                        <img src="{{URL::asset('/assets/img/waiting.png')}}" alt="CalificacionProfesor" class="calificacionProfesor"/>                                                                   
                                        <p class="success">Calificación: {{$informacionProfesor->calificacion}}</p>
                                        <p class="success">Esperando ser evaluado ...</p>
                                    @elseif($informacionProfesor->calificacion>0.0 && $informacionProfesor->calificacion<=6.0)
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                        <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                        <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                                        <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
                                        </svg>
                                        <p class="success">Calificación: {{$informacionProfesor->calificacion}}</p>
                                        <p class="success">Deficiente</p>
                                    @elseif($informacionProfesor->calificacion>6.0 && $informacionProfesor->calificacion<=7.5)
                                        <img src="{{URL::asset('/assets/img/warning.png')}}" alt="CalificacionProfesor" class="calificacionProfesor"/>                                                                   
                                        <p class="success">Calificación: {{$informacionProfesor->calificacion}}</p>
                                        <p class="success">Regular</p>
                                    @elseif($informacionProfesor->calificacion>7.5 && $informacionProfesor->calificacion<=8.5)
                                        <img src="{{URL::asset('/assets/img/bueno.png')}}" alt="CalificacionProfesor" class="calificacionProfesor"/>                                                                   
                                        <p class="success">Calificación: {{$informacionProfesor->calificacion}}</p>
                                        <p class="success">Bueno</p>
                                    @else
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                        <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                        <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                                        </svg>
                                        <p class="success">Calificación: {{$informacionProfesor->calificacion}}</p>
                                        <p class="success">Excelente</p>
                                    @endif

                                    <input type="hidden" value="{{$informacionProfesor->user_id}}" name="id">        
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                      

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="guardarCambios" type="submit" class="btn btn-primary form-control" >Guardar Cambios</button>
                                        </div>
                                    </div>
                                </form>                                  
                            </div>
                        </div>
                        
                    </div>
                </div>
            

            <div class="panel panel-default">
                <div class="panel-heading">Información Académica</div>                    
                    <div class="panel-body">                    
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thread>
                                    <tr>                                        
                                        <th>Escuela</th>
                                        <th>Estudios</th>
                                        <th>Periodo</th>
                                        <th></th>
                                        <th>Eliminar</th>
                                        <th></th>                                        
                                    </tr>
                                    </thread>
                                    <tbody>
                                    <tbody>
                                    @if($academica)
                                        @foreach($academica as $academica)
                                            <tr>                                                
                                                <th>{{$academica->escuela}}</th>
                                                <th>{{$academica->estudios}}</th>
                                                <th>{{$academica->periodo}}</th>                                            
                                                <th></th>
                                                <th><span><i class="fa fa-trash fa-2x icondelete" id="EliminarAcademica" aria-hidden="true" value="{{$academica->idFormacionAcademica}}"></i></span></th>
                                                <th></th>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="panel-heading">
                                    <button class="btn btn-success" style="width:100%;" data-toggle="modal" data-target="#nuevaInformacionAcademica">Nueva Informacion Académica</button>
                                </div>                           
                            </div>                                                         
                        </div>
                    </div>
                </div>
       

            <div class="panel panel-default">
                <div class="panel-heading">Información Laboral</div>
                    <div class="panel-body">                    
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thread>
                                    <tr>                                        
                                        <th>Lugar de Trabajo</th>
                                        <th>Puesto</th>
                                        <th>Durante</th>
                                        <th></th>
                                        <th>Eliminar</th>
                                        <th></th>                                        
                                    </tr>
                                    </thread>
                                    <tbody>
                                    <tbody>
                                    @if($laboral)
                                        @foreach($laboral as $laboral)
                                            <tr>                                                
                                                <th>{{$laboral->lugar_trabajo}}</th>
                                                <th>{{$laboral->puesto}}</th>
                                                <th>{{$laboral->periodo}}</th>                                            
                                                <th></th>
                                                <th><i class="fa fa-trash fa-2x icondelete" id="EliminarLaboral" aria-hidden="true" value="{{$laboral->idInformacionLaboral}}"></i></th>
                                                <th></th>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="panel-heading">
                                    <button class="btn btn-success" style="width:100%;" data-toggle="modal" data-target="#nuevaInformacionLaboral">Nueva Informacion Laboral</button>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<!--Modal de Informacion Academica-->
            <div class="modal fade" id="nuevaInformacionAcademica" tabindex="-1" role="dialog" aria-labelledby="Nueva Informacion Academica">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Nueva Informacion Academica</h4>
                        </div>
                            <form action="/Profesor/Informacion/academica/crear" method="POST">
                            {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
                                <div class="modal-body">
                                    <input type="text" class="form-control" placeholder="Escuela" name="escuela" required><br>
                                    <input type="text" class="form-control" placeholder="Estudios" name="estudios" required><br>
                                    <input type="text" class="form-control" placeholder="Periodo" name="periodo" required><br>
                                    <input type="hidden" value="{{$informacionProfesor->idProfesor}}" name="idProfesor">
                                    <input type="hidden" value="{{$informacionProfesor->user_id}}" name="id">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="crearInfoAcademica">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<!--Modal de Informacion Laboral-->
        <div class="modal fade" id="nuevaInformacionLaboral" tabindex="-1" role="dialog" aria-labelledby="Nueva Informacion Laboral">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nueva Informacion Laboral</h4>
                </div>
                <form action="/Profesor/Informacion/laboral/crear" method="POST">
                {{ csrf_field() }} <!-- ESTE TOKEN ES IMPORTANTE PARA PODER ENVIAR DATOS AL SERVER... si no lo incluyes habra error ya que la informacion no es "confiable" -->
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Lugar de trabajo" name="lugar_trabajo" required><br>
                    <input type="text" class="form-control" placeholder="Puesto" name="puesto" required><br>
                    <input type="text" class="form-control" placeholder="Periodo" name="periodo" required><br>
                    <input type="hidden" value="{{$informacionProfesor->idProfesor}}" name="idProfesor">
                    <input type="hidden" value="{{$informacionProfesor->user_id}}" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="crearInfoLaboral">Guardar</button>
                </div>
                </form>
            </div>
            </div>
        </div>                
            </div>            
        </div>
      </div>
  </div>
<!--Eliminar informacion Academica-->
<div class="modal fade" id="eliminarInfoAcademicaModal" tabindex="-1" role="dialog" aria-labelledby="Eliminar Informacion Academica">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar ésta información?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarInfoAcademica">
            {{ csrf_field() }}
            <input type="hidden" value="{{$informacionProfesor->idProfesor}}" name="idProfesor">
            <button type="submit" class="btn btn-danger" style="width:100%;">SI</button>
        </form>
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>
<!--Eliminar informacion Academica-->
<div class="modal fade" id="eliminarInfoLaboralModal" tabindex="-1" role="dialog" aria-labelledby="Eliminar Informacion Laboral">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <p class="lead" style="text-align:center;">¿Estas seguro de eliminar ésta información?</p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="" id="eliminarInfoLaboral">
            {{ csrf_field() }}
            <input type="hidden" value="{{$informacionProfesor->idProfesor}}" name="idProfesor">
            <button type="submit" class="btn btn-danger" style="width:100%;">SI</button>
        </form>
        <button type="button" class="btn btn-default" style="width:100%;" data-dismiss="modal">NO</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
         $('i#EliminarAcademica').click(function(){       
           $('#eliminarInfoAcademicaModal').modal('show');
           $('form#eliminarInfoAcademica').attr('action','/Profesor/Informacion/academica/'+$(this).attr('value')+'/eliminar');
         });
         $('i#EliminarLaboral').click(function(){
           $('#eliminarInfoLaboralModal').modal('show');
           $('form#eliminarInfoLaboral').attr('action','/Profesor/Informacion/laboral/'+$(this).attr('value')+'/eliminar');
         });
    });
</script>     
@endsection

