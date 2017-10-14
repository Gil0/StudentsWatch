@extends('layouts.app')

@section('content')
<!--<meta name="csrf_token" content="{{ csrf_token() }}" /> <!Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
    @import url('http://fonts.googleapis.com/css?family=Julius+Sans+One');
    @import url('https://fonts.googleapis.com/css?family=Anton');
    body{
        padding: 0;
        margin: 0;
       
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
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                 </ul>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bienvenido</div>
                            <div class="panel-body">
                                Hola Administrador.
                            </div>
                        </div>
                    </div>
                </div>
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
                    <li><a href="{{ url('/login') }}">Mi Mapa Curricular</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/Usuario/Profesores') }}">Ver Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Ver Comentarios</a></li>
                 </ul>
            </div>
                                                             
        @endif                                        
    @endif 

      <div class="panel panel-info">
            <div class="panel-heading labelmenu">Información Personal</div>
                <div "panel-body">
                <form id="editarInformacion" class="form-horizontal" >                                                           
                <div class="form-group">
                <br/>
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                    <input type="text" readonly class="form-control" id="name" name="name" value="{{$profesores->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Matricula</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="matricula" name="matricula" value="{{$profesores->matricula}}" readonly>
                    </div>
                </div>       

                <div class="form-group">
                    <label class="col-sm-2 control-label">Correo Electronico</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{$profesores->email}}" readonly>
                    </div>
                </div>   
                       
                <div class="form-group">
                    <label class="col-sm-2 control-label">Cubiculo</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{$profesores->cubiculo}}" readonly>
                    </div>
                </div> 

                 <div class="form-group">
                    <label class="col-sm-2 control-label">Descripcion</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{$profesores->descripcion}}" readonly>
                    </div>
                </div>  

                 <div class="form-group">
                    <label class="col-sm-2 control-label">Hobbies</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{$profesores->hobbies}}" readonly>
                    </div>
                </div> 

                </form>        
            </div>
      </div>
      

            <!--Informacion Formacion Academica-->
            <div class="panel panel-info">
                <div class="panel-heading">Informacion Academica</div>                        
                    @if(!empty($formacion_academica))
                    <div class="panel-body">   
                    <table class="table table-hover">
                            <thread>
                                <tr>                                    
                                    <th>Escuela</th>
                                    <th>Estudios</th>
                                    <th>Periodo</th>                                    
                                </tr>
                            </thread>                     
                        @foreach($formacion_academica as $formacion_academica)                                                                            
                        <tbody>
                            <tr>
                                <th>{{$formacion_academica->escuela}}</th>
                                <th>{{$formacion_academica->estudios}}</th>
                                <th>{{$formacion_academica->periodo}}</th>
                            </tr>
                        </tbody>                                                                                                                                                                                
                        @endforeach
                    </table>   
                    </div>                                            
                    @endif    
             </div>                         
            </div>
            <!--Informacion Informacion Laboral-->
            <div class="panel panel-info">
                <div class="panel-heading">Informacion Laboral</div>
                    @if(!empty($informacion_laboral))
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thread>
                                <tr>                                    
                                    <th>Lugar de Trabajo</th>
                                    <th>Puesto</th>
                                    <th>Periodo</th>                                    
                                </tr>
                            </thread>
                        @foreach($informacion_laboral as $informacion_laboral)
                        <tbody>
                            <tr>
                                <th>{{$informacion_laboral->lugar_trabajo}}</th>
                                <th>{{$informacion_laboral->puesto}}</th>
                                <th>{{$informacion_laboral->periodo}}</th>
                            </tr>
                        </tbody>                                              
                        @endforeach
                        </table>
                        </div>
                    @endif         
            </div>
            
            </div>
        </div>
    </div>
</div>

@endsection 

